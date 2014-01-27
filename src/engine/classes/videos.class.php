<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Spectrum
 * Date: 25.09.13
 * Time: 17:30
 * To change this template use File | Settings | File Templates.
 */

/*<iframe id="ytplayer" type="text/html" width="640" height="360"
src="https://www.youtube.com/embed/M7lc1UVf-VE"
frameborder="0" allowfullscreen>*/
class video{
    private $id=false, $data=array(), $db,$sv;

    function __construct($id = false){
        $this->db=db::create();
        $this->sv=db::sv();
        $this->id=$id;
        return $this->get_info();
    }

    /**
     * Добавляет ролик с ютьюба к себе на страницу
     * @param $url
     * урл до ролика на тюбике
     * @param $name
     * название
     * @param string $text
     * описание ролика
     * @return array|bool
     * возвращает массив с ключем ID - обственно ID нового ролика
     */
    function load($url,$name,$text=''){
        $url=preg_replace('/(.*)v=([^&]+)(.*)/','$2',$url);
        $video=$this->db->insert('video',array(
            'url'=>'http://www.youtube.com/embed/'.$url,
            'name'=>$this->db->quote(strip_tags($name)),
            'text'=>$this->db->quote(strip_tags($text)),
            'img'=>'http://i1.ytimg.com/vi/'.$url.'/mqdefault.jpg',
            'view'=>0
            ));
        $this->sv->insert('sv_video',array(
            $video['id']=>array(
                'user_id' => users::get()->id(),
                'vc_name' => $video['name'],
                'text_description' => $video['text']
                )
            ),array('video_id','user_id', 'vc_name', 'text_description'));

        return $video;
    }


    /*
     *     function load($url,$name,$text=''){
        $url=preg_replace('/(.*)v=([^&]+)(.*)/','$2',$url);
        $video=$this->db->insert('video',array(
            'url'=>'http://www.youtube.com/embed/'.$url,
            'name'=>$this->db->quote(strip_tags($name)),
            'text'=>$this->db->quote(strip_tags($text)),
            'img'=>'http://i1.ytimg.com/vi/'.$url.'/mqdefault.jpg',
            'view'=>0
            ));
        $this->sv->insert('sv_video',
                                array(
                                    $video['id'],
                                    users::get()->id(),
                                    $video['name'],
                                    $video['text'],
                                ),
                                array('video_id','user_id', 'vc_name', 'text_description'));

        return $video;
    }

     */
    
    function delete($id){
        if(!(int)$id)return 1;
        if(!db::sv()->getcount('sv_video',array(users::get()->id(),$id), array('user_id', 'id'))) return 2;
        $this->sv->delete('sv_video',array(
            $id=>array(
                'user_id'=>users::get()->id()
                )
            ),array('id','user_id'));
        return 0;
    }

    /**
     * Редактирование ролика
     * Внутри производится проверка прав доступа
     * @param $id
     * id связки
     * @param $name
     * новое название
     * @param $description
     * описание
     * @return int
     * В случае успеха возвращает 0
     */
    function edit($id, $name, $description){
        if(!(int)$id)return 1;
        if(!db::sv()->getcount('sv_video',array(users::get()->id(),$id), array('user_id', 'id'))) return 2;

        $this->db->update('sv_video', $id,
            array(
                'vc_name' => strip_tags($name),
                'text_description' => strip_tags($description)
            )
        );
        return 0;
    }

    /**
     * Проверка прав доступа, с учетом админских привилегий
     * @return bool
     * true - если разрешение есть
     * false - доступ закрыт
     */
    function check_permissions(){
        $result = false;
        $tmp = $this->get_info();
        $user_info = users::get()->get_info();
        if ($user_info['i_admin']==1) $result = true;
        if ($user_info['id']==$tmp['user_id']) $result = true;
        return $result;
    }

    function add($id){
        if(!(int)$id)return 1;
        if(db::sv()->getcount('sv_video',array(users::get()->id(),$id)))return 2;
        $this->sv->insert('sv_video',array(
            $id=>array(
                'user_id'=>users::get()->id()
                )
            ),array('video_id','user_id'));
        return 0;
    }

    /**
     * Возвращает колличество видеозаписей у пользователя
     * @param $uid
     * @return mixed
     */
    function getcount($uid){
        return (int) $this->sv->getcount('sv_video',array($uid), array('user_id'));
    }
    
    function get($vid_id){
        $video=$this->db->getone('video',$vid_id);
        return $video;
    }

    //function
    function getall($user_id){
        $videos=$this->sv->getall('sv_video',$user_id,'user_id');
        foreach($videos as &$item){
            $item['sv']=$this->get($item['video_id']);
        }
        return $videos;
    }
    
    function get_info(){
        if (empty($this->id)) return false;
        // Если data пустой то выборка из БД/кэша
        if(empty($this->data)){
            $this->data=$this->db->getone('sv_video', $this->id);
            $this->data['sv']=$this->db->getone('video', $this->data['video_id']);
        }
        return $this->data;
    }

    /**
     * Накручивает счетчик просмотров фотографии на +1
     */
    function register_view(){
        $arr_to_update = array();
        //Счетчик просмотров
        $this->data['sv']['view']++;

        $arr_to_update['view'] = $this->data['sv']['view'];

        $this->db->update('video', $this->data['sv']['id'], $arr_to_update);
    }

    function copy(){
        $this->get_info();
        $this->sv->insert('sv_video',array(
            $this->data['sv']['id']=>array(
                'user_id' => users::get()->id(),
                'vc_name' => $this->data['sv']['name'],
                'text_description' => $this->data['sv']['text']
            )
        ),array('video_id','user_id', 'vc_name', 'text_description'));

        return 0;
    }


}