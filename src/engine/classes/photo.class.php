<?php
/**
 * Класс реализует работу с фотографиями.
 * Масштабирование фотографий, загрузка фотографий в альбомы, распределение фотографий по работающим на данный момент серверам фотографий
 * User: osipyan
 * Date: 12.06.13
 * Time: 21:40
 * To change this template use File | Settings | File Templates.
 */

class photo_class{
    private $id=false, $data=array(), $db;
    static $sizes = array(
        'photo' => array(
            array('x' => null, 'y' => null, 'name'=>null),
            array('x' => '100', 'y' => '100', 'name'=>'100x100'),
            array('x' => '199', 'y' => '139', 'name'=>'199x139'),
            array('x' => '640', 'y' => '610', 'name'=>'640x610'),
        ),
        'avatar' => array(
            array('x' => null, 'y' => null, 'name'=>null),
            array('x' => '50', 'y' => '50', 'name'=>'50x50'),
            array('x' => '233', 'y' => '233', 'name'=>'233x233'),
        ),
        'all' => array(
            array('x' => null, 'y' => null, 'name'=>null),
            array('x' => '50', 'y' => '50', 'name'=>'50x50'),
            array('x' => '100', 'y' => '100', 'name'=>'100x100'),
            array('x' => '199', 'y' => '139', 'name'=>'199x139'),
            array('x' => '233', 'y' => '233', 'name'=>'233x233'),
            array('x' => '640', 'y' => '610', 'name'=>'640x610'),
        )
    );

    function __construct($id = false){
        $this->db=db::create();
        $this->id=$id;
        return $this->get_info();
    }

    function get_info(){
        if (empty($this->id)) return false;
        // Если data пустой то выборка из БД/кэша
        if(empty($this->data)){
            $this->data=$this->db->getone('photo', $this->id);
        }

        $arr_to_update = array();
        foreach (photo_class::$sizes['all'] as $size){
            if (!empty($this->data['fileName'.$size['name']])){ //Если есть пережатая картинка то высчитываем ее URL
                $this->data['vc_url'.$size['name']] = servers_class::get_server_url($this->data['fk_server']).$this->data['dirName'].'/'.$this->data['fileName'.$size['name']];
                $arr_to_update['vc_url'.$size['name']] = $this->data['vc_url'.$size['name']];
            }
        }
        $this->db->update('photo', $this->id, $arr_to_update);
        return $this->data;
    }

    //Возвращает тру или фолз проверяя картинка ли находится по пути path
    static function is_picture($path){
        $info = getimagesize($path); //получаем размеры картинки и ее тип
        $res = array();
        if ($info['mime'] == 'image/png') {
            $res['pic'] = true;
            $res['ext'] = 'png';
        } else if ($info['mime'] == 'image/jpeg') {
            $res['pic'] = true;
            $res['ext'] = 'jpg';
        } else {
            $res['pic'] = false;
        }
        return $res;
    }

    static function create_thumbnail($path, $save, $width, $height) {
        $info = getimagesize($path); //получаем размеры картинки и ее тип
        $size = array($info[0], $info[1]); //закидываем размеры в массив

        //В зависимости от расширения картинки вызываем соответствующую функцию
        if ($info['mime'] == 'image/png') {
            $src = imagecreatefrompng($path); //создаём новое изображение из файла
        } else if ($info['mime'] == 'image/jpeg') {
            $src = imagecreatefromjpeg($path);
        } else if ($info['mime'] == 'image/gif') {
            $src = imagecreatefromgif($path);
        } else {
            return false;
        }

        $thumb = imagecreatetruecolor($width, $height); //возвращает идентификатор изображения, представляющий черное изображение заданного размера
        $src_aspect = $size[0] / $size[1]; //отношение ширины к высоте исходника
        $thumb_aspect = $width / $height; //отношение ширины к высоте аватарки

        if ($src_aspect < $thumb_aspect) {
        //узкий вариант (фиксированная ширина)
              $scale = $width / $size[0];
                 $new_size = array($width, $width / $src_aspect);
                $src_pos = array(0, ($size[1] * $scale - $height) / $scale / 2);
        //Ищем расстояние по высоте от края картинки до начала картины после обрезки
        }
        else if ($src_aspect > $thumb_aspect) {

        //if($src_aspect < $thumb_aspect) {
            //широкий вариант (фиксированная высота)
            $scale = $height / $size[1];
            $new_size = array($height * $src_aspect, $height);
            $src_pos = array(($size[0] * $scale - $width) / $scale / 2, 0); //Ищем расстояние по ширине от края картинки до начала картины после обрезки
        } else {
            //другое
            $new_size = array($width, $height);
            $src_pos = array(0,0);
        }

        $new_size[0] = max($new_size[0], 1);
        $new_size[1] = max($new_size[1], 1);

        imagecopyresampled($thumb, $src, 0, 0, $src_pos[0], $src_pos[1], $new_size[0], $new_size[1], $size[0], $size[1]);
        //Копирование и изменение размера изображения с ресемплированием

        if($save === false) {
                if ($info['mime'] == 'image/png') {
                    return imagepng($thumb);//Сохраняет JPEG/PNG/GIF изображение
                } else if ($info['mime'] == 'image/jpeg') {
                    return imagejpeg($thumb);//Сохраняет JPEG/PNG/GIF изображение
                } else if ($info['mime'] == 'image/gif') {
                    return imagegif($thumb);//Сохраняет JPEG/PNG/GIF изображение
                } else {
                    return false;
                }
        } else {
                if ($info['mime'] == 'image/png') {
                    return imagepng($thumb, $save);//Сохраняет JPEG/PNG/GIF изображение
                } else if ($info['mime'] == 'image/jpeg') {
                    return imagejpeg($thumb, $save);//Сохраняет JPEG/PNG/GIF изображение
                } else if ($info['mime'] == 'image/gif') {
                    return imagegif($thumb, $save);//Сохраняет JPEG/PNG/GIF изображение
                } else {
                    return false;
                }
        }

    }

