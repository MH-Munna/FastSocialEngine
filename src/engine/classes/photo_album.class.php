<?php
/**
 * Created by JetBrains PhpStorm.
 * User: spectrum
 * Date: 12.06.13
 * Time: 22:11
 * To change this template use File | Settings | File Templates.
 */

class photo_album_class{
    private $id=false, $data=array(), $db;

    function __construct($id = false){
        $this->db=db::create();
        $this->id=$id;
        return $this->get_info();
    }

    /**
     * Возвращает массив значений альбома, название, описание, обложку и т.д.
     * В случае если запрашивается несуществующий или удаленный альбом то возвращает false
     * @return array|bool|mixed
     */
    function get_info(){
        if (empty($this->id)) return false;
        // Если data пустой то выборка из БД/кэша
        if(empty($this->data)){
            $this->data=$this->db->getone('photo_album', $this->id);
            if (!$this->data) return false;
        }
        if (($this->data)&&(0==$this->data['fk_photo_cover'])){
            $srv = new servers_class(servers_class::find_server_by_type(2));
            $srv_info = $srv->get_info();
            $this->data['vc_url199x139_photo_cover'] = $srv_info['vc_baseurl'].'/nopic.jpg';
        }elseif(empty($this->data['vc_url199x139_photo_cover'])){
            $photo_tmp = new photo_class($this->data['fk_photo_cover']);
            $photo_info = $photo_tmp->get_info();
            $this->data['vc_url199x139_photo_cover'] = $photo_info['vc_url199x139'];
            $this->data['count_photos'] = count(unserialize($this->data['ser_photos']));
            $this->db->update('photo', $this->id, $this->data);
        }
        if (1==$this->data['i_del']) return false;
        return $this->data;
    }

    function create_album($uid){ //Создание фотоальбома
        $user = new users($uid);
        $user_photo_albums = $user->get_photo_albums();
        if (count($user_photo_albums)>=configure::$photo_albums_limit) return false; //Не превышен ли лимит на количество альбомов
        $album_id = $this->db->insert('photo_album', array('fk_user'=>$uid, 'ch_name'=>get_perevod('default_album_name')));
        $user_photo_albums[] = $album_id['id'];
        $user->change(array('ser_photo_albums'=>serialize($user_photo_albums)));
        if (empty($album_id['id'])) return false;
        return $album_id['id'];
    }

    function del_me(){
        $session_info = users::session_info();
        //Если не модер и не хозяин альбома, то идет лесом =)
        if (!$this->check_permissions()) return false;

        $user_item = new users($session_info['uid']);
        $user_item->del_photo_album($this->id);
        $this->db->update('photo_album',$this->id, array('i_del'=>1));
        return true;
    }


    /**
     * Проверяет права пользователя, админ он или хозяин объекта
     * в случае наличия таких прав возвращает true
     * @return bool
     */
    function check_permissions(){
        $result = false;
        $user = users::get(true);
        if (($user->id()==$this->data['fk_user'])&&($user->is_admin())) $result = true;
        return $result;
    }

    /**
     * Добавление загруженной фотографии к альбому
     * @param $id
     * @return bool
     */
    function add_photos($id){
        $tmpArr = unserialize($this->data['ser_photos']);

        if (count($tmpArr)<500){
            if (empty($this->data['ser_photos'])){
                $this->data['i_first_photo'] = $id;
                $this->data['i_last_photo'] = $id;
                $this->db->update('photo_album', $this->id, array('i_first_photo'=>$this->data['i_first_photo'], 'i_last_photo'=>$this->data['i_last_photo']));
            }else{
                $prev_photo = new photo_class($this->data['i_last_photo']);
                $prev_photo->set_next_photo_id($id);
                $prev_photo_info = $prev_photo->get_info();
                $next_photo = new photo_class($id);
                $next_photo->set_prev_photo_id($prev_photo_info['id']);
                reset($tmpArr);
                $this->data['i_first_photo'] = (int) current($tmpArr);
                $this->data['i_last_photo'] = $id;
                $this->db->update('photo_album', $this->id, array(
                    'i_first_photo' => $this->data['i_first_photo'],
                    'i_last_photo'=>$this->data['i_last_photo']
                ));
            }

            $tmpArr[] = $id;
            $this->data['ser_photos'] = serialize($tmpArr);
            $this->db->update('photo_album', $this->id, array('ser_photos'=>$this->data['ser_photos']));
            return true;
        }else{
            return false;
        }
    }

    function del_photo($id){
        $this->get_info();
        $photos_array = array_values(unserialize($this->data['ser_photos']));
        array_unique($photos_array);
        unset($photos_array[array_search($id, $photos_array)]);
        $this->data['ser_photos'] = serialize($photos_array);
        $this->db->update('photo_album', $this->id, array('ser_photos'=>$this->data['ser_photos']));
        if ($id==$this->data['fk_photo_cover']){
            if (0!=count($photos_array)){
                $this->set_default_photo(current($photos_array));
            }else{
                $this->data['fk_photo_cover'] = 0;
                $this->db->update('photo_album', $this->id,
                    array(
                    'fk_photo_cover'=>$this->data['fk_photo_cover'],
                    'vc_url100x100_photo_cover'=>'',
                    'vc_url199x139_photo_cover'=>'',
                    'fk_first_photo_comment'=>0,
                    'fk_last_photo_comment'=>0
                    )
                );
            }
        }else{
                reset($photos_array);
                $arr_to_update =array(
                    'fk_first_photo_comment'=>(int) current($photos_array),
                    'fk_last_photo_comment'=>(int) end($photos_array)
                );
                $this->db->update('photo_album', $this->id, $arr_to_update);
        }
        $this->get_info();
    }

    function set_default_photo($id){
        $this->data['fk_photo_cover'] = $id;
        //$this->data['vc_url100x100_photo_cover'] = $url;
        $this->db->update('photo_album', $this->id, array('fk_photo_cover'=>$this->data['fk_photo_cover']));
        return true;
    }

    /**
     * Устанавливает значения для полей фотоальбома
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
        $this->db->update('photo_album', $this->data['id'], $array_to_change);
    }

    /**
     * Переименовывает альбом
     * @param $name
     */
    function set_name($name){
        $name = htmlspecialchars(strip_tags($name));
        if (iconv_strlen($name)>30) $name = iconv_substr($name, 0, 30).'...';
        if (empty($name)) $name = 'без названия';
        if (!$this->check_permission()) return false;
        $this->set_fields(array('ch_name'=>$name));
        return true;
    }


}