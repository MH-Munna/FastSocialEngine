<?php
/**
 * Класс осуществляющий функции банерной системы
 * Class banner
 */
class banner extends db{
    private $id = false, $data = array();

    /**
     * Получение банера для конкретной позиции
     * @param $position_id
     * @return mixed
     */
    static function get_banner_for($position_id){
        //$db = db::create();
        $filter = array(
            'active'=>1,
            'actual'=>1,
            'geo'=>array(
                'city'=> users::get()->get_field('vc_city')
            ),
            'ban_pos' => array($position_id)
        );
        return current(banner::get_banners($filter));
    }

    /**
     * Получить список банеров согласно условиям фильтра
     * @param array $filters
     * @param bool $group_result
     * @return array
     */
    static function get_banners($filters = array(), $group_result = true){
        $db = db::create();
        $result = array();

        $sql = 'select id, fk_ban_pos, i_geo_level from banners';
        $where = array();
        $group = array();
        $order = array();

        if ($filters['actual']){
            $where[] = 'ts_start < NOW()';
            $where[] = 'ts_stop > NOW()';
        }
        if ($filters['active']){
            $where[] = 'i_active = 1';
        }
        if ($filters['geo']){
            $where_geo = array();
            $where_geo[] = ('(vc_geo = "" AND i_geo_level = 0)');
            if ($filters['geo']['country']){
                $where_geo[] = ('(vc_geo = '.$db->quote($filters['geo']['country']).' AND i_geo_level = 1)');
            }
            if ($filters['geo']['region']){
                $where_geo[] = ('(vc_geo = '.$db->quote($filters['geo']['region']).' AND i_geo_level = 2)');
            }
            if ($filters['geo']['city']){
                $where_geo[] = ('(vc_geo = '.$db->quote($filters['geo']['city']).' AND i_geo_level = 3)');
            }
            $where[] = '('.implode(' OR ', $where_geo).')';
            $order[] = 'i_geo_level ASC';
        }
        if ($filters['ban_pos']){
            $where_ban_pos = array();
            foreach($filters['ban_pos'] as $ban_pos_item){
                $where_ban_pos[] = $db->quote($ban_pos_item);
            }
            $where[] = 'fk_ban_pos IN ('.implode(',', $where_ban_pos).')';
        }
        if ($filters['i_slide']){
            $where[] = 'i_slide = '.$db->quote($filters['i_slide']);
        }

        if (count($where)>0){
        $sql = $sql.' WHERE '.implode("\n AND ", $where);
        }

        if (count($order)>0){
        $sql = $sql.' ORDER BY '.implode(", ", $order);
        }

        $dbRes = $db->query($sql);

        $ban = array();

        if ($dbRes->rowCount()>0){
            while($row = $dbRes->fetch()){
                if ($group_result){
                    $ban[$row['fk_ban_pos']] = $row['id'];
                }else{
                    $ban[] = $row['id'];
                }
            }
        }

        foreach($ban as $fk_ban_pos => $ban_id){
            $ban_tmp = new banner($ban_id);
            $result[$fk_ban_pos] = $ban_tmp->get_info();
            unset($ban_tmp);
        }
        return $result;
    }

    /**
     * возвращает банер по ID
     * @param $id
     * @return banner
     */
    static function get_banner_by_id($id){
        return new banner($id);
    }

    /**
     * Создает запись в базе соответствующую новому банеру
     * @return banner
     */
    static function banner_add(){
        $db = db::create();

        $dbRes = $db->insert('banners', array());
        return new banner($dbRes['id']);
    }

    function __construct($id){
        parent::__construct();
        $this->id = $id;
        $this->get_info();
    }

    /**
     * Метод, позволяющий удалить банер
     */
    function banner_delete(){
        $this->delete('banners', $this->id);
    }

    /**
     * метод - получение информации о банере
     * @return bool|mixed
     */
    function get_info(){
        /*if (empty($this->data)){*/
            $this->data = $this->getone('banners', $this->id);
        /*}*/
        return $this->data;
    }

    /**
     * Устанавливает значения для полей банера
     * @param array $fields
     * Массив ключ - значение
     */
    function set_fields($fields = array()){
        $array_to_change = array();
        foreach($fields as $key=>$value){
            $this->data[$key] = $value;
            $array_to_change[$key] = $value;
        }
        unset($array_to_change['id']);
        $this->update('banners', $this->data['id'], $array_to_change);
    }

    /**
     * загрузить изображение или анимацию (используются теже сервера что и для обычных фотографий)
     * @param $tmp_name
     * @param string $ext
     * @return mixed
     */
    function upload_banner($tmp_name, $ext='jpg'){
        $srv = new servers_class(servers_class::find_server_by_type(2));
        $srv_info = $srv->get_info();

        $dirName = 'other';

        $tmpFile['banner']['tmp_name'] = $tmp_name;
        $tmpFile['banner']['name'] = create_password(5).'-'.create_password(5).'.'.$ext;
        //$tmpFile['banner']['size_name'] = $size['name'];

        uploadftp($srv->get_first_ip(), $srv_info['vc_ftp_user'], $srv_info['vc_ftp_pass'], $srv_info['vc_ftp_path'], $dirName, $tmpFile['banner']);
        $this->set_fields(array('vc_url_content'=> $srv_info['vc_baseurl'].$dirName.'/'.$tmpFile['banner']['name']));
        return $this->data['vc_url_content'];
    }
    function __clone(){}
    function __wakeup(){}
}