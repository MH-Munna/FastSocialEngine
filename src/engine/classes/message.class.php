<?
/**
 * Class message
 * Предназначен для работы с сообщениями
 */
class message extends db{
    static $mes=null,$dialog=null;
    protected $user,$db,$sv;

    /**
     * помечает сообщение как прочитанное
     * @param $mess_id
     */
    function read($mess_id){
        $this->db->query('update sv_message set no_read=0 where user_id='.users::id().' and message_id='.(int)$mess_id);
    }

    /**
     * Получить данные на сообщение с ИД $mess_id
     * Проверка на принадлежность этого сообщения к пользователю не требуется
     * @param $mess_id
     * @return bool|mixed
     */
    function get_info_about_message($mess_id){
        $mess=$this->db->getone('message',$mess_id);
        $dialog_info=$this->db->getone('dialog',$mess['fk_dialog']);
        $peoples = unserialize($dialog_info['ser_peoples']);
        if(!in_array(users::id(),$peoples))return false;
        $user=new users($mess['fk_user']);
        $mess['user_info']=$user->get_info(null, true);
        return $mess;
    }

    /**
     * Получить все сообщения пользователя
     * @param $mess_id
     * сообщение после которого идет выборка
     * @param $dialog_id
     * диалог из которого идет выборка
     * @param int $no_read
     * 1 - выбирать только непрочитанные, 0 - выбирать все сообщения
     * @return array
     */
    function get_after($mess_id,$dialog_id,$no_read=1){
        $sql = 'select * from sv_message where
            fk_user='.users::id().' and
            fk_dialog='.(int)$dialog_id.'
            '.($no_read?'and unread=1 ':'').'
            and fk_message > '. (int) $mess_id. ' order by id desc LIMIT 6 ';

        $sql=$this->db->query($sql)->fetchAll();
        $mess=array();
        $sql = array_reverse($sql);
        foreach($sql as $item){
            $m=$this->get_info_about_message($item['fk_message'])+array('no_read'=>$item['unread']);
            $m['ts']=explode(' ',$m['ts']);
            $mess[]=$m;
        }
        return $mess;
    }

    /**
     * выбрать все непрочитанные сообщения для данного пользвоателя
     * @return array
     */
    function no_read(){
        $sql=$this->db->query('select * from sv_message where user_id='.users::id().' and no_read=1')->fetchAll();
        $mess=array();
        foreach($sql as $item){
            $mess[]=$this->get_info_about_message($item['message_id']);
        }
        return $mess;
    }

    /**
     * выбрать все непрочитанные сообщения для данного польвзователя из диалога
     * @param $dialog_id
     * @return array
     */
    function no_read_dialog($dialog_id){
        $sql=$this->db->query('select * from sv_message where user_id='.users::id().' and dialog_id='.(int)$dialog_id.' and no_read=1')->fetchAll();
        $mess=array();
        foreach($sql as $item){
            $mess[]=$this->get_info_about_message($item['message_id']);
        }
        return $mess;
    }

    /**
     * добавить сообщение в диалог
     * Проверка на принадлежность польвзоателя к диалогу не требуется
     * @param $text
     * текст сообщения
     * @param $dialog_id
     * ИД диалога
     * @param int $system
     * Системное сообщение (добавляется в диалог с ИД пользвоателя 0)
     * @return bool
     */
    function add($text,$dialog_id,$system=0){
        $dialog_info=$this->db->getone('dialog',$dialog_id);

        $peoples = unserialize($dialog_info['ser_peoples']);
        if(!in_array(users::id(),$peoples))return false;

        $mess=$this->db->insert('message',array(
            'fk_user'=>users::id(),
            'fk_dialog'=>$dialog_id,
            'message'=>spam::mess($text)
        ));

        foreach($peoples as $user_id){
            $this->db->insert('sv_message',array(
                'fk_message'=>$mess['id'],
                'fk_user'=>$user_id,
                'fk_dialog'=>$dialog_id,
                'unread'=>($system?1:($user_id==users::id()?1:0))
            ));
            if ($user_id!=users::id()){
                $tmp_user = new users($user_id);
                events_class::create($user_id, 5, null, array('dialog_id'=>$dialog_id, 'name'=>$tmp_user->name()));
                unset($tmp_user);
            }
        }
        $sv_dialogs=$this->db->sv->getall('sv_dialogs',$dialog_id, 'fk_dialog');

        foreach($sv_dialogs as $sv_dialogs_row){
            $this->db->update('sv_dialogs', $sv_dialogs_row['id'], array('ts'=>time()));
        }
        return $mess['id'];
    }

