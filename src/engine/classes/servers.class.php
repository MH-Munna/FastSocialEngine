<?php
/**
 * Класс осуществляет основную работу по учету работоспособности серверов, нагрузке, свободному месту на диске и т.д.
 * User: Spectrum
 * Date: 02.07.13
 * Time: 23:43
 * To change this template use File | Settings | File Templates.
 */

class servers_class {
    private $id=false, $data=array(), $db;

    /**
     * метод осущствляет актуализацию информации о сервере, в данном случае перезаписывается значение последнего выхода на связь
     * @param $fields
     * @return mixed
     */
    function update_info($fields){
        $this->data['ts_lastresponse'] = time();
        $fields['ts_lastresponse'] = $this->data['ts_lastresponse'];
        return $this->db->update('servers', $this->id, $fields);
    }

    function __construct($id){
        $this->db=db::create();
        $this->id=$id;
        return $this->get_info();
    }

    /**
     * Получение информации о сервере
     * @param int $id
     * @return array|bool
     */
    function get_info($id=0){
        if($id){
            return $this->db->getone('servers',$id);
        }
        if(!$id)$id=$this->id;
        if(!$id)return false;
        // Если data пустой то выборка из БД/кэша
        if(!sizeof($this->data)){
            $this->data=$this->db->getone('servers',$id);
        }
        return $this->data;
    }

    /**
     * Проверяет время последнего выхода на связь каждого сервера, если оно больше установленной нормы, то он считается выпавшим из кластера и помечается как упавший.
     * Здесь необходимо будет заложить уведомление админа о нештатной ситуации
     * @return bool
     */
    function check_servers(){
        $servers = $this->db->query('SELECT * FROM servers')->fetchAll();
        foreach($servers as $server_row){
            $to_update = array();
            if ($server_row['ts_lastresponse']>=time()-60*2){
                $to_update['i_status'] = 1;
            }else{
                $to_update['i_status'] = 0;
            }
            $this->db->update('servers', $server_row['id'], $to_update);
            unset($to_update);
        }
        return true;
    }

    /**
     * Ищет самый свободный сервер (по средней загрузке за последние 15 минут) из серверов заданного типа
     * other - 0,
     * php - 1,
     * picters - 2,
     * mysql - 3,
     * memcached - 4,
     * games - 5,
     * api - 6
     * @param $type
     * id типа сервера
     * @return mixed
     * id сервера
     */
    static function find_server_by_type($type){
        $result = false;
        $db = db::create();
        $sql = 'SELECT id FROM servers WHERE i_status=1 AND i_type = '.$type.' ORDER BY i_disk_gb DESC, d_loadavarage ASC LIMIT 1;';
        $dbRes = $db->query($sql);
        if ($dbRes->rowCount()>0){$result = $dbRes->fetch();}
        return $result['id'];
    }

    /**
     * Возвращает УРЛ до сервера
     * @param $id
     * @return mixed
     */
    static function get_server_url($id){
        $result = false;
        $db = db::create();
        $dbRes = $db->getone('servers', $id, array('vc_baseurl'));
        return $dbRes['vc_baseurl'];
    }

    /**
     * Поиск среди IP адресов сервера, IP адреса который входит во внутреннюю сеть кластера ( по нему уже можно к нему подключаться для закачки фотографий, игр, музыки)
     * @return bool
     */
    function get_first_ip(){
        $result = false;
        $tmp = unserialize($this->data['s_ips']);
        if (count($tmp)>0) {
            foreach($tmp as $key => $value){
                if (strpos($value, '192')!==false){
                    $result = $tmp[$key];
                    break;
                }
            }
        }
        return $result;
    }
}
