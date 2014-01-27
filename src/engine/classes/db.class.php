<?php
/**
 * Класс для работы с базой, активно использует мемкеш для уменьшения колличества запросов на выборку из базы
 * Class db
 * Осипян Артур 2013 г. Таганрог
 * arthur@osipyan.ru
 */
class db{
    protected $db,$mem,$sv=null,$cache=3600;
    protected static $dbs=null;

    static function sv(){
        if(!self::$dbs)return false;
        return self::$dbs->sv;
    }
    static function create($conf=array()){
        if(!self::$dbs)self::$dbs=new db();
        return self::$dbs;
    }
    static function error(){
        if(!self::$dbs)return false;
        return self::$dbs->errors();
    }
    
    function ts(){
        return date('Y-m-d H:i:s');
    }

    /**
     * Экранирует строку для годной вставки в запрос
     * @param $param
     * @return string
     */
    function quote($param){
        return $this->db->quote($param);
    }

    /**
     * Обновление записи в базе + мемкеше
     * @param $table
     * @param $id
     * @param array $items
     * @return bool|mixed
     */
    function update($table,$id,array $items){
        $m=array();
        // если есть кэш то обновляем его, если нет то ничего не добавляем в кэш
        $cache=$this->get_mem($table.$id);
        foreach($items as $key=>$val){
            $m[]='`'.$key.'`='.$this->db->quote($val);
            if($cache)$cache[$key]=$val;
        }
        if($cache)$this->set_mem($table.$id,$cache);
        $sql = 'UPDATE `'.$table.'` set '.join(',',$m).' WHERE `id`='.$id;
        $this->query($sql);
        return $cache?$cache:false;
    }

    /**
     * Удаление записи в базе + удаление кеша в мемкеше
     * @param $table
     * @param $items
     */
    function delete($table,$items){
        $id=array();
        if(is_array($items)){
            foreach($items as $ii){
                $id[]=(int)$ii;
                // обнуляем кэш для удаленных обьектов
                $this->set_mem($table.$ii,false);
            }
        }
        else{ 
            $id[]=(int)$items;
            $this->set_mem($table.(int)$items,false);
        }
        $this->query('delete from `'.$table.'` where id in ('.join(',',$id).')');
    }

    /**
     * Принудительная очистка кеша по какой либо записи
     * @param $table
     * @param $id
     */
    function mem_clear($table, $id){
        $this->set_mem($table.$id,false);
    }

    /**
     * Вставляет запись в базу + в мемкеш
     * @param $table
     * @param array $items
     * @return array|bool
     */
    function insert($table,array $items){
        $m=$n=$x=array();
        // добьавление уникального ИД к записи, если он явно не указан
        if (empty($items['id'])){
            $items['id']=$this->get_max($table);
        }
        foreach($items as $key=>$val){
            $m[]=$key;
            $n[]=$this->db->quote($val);
            // данные для кэша
            $x[$key]=$val;
        }
        $this->set_mem($table.$items['id'],$x);
        $sql = 'insert into `'.$table.'` (`'.join('`,`',$m).'`)values('.join(',',$n).')';
        return $this->query($sql)?$x:false;
    }

    /**
     * Получение сразу нескольких записей путем передачи массива ID записей в виде массива.
     * @param $table
     * @param array $id
     * @param string $fields
     * @return array|bool
     */
    function getall($table,array $id,$fields='*'){
        $array=array();
        // Выбираем данные из кэша
        foreach($id as $key=>$ids){
            if($cache=$this->cache($table.$ids)){
                $array[$ids]=$cache;
                unset($id[$key]);
            }
        }
        // Если все данные есть в кэше то возвращаем их
        if(!sizeof($id))return $array;
        if(!is_array($fields))$fields='*';
        else $fields='`'.join('`,`',$fields).'`';
        // Выбираем нехватающие данные из базы и добавляем в кэш
        $sql=$this->query('select '.$fields.' from `'.$table.'` where id in ('.join(',',$id).') order by id');
        if($sql){
            foreach($sql as $item){
                $array[$item['id']]=$item;
                $this->set_mem($table.$item['id'],$item);
            }
        }
        return sizeof($array)?$array:false;
    }

    /**
     * Удаление кеша memcached
     */
    function drop_cache(){
        $this->mem->flush();
    }

    /**
     * Получает массив с полями обьектами.
     * $fields=array( "id" ) Если он не указан или не является массивом то выборка идет всех полей - select *
     * Получает данные из кэша по ключу. Если их нет то из базы, и обновялет кэш.
     *
     * @param $table
     * @param $id
     * @param string $fields
     * @return bool|mixed
     *
     */
    function getone($table,$id,$fields='*'){
        if($cache=$this->cache($table.$id))return $cache;
        if(!is_array($fields))$fields='*';
        else $fields='`'.join('`,`',$fields).'`';
        $sql = 'select '.$fields.' from `'.$table.'` where id="'.$id.'"';
        $dbRes=$this->query($sql);
        $dbRes=($dbRes?$dbRes->fetch(PDO::FETCH_ASSOC):false);
        $this->mem->set($table.$id,$dbRes);
        return $dbRes;
    }