    /**
     * Редактирование сообщения
     * @param $text
     * текст
     * @param $mess_id
     * айди сообщения
     * @return bool
     */
    function edit($text,$mess_id){
        $mess=$this->db->getone('message',$mess_id);
        if($mess['user_id']!=users::id())return false;
        $this->db->update('message',$mess_id,array('message'=>$text));
    }

    /**
     * удаление сообщения с ИД
     * проверка на принадлежность пользователю не требуется
     * @param $mess_id
     * @return bool|void
     */
    function delete($mess_id){
        $mess=$this->db->getone('message',$mess_id);
        if($mess['user_id']!=users::id())return false;
        $this->db->delete('message',$mess_id);
    }

    /**
     * Создает экземпляр класса
     * @return db|message|null
     */
    static function create(){
        if(!self::$mes)self::$mes=new message;
        return self::$mes;
    }

    /**
     * Конструктор
     */
    protected function __construct(){
        parent::__construct();
        $this->user=users::get();
        $this->db=db::create();
        $this->sv=db::sv();
    }
    private function __clone(){}
    private function __wakeup(){}
}

/**
 * Class dialog
 * Предназначен для работы с диалогами
 */
class dialog extends message{

    /**
     * начать диалог с пользвоателем
     * @param $user_id
     * юид пользователя с которым начинается диалог
     * @return mixed
     * возвращается айдишник диалога
     */
    function start($user_id){
        if (users::id()==$user_id) { //Чат сам с собой? нет у простите
            return false;
        }
        $peoples[] = users::id();
        $peoples[] = $user_id;
        sort($peoples);
        $sql = 'SELECT id FROM dialog WHERE ser_peoples = '.$this->db->quote(serialize($peoples));
        $dbRes = $this->db->query($sql);

        if ($dbRes->rowCount()>0){
            $result = $dbRes->fetch();
        }else{
            $result=$this->db->insert('dialog',array('ser_peoples'=>serialize($peoples), 'vc_title'=>''));
            $this->db->sv->insert('sv_dialogs',array($result['id']=>$peoples), array('fk_dialog', 'fk_user'));
        }
        return $result['id'];
    }

    /**
     * Удаление пользователя из диалога
     * Проверка на пользователя который создал диалог не требуется
     * При использвоании этого метода генерируется системное сообщение
     * @param $user_id
     * юид пользователя
     * @param $dialog_id
     * айдишник диалога
     * @return bool|void
     * возвращается фолз в случае неудачи
     */
    function delete($user_id,$dialog_id){
        if(!$this->sv->getcount('sv_dialog',array($dialog_id,$user_id))||
           $this->db->getsingl('dialog',$dialog_id,'user_id')!=users::id())return false;
        
        $user=users::get()->get_info($user_id);
        parent::add('Пользователь '.$this->user->name().' удалил пользвоателя '.$user['cf_name'], $dialog_id,1);
        $this->sv->delete('sv_dialog',array($dialog_id=>array($user_id)));
    }