    static function upload($db, $sizes_name='photo', $tmp_name, $ext='jpg'){
        $srv = new servers_class(servers_class::find_server_by_type(2));
        $srv_info = $srv->get_info();

        $dirName = rand(1000, 2000);

        foreach (photo_class::$sizes[$sizes_name] as $size){
            $tmpFile['fileName'.$size['name']]['tmp_name'] = tempnam('/tmp', 'avatar');
            $tmpFile['fileName'.$size['name']]['name'] = create_password(5).'-'.create_password(5).$size['name'].'.'.$ext;
            $tmpFile['fileName'.$size['name']]['size_name'] = $size['name'];
            if (!empty($size['x'])){
                photo_class::create_thumbnail($tmp_name,  $tmpFile['fileName'.$size['name']]['tmp_name'], $size['x'], $size['y']);
            }else{
                copy($tmp_name, $tmpFile['fileName'.$size['name']]['tmp_name']);
            }
            uploadftp($srv->get_first_ip(), $srv_info['vc_ftp_user'], $srv_info['vc_ftp_pass'], $srv_info['vc_ftp_path'], $dirName, $tmpFile['fileName'.$size['name']]);
        }
        return array('srv_info'=>$srv_info, 'dirName'=>$dirName, 'tmpFile' => $tmpFile);
    }

    static function upload_photo_to_avatar($fk_user, $tmp_name, $ext='jpg'){
        $db = db::create();
        $user = new users($fk_user);


        $res = photo_class::upload($db, 'avatar', $tmp_name, $ext);
        $srv_info = $res['srv_info'];
        $tmpFile = $res['tmpFile'];
        $dirName = $res['dirName'];

        $user->setAvatar(
            $srv_info['id'],
            $dirName,
            $srv_info['vc_baseurl'],
            $tmpFile
        );

        return true;
    }

    static function upload_photo_to_album($album_id, $fk_user, $tmp_name){
        $db = db::create();
        $user = new users($fk_user);
        $album = new photo_album_class($album_id);

        $res = photo_class::upload($db, 'photo', $tmp_name);
        $srv_info = $res['srv_info'];
        $tmpFile = $res['tmpFile'];
        $dirName = $res['dirName'];

        $arr_to_insert = array(
                'fk_user'=>$fk_user,
                'fk_photo_album'=>$album_id,
                'fk_server'=>$srv_info['id'],
                'dirName'=>$dirName,
                'ts_date'=>time()
        );

        foreach($tmpFile as $field => $file){
            $arr_to_insert[$field] = $file['name'];
        }

        $res = $db->insert('photo', $arr_to_insert);
        $album->add_photos($res['id']);
        $album->set_default_photo($res['id'], '');
        return true;
    }

    function set_prev_photo_id($id){
        $this->data['i_prev_photo'] = $id;
        $this->db->update('photo', $this->id, array('i_prev_photo'=>$this->data['i_prev_photo']));
    }

