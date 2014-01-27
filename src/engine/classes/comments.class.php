<?php
/**
 * Класс универсального компонента - комментарии.
 * Позволяет прикручивать комментарии к абсолютно любому объекту в сети
 * Class comment
 */

class comment{
    static $mes=null,$dialog=null;
    protected $user,$db,$sv;

    /**
     * Добавление комментария, чуть позже распишу параметры
     * @param $id
     * @param $type
     * @param $user
     * @param $text
     * @param int $parent
     * @return array
     */
    function add($id,$type,$user,$text,$parent=0){
        if((int)$id&&$type&&(int)$user&&$text){ // добавляем только в случае наличия необходимых данных
            $sql=$this->db->insert('comment',array(
                'type_id'=>$id,
                'type'=>$type,
                'user_main'=>$user,
                'user'=>$this->user->id(),
                'parent'=>$parent,
                'text'=>strip_tags($text, '<p><span><u><em><strong>'),
                'ts'=>$this->db->ts()
            ));
            $user = new users($user);
            $sql['user_info']=$user->get_info(0, true);
        }
        if(!$sql)$sql=array('error'=>'ошибка добавления комментария');
        return $sql;
    }

    /**
     * Удаление комментария
     * @param $id
     * @return bool
     */
    function delete($id){
        $com=$this->db->getone('comment',$id);
        if($com['user_main']!=$this->user->id()||$com['user']!=$this->user->id())return false;
        //$this->db->delete('comment',$id);
        $arr_to_update['i_delete'] = 1;
        $this->db->update('comment', $id, $arr_to_update);
        return $id;
    }

    /**
     * Получение списка комментов к выбранному элементу (фото, стена)
     * @param $id
     * @param $type
     * @return mixed
     */
    function getall($id,$type){
        $sql=$this->db->query('select * from comment where i_delete = 0 AND type_id='.$id.' and type="'.$type.'" order by id desc')->fetchAll();
        foreach($sql as &$item){
            $user = new users($item['user']);
            $item['user_info']=$user->get_info(0, true);
        }
        return $sql;
    }

    /**
     * Получение 1 комментария + юзер инфо оставившего комментарий
     * @param $id
     * @return mixed
     */
    function getone($id){
        $com=$this->db->getone('comment', $id);
        $user = new users($com['user']);
        $com['user_info']=$user->get_info(0, true);
        return $com;
    }
    
    static function create(){
        if(!self::$mes)self::$mes=new comment;
        return self::$mes;
    }
    
    protected function __construct(){
        //parent::__construct();
        $this->user=users::get();
        $this->db=db::create();
        $this->sv=db::sv();
    }
    private function __clone(){}
    private function __wakeup(){}
}
