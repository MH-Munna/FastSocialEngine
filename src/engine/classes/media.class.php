<?php
/**
 * Created by PhpStorm.
 * User: Spectrum
 * Date: 06.01.14
 * Time: 19:23
 */

class media_class{
    private $id=false, $data=array(), $db;

    function __construct($id = false){
        $this->db=db::create();
        $this->id=$id;
        return $this->get_info();
    }

    static function create($vc_name = 'noname', $text_description = '', $media_id, $user_id, $vc_type = 'audio', $playlist_id = 0){
        $db = db::create();
        $arr_to_insert = array(
            'media_id' => $media_id,
            'user_id' => $user_id,
            'vc_type' => $vc_type,
            'playlist_id' => $playlist_id,
            'ts_date' => time(),
            'vc_name' => $vc_name,
            'text_description' => $text_description
        );
        $result = $db->insert('sv_media', $arr_to_insert);
        return $result['id'];
    }

    function get_info(){
        if (empty($this->id)) return false;
        // Если data пустой то выборка из БД/кэша
        if(empty($this->data)){
            $this->data=$this->db->getone('sv_media', $this->id);
        }

        if(empty($this->data)) return false;

        if($this->data['media_id']){
            $this->data['sv_media']=$this->db->getone('media', $this->data['media_id']);
        }

        if($this->data['playlist_id']){
            $this->data['media_playlist']=$this->db->getone('media_playlist', $this->data['playlist_id']);
        }
        $this->data['media_url'] = $this->get_link();

        $datetime = new DateTime();
        $datetime->setTime(0, 0, (int) $this->data['sv_media']['i_duration']);
        $this->data['duration'] = $datetime->format('i:s');

        return $this->data;
    }

    function get_link(){
        if ($this->data['sv_media']){
            $key = md5($this->id.' '.$_SESSION['ip'].' '.rand(0, 100000));
            $arr_to_insert = array(
                'ip' => $_SESSION['ip'],
                'filePath' => $this->data['sv_media']['vc_filePath']
            );

            $srv = new servers_class($this->data['sv_media']['server_id']);
            $ip = $srv->get_first_ip();
            if ($ip){
                if (db::remoteMemcacheSet($key, $arr_to_insert, $ip, 11211)){
                    return servers_class::get_server_url($this->data['sv_media']['server_id']).$key;
                };
            }
            return false;
        }
        //$this->db->
    }

    function delete(){
        $this->db->delete('sv_media', $this->id);
        return true;
    }

    function move_to_playlist($pl_id){
        $arr_to_update = array('playlist_id'=>$pl_id);
        $this->db->update('sv_media', $this->id, $arr_to_update);
    }

    function rename($new_name = 'noname', $new_description = ''){
        $arr_to_update = array(
            'vc_type'=>$new_name,
            'text_description' => $new_description
        );
        $this->db->update('sv_media', $this->id, $arr_to_update);
    }

    function copy_to_playlist($uid, $playlist_id){
        $result = media_class::create($this->data['vc_name'], $this->data['text_description'], $this->data['media_id'], $uid, $this->data['vc_type'], $playlist_id);
        return $result;
    }

    // ----------------------------- PLAYLISTS -----------------------------------------------

    static function create_playlist($uid, $name = 'noname', $type = 'audio'){
        $db = db::create();
        $arr_to_insert = array(
            'user_id' => $uid,
            'vc_name' => $name,
            'vc_type' => $type,
            'ts_date' => time()
        );
        $result = $db->insert('media_playlist', $arr_to_insert);
        return $result['id'];
    }

    static function get_playlists($uid, $type = 'audio'){
        $result = array();
        $db = db::create();
        $dbRes = $db->query('SELECT * FROM media_playlist WHERE user_id = '.$db->quote($uid).' AND vc_type = '.$db->quote($type));
        if($dbRes){
            $result=$dbRes->fetchAll();
        }
        //добавляем дефолтный плейлист в начало списка
        array_unshift($result, array(
            'id' => 0,
            'vc_name' => 'Основной',
            'vc_type' => $type,
            'ts_date' => time(),
            'i_del' => 0
        ));
        return $result;
    }

    static function rename_playlist($pl_id, $new_name = 'noname'){
        if (0==$pl_id) return false;
        $db = db::create();
        $arr_to_update = array(
            'vc_name' => $new_name,
        );
        $db->update('media_playlist', $pl_id, $arr_to_update);
        return true;
    }

    static function get_playlist_content($pl_id){
        $result = array();
        $db = db::create();
        $dbRes = $db->query('SELECT id FROM sv_media WHERE playlist_id = '.$db->quote($pl_id));
        if($dbRes){
            $ids=$dbRes->fetchAll();
        }
        foreach($ids as $playlist_item_id){
            $tmp_media_obj = new media_class($playlist_item_id['id']);
            $result[] = $tmp_media_obj->get_info();
            unset($tmp_media_obj);
        }
        return $result;
    }

    static function delete_playlist($pl_id){
        if (0==$pl_id) return false;
        $db = db::create();
        $pl_content = media_class::get_playlist_content($pl_id);
        foreach($pl_content as $pl_item){
            $tmp_media_object = new media_class($pl_item['id']);
            $tmp_media_object->delete();
            unset($tmp_media_object);
        }
        $db->delete('media_playlist', $pl_id);
        return true;
    }
}