    /**
     * Получение одной записи из базы
     * @param $table
     * @param $id
     * @param string $field
     * @return bool|mixed
     */
    function getsingl($table,$id,$field='id'){
        if($cache=$this->cache($table.$id,$field))return $cache;
        $sql=$this->query('select `'.$field.'` from `'.$table.'` where id='.$id);
        if(!$sql)return false;
        $sql=$sql->fetch();
        return $sql[0];
    }

    /**
     * Метод для проверки логина и пароля пользователя, в случае успеха возвращается ID пользователя
     * иначе фолз
     * @param $login
     * @param $pass
     * @return bool
     */
    function login($login,$pass){
        $login=$this->db->quote($login);
        $pass=$this->db->quote(md5($pass));
        //if($cache=$this->cache('user'.$login.$pass)) return $cache;
        $sql = 'SELECT * FROM `users` WHERE ch_email='.$login.' AND ch_pass='.$pass;
        $user = $this->db->query($sql);
        if(!$user)return false;
        if($user->rowCount()==0)return false;
        $user=$user->fetch();
        $this->mem->set('user'.$login.$pass,$user['id']);
        return $user['id'];
    }

    function getlang($name){
        $id=$_SESSION['langID'];
        $cache=$this->get_mem('language_'.$id);
        if(!$cache){
            $cache=array();
            $sql=$this->query('select * from lang where id='.$id)->fetchAll();
            foreach($sql as $item){
                $cache[$item['name']]=$item['field'];
            }
            $this->set_mem('language_'.$id,$cache);
        }
        return $cache[$name]?$cache[$name]:$name;
    }
    protected function errors(){
        return $this->db->errorInfo();
    }
    protected function cache($key,$field=false){

        if(!$this->get_mem($key)||!$this->cache)return false;
        else{ 
            $cache=$this->get_mem($key);
            if($field)$cache=$cache[$field];
            return $cache;
        }
    }

    /**
     * Возвращает максимальное значение ID в таблице
     * @param $table
     * @return bool|mixed
     */
    function get_max($table){
        // Кэширование максимальных ИДшников в таблице для создания новый уникальных значений
        if($cache=$this->get_mem($table.'max')){
            $this->set_mem($table.'max',$cache+1);
            return $cache+1;
        }
        $sql=$this->db->query('select max(id) from `'.$table.'`')->fetch();
        $this->set_mem($table.'max',$sql[0]+1);
        return $sql[0]+1;
    }

    /**
     * Позволяет сохранить на длительное время параметры, например сколько групп создано в сети (чтобы не считать эту цифру копая всю базу) и т.д.
     * @param $fieldName
     * @param $fieldValue
     * @return bool
     */
    function set_global_parameter($fieldName, $fieldValue){
        $value = $this->getone('options', $fieldName);
        if (!$value){
            $this->insert('options', array('id'=>$fieldName, 'parameterValue'=>$fieldValue));
        }else{
            $this->update('options', $fieldName, array('parameterValue'=>$fieldValue));
        }
        return true;
    }

    /**
     * Вытаскивает ранее сохраненное глобальное значение
     * @param $fieldName
     * @return mixed
     */
    function get_global_parameter($fieldName){
        $value = $this->getone('options', $fieldName);
        if (isset($value['parameterValue'])) return $value['parameterValue'];
        return false;
    }


    /**
     * Добавляет значение в кеш.
     * @param $key
     * @param $val
     * @return bool
     */
    protected function set_mem($key,$val){
        // При невозможности подключиться к кэшу возвращает false
        if(!$this->cache)return false;
        $this->mem->set($key,$val,$this->cache);
        return $val;
    }

    /**
     * Получение данных из кеша
     * @param $key
     * @return bool|mixed
     */
    protected function get_mem($key){
        // При невозможности подключиться к кэшу возвращает false
        if(!$this->cache)return false;
        return $this->mem->get($key);
    }

    function query($sql,$function='query'){
        // Запрос к БД - просто левая функция чтобы напрямую не обращаться к переменной db
        return $this->db->$function($sql);
    }

    protected function __construct(){
        $configure=configure::$db;
        try{
            // Коннект к БД
            $db=new PDO(
                    'mysql:host='.$configure['db_host'].';dbname='.$configure['db_name']
                    ,$configure['db_user'],$configure['db_pass']
                );
        }
        catch(PDOException $e){
            die("Error: ".$e->getMessage());
        }
        $db->query("set names '".$configure['db_code']."'");
        $this->db=$db;
        $this->sv=new db_sv($db);
        $mem=new Memcached;

        //Коннект к мемкэшу и если его нет то отключение кэширования
        if (!$mem->addServer($configure['mem_host'],$configure['mem_port'])) {
            $this->cache=false;
        }
        $this->mem=$mem;
    }