    function set_next_photo_id($id){
        $this->data['i_next_photo'] = $id;
        $this->db->update('photo', $this->id, array('i_next_photo'=>$this->data['i_next_photo']));
    }

    function del_me(){
        $arr_to_update = array('i_active'=>1);
        $this->db->update('photo', $this->id, $arr_to_update);

        if (0!=$this->data['i_prev_photo']){
            $this->db->update('photo', $this->data['i_prev_photo'], array('i_next_photo'=>$this->data['i_next_photo']));
            }

        if (0!=$this->data['i_next_photo']){
           $this->db->update('photo', $this->data['i_next_photo'], array('i_prev_photo'=>$this->data['i_prev_photo']));
            }

        $album = new photo_album_class($this->data['fk_photo_album']);
        $album->del_photo($this->id);
        return true;
    }

    function get_comments($c = 0){
        $result = array();
        $t = 0; //Счетчик подгруженных комментариев
        $next_comment_id = $this->data['fk_first_photo_comment'];
        if (0!=$this->data['fk_first_comment']){
            return $result;
        }
        while((($t<=$c)||($c==0))&(0!=$next_comment_id)){
            $t++;
            $comment_tmp = $this->get_comment_by_id($next_comment_id);
            $next_comment_id = $comment_tmp['i_next_comment'];
            $this->data['comments_array'][$comment_tmp['id']] = $comment_tmp;
        }
        return $this->data['comments_array'];
    }

    function get_comment_by_id($id){
        $tmp = $this->db->getone('photo_comments', $id);
        $user = new users($tmp['fk_user']);
        $tmp['user_info'] = $user->get_info();
        return $tmp;
    }

    function add_comment($fk_user, $text){
        $array_to_insert = array(
            'fk_photo'=>$this->id,
            'fk_user'=>$fk_user,
            'text'=>$text,
            'i_prev_comment'=>$this->data['fk_last_photo_comment'],
        );
        $new_comment = $this->db->insert('photo_comments', $array_to_insert);

        if (0!=$this->data['fk_last_photo_comment']){
            $this->db->update('photo_comments', $this->data['fk_last_photo_comment'], array('i_next_comment'=>$new_comment['id']));
        }

        if (0==$this->data['fk_first_photo_comment']){
            $this->data['fk_first_photo_comment'] = $new_comment['id'];
        }

        $this->data['fk_last_photo_comment'] = $new_comment['id'];
        $this->data['count_comments']++;

        $this->db->update('photo', $this->id, array(
                        'fk_last_photo_comment'=>$this->data['fk_last_photo_comment'],
                        'fk_first_photo_comment'=>$this->data['fk_first_photo_comment'],
                        'count_comments'=>$this->data['count_comments']
        ));
        return $new_comment['id'];
    }

    function del_comment($id){

        $comment_to_del = $this->get_comment_by_id($id);

        if (0!=$comment_to_del['i_prev_comment']){
            $this->db->update('photo_comments', $comment_to_del['i_prev_comment'], array('i_next_comment'=>$comment_to_del['i_next_comment']));
        }

        if (0!=$comment_to_del['i_next_comment']){
            $this->db->update('photo_comments', $comment_to_del['i_next_comment'], array('i_prev_comment'=>$comment_to_del['i_prev_comment']));
        }

        $this->db->update('photo_comments', $comment_to_del['id'], array('i_active'=>1));

        $this->data['count_comments']--;


        if ($id==$this->data['fk_first_photo_comment']) {$this->data['fk_first_photo_comment']=$comment_to_del['i_next_comment'];}
        if ($id==$this->data['fk_last_photo_comment']) {$this->data['fk_last_photo_comment']=$comment_to_del['i_prev_comment'];}

        $arr_to_update_photo = array(
            'count_comments'=>$this->data['count_comments'],
            'fk_first_photo_comment'=>$this->data['fk_first_photo_comment'],
            'fk_last_photo_comment'=>$this->data['fk_last_photo_comment'],
        );

        $this->db->update('photo', $this->id, $arr_to_update_photo);

        return 1;
    }

    /**
     * Накручивает счетчик просмотров фотографии на +1
     */
    function register_view(){
        $arr_to_update = array();
        //Счетчик просмотров
        $this->data['i_views']++;
        $arr_to_update['i_views'] = $this->data['i_views'];

        $this->db->update('photo', $this->id, $arr_to_update);
    }

    /**
     * Проверка прав доступа
     * @return bool
     */
    function check_permissions(){
        $result = false;
        $sess = users::get(true);
        if ($sess->id()==$this->data['fk_user']) $result = true;
      return $result;
    }
}