    /**
     * Возвращает все диалоги пользователя
     * @return array
     */
    function get_all(){
        $result = array();
        $sql = 'select * from sv_dialogs where fk_user='.users::id().' order by ts desc';
        $dbRes=$this->db->query($sql);
        while($row_dialog = $dbRes->fetch()){
            $dialog=$this->get_info_about_dialog($row_dialog['fk_dialog']);

            $result[$row_dialog['fk_dialog']]['id'] = $dialog['id'];
            $result[$row_dialog['fk_dialog']]['title'] = $dialog['vc_title'];
            $tmp_title = '';
            $peoples_tmp = unserialize($dialog['ser_peoples']);

            if (count($peoples_tmp)>0){
                foreach($peoples_tmp as $chat_uid){
                    if ($chat_uid!=users::id()){
                        $user_tmp = new users($chat_uid);
                        $result[$row_dialog['fk_dialog']]['peoples'][$chat_uid] = $user_tmp->get_info(null, true);
                        $tmp_title .= $user_tmp->name().' ';
                        unset($user_tmp);
                    }
                }
            }
            if (empty($result[$row_dialog['fk_dialog']]['title'])){
                $result[$row_dialog['fk_dialog']]['title'] = $tmp_title;
            }
        }
        return $result;
    }

    /**
     * подключить польвзоателя к диалогу
     * Проверка на польвзоателя который создал диалог не требуется
     * При использвоании этого метода генерируется системное сообщение
     * @param $user_id
     * @param $dialog_id
     * @return bool
     */
    function add($user_id,$dialog_id){
        if($this->sv->getcount('sv_dialog',array($dialog_id,$user_id))||
           $this->db->getsingl('dialog',$dialog_id,'user_id')!=users::id())return false;
        
        $user=users::get()->get_info($user_id);
        parent::add('Пользователь '.$this->user->name().' пригласил пользователя '.$user['cf_name'], $dialog_id,1);
        $sql=$this->db->query('select max(message_id) from sv_message where dialog_id='.$dialog_id)->fetch();
        $this->query('insert into sv_dialog (`dialog_id`,`user_id`,`message_id`)values('.$dialog_id.','.$user_id.','.
                $sql[0]
                .')');
    }

    /**
     * Переименовывание диалога
     * Проверка на принадлежность пользвоателя к диалогу не требуется.
     * Каждый пользователь в диалоге может называть его на свое усмотрение.
     * @param $name
     * @param $dialog_id
     * @return mixed
     */
    function rename($name,$dialog_id){
        if(!$dialog=$this->get_mem('dialog_'.$dialog_id)){
            $dialog=$this->db->query('select * from dialog where dialog_id='.$dialog_id.' and user='.users::id());
            $dialog=$dialog?$dialog->fetch():false;
        }
        $this->db->query('update sv_dialog set name_dialog="'.$name.'" where dialog_id='.$dialog_id.' and user_id='.users::id());
        $dialog['name_dialog']=$name;
        $this->set_mem('dialog_'.$dialog_id,$dialog);
        return $dialog['name_dialog'];
    }

    /**
     * Возвращает данные о диалоге
     * Проверка на принадлежность пользователя к диалогу не требуется.
     * @param $dialog_id
     * @return mixed
     */
    function get_my($dialog_id){
        $dialog=$this->get_info_about_dialog($dialog_id);
        foreach($dialog as $d){
            if($d['user_id']==users::id()){
                return $d;
            }
        }
    }

    /**
     * получить все данные о диалоге
     * Проверка на принадлежность пользвоателя к диалогу не требуется.
     * @param $dialog_id
     * @return array|bool|mixed|PDOStatement
     */
    function get_info_about_dialog($dialog_id){
        $dialog = $this->db->getone('dialog', $dialog_id);
        $peoples = unserialize($dialog['ser_peoples']);
        if (in_array(users::id(), $peoples)){
            return $dialog;
        }
        return false;
    }

    static function create(){
        if(!self::$dialog)self::$dialog=new dialog;
        return self::$dialog;
    }

    protected function __construct(){
        parent::__construct();
    }
}


/**
 * Class spam
 * Расширение в котором будут прописаны правила для фильтрации спама
 */
class spam{
    static function mess($message){
        return $message;
    }
}



/*

CREATE TABLE IF NOT EXISTS `dialog` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `dialog_id` int(11) NOT NULL,
  `message` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

CREATE TABLE IF NOT EXISTS `sv_dialog` (
  `dialog_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL DEFAULT '0',
  `name_dialog` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `sv_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message_id` int(11) NOT NULL,
  `dialog_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `no_read` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;


CREATE TABLE IF NOT EXISTS `sv_photo` (
  `photo_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

 */