    /**
     * Позволяет добавить запись на удаленный мемкеш сервер
     * используется для получения уникальных временных ссылок на медиафайлы
     * возвращает:
     * true если соединение прошло успешно,
     * false если соедениться так и не удалось
     * @param $key
     * будущие ключ мемкеш
     * @param $value
     * значение
     * @param $host
     * имя хоста к которому необходимо подключаться
     * @param string $port
     * порт, по умолчанию 11211 (не обязательное значение)
     * @return bool
     */
    static function remoteMemcacheSet($key, $value, $host, $port = '11211'){
        $mem=new Memcached;

        if ($mem->addServer($host,$port)) {
            $mem->set($key, $value, 86400);
            return true;
        };
        return false;
    }
    private function __clone(){}
    private function __wakeup(){}
}

/**
 * Класс базы для работы со связанными элементами.
 * Документирован плохо, но по мере работы с ним методы будут описаны
 * ВНИМАНИЕ!!11
 * желательно работать с таблицами чье имя начинается на sv_
 * Class db_sv
 */
class db_sv{
    protected $db, $mem;

    /**
     * Конструктор класса
     * @param $db
     */
    function __construct($db){
        $configure=configure::$db;
        $mem=new Memcached;
        $this->db=$db;
        if (!$mem->addServer($configure['mem_host'],$configure['mem_port'])) {
            $this->cache=false;
        }
        $this->mem=$mem;
    }

    /**
     * Возвращает все записи таблицы отвечающие условиям фильтрации
     * @param $table
     * название таблицы (желательно работать с таблицами чье имя начинается на 'sv_')
     * @param $id
     * @param string $field
     * @return bool
     */
    function getall($table,$id,$field=''){
        if(!$field){
            $col=$this->get_column($table);
            $field=$col[0]['Field'];
        }
        $sql = 'select * from `'.$table.'` where `'.$field.'`='.(int)$id;
        $dbRes=$this->db->query($sql);
        if(!$dbRes)return false;
        return $dbRes->fetchAll();
    }

    /**
     * Возвращает колличество связей, расмотрим ее принцип на примере:
     * допустим нам необходимо понять, есть ли эта видеозапись в коллекции пользователя и сколько раз она у него встречается
     * @param $table
     * таблица, example:'sv_video'
     * @param array $id
     * массив значений, example: ID пользователя и ID видеозаписи
     * @param string $field
     * массив ключей значений, в том же порядке что и в параметре ID, example: user_id, video_id
     * @return bool
     * возвращает либо false, либо число таких связей: 1 и более(в случае если пользователь добавил это видео неоднократно).
     */
    function getcount($table,array $id,$field=''){
        if(!$field){
            $col=$this->get_column($table);
            foreach($col as $kk=>$item){
                $field[$kk]=$item['Field'];
            }
        }
        else{
            if(sizeof($id)!=sizeof($field))return false;
        }
        //if(sizeof($id)<2)return false;
        $id=array_values($id);
        $field=array_values($field);
        $w=array();
        foreach($id as $key=>$item){
            $w[]='`'.$field[$key].'`="'.$item.'"';
        }
        $sql=$this->db->query('select count(*) from `'.$table.'` where '.join(' and ',$w));
        if(!$sql)return false;
        $sql=$sql->fetch();
        return $sql[0];
    }

    function delete($table,array $array,$columns=array()){
        $ars=array();
        $cols=$columns;
        if(!sizeof($cols)){
            $col=$this->get_column($table);
            foreach($col as $u){
                $cols[]=$u['Field'];
            }
        }
        foreach($array as $kk=>$item){
            foreach($item as $key){
                $ars[]='('.$cols[0].'='.$kk.' and '.$cols[1].'='.$key.')';
            }
        }
        $this->db->query('delete from `'.$table.'` where '.join(' or ',$ars));
    }

    /**
     * Вставляет связку в базу
     * @param $table
     * имя таблицы
     * @param array $array
     * массив значений
     * @param array $columns
     * массив с названиями полей
     */
    function insert($table,array $array,$columns=array()){
        $ars=array();
        $cols=$columns;
        foreach($array as $kk=>$item){
                $ars[] = $kk;
            foreach($item as $key){
                $ars[]=$key;
            }
        }
        if(!sizeof($cols)){
            $col=$this->get_column($table);
            foreach($col as $u){
                if(sizeof($cols)<2)
                $cols[]=$u['Field'];
            }
        }
        $sql = 'insert into `'.$table.'` (`'.join('`,`',$cols).'`) values ('.join(',',$ars).')';
        $this->db->query($sql);
    }

    /**
     * Возвращает список колонок таблицы
     * @param $table
     * название таблицы
     * @return bool|mixed
     * Массив, чьи значения равны названиям колонок запрошенной таблицы
     */
    private function get_column($table){
        if($cache=$this->mem->get('col'.$table))return $cache;
        $sql=$this->db->query('show columns from `'.$table.'`');
        if(!$sql)return false;
        $sql=$sql->fetchAll();
        $this->mem->set('col'.$table,$sql);
        return $sql;
    }
    private function __clone(){}
    private function __wakeup(){}
}

