<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Spectrum
 * Date: 28.07.13
 * Time: 13:38
 * To change this template use File | Settings | File Templates.
 */

include '../../engine/engine.inc.php';
$session_info = users::session_info();

$result = array();

switch (@$_REQUEST['action']) {
    case 'create_album':
            $result['uid'] = $session_info['uid'];
            $photo_album = new photo_album_class();
            $result['new_album_id'] = $photo_album->create_album($result['uid']);
        break;
    case 'del_photo_album':
            $album_id = (int) $_REQUEST['albumId'];
            if (0 == $album_id) break;
            $p_album = new photo_album_class($album_id);
            if ($p_album->get_info()){
                if ($p_album->check_permissions()){
                    $result = $p_album->del_me();
                }else{
                    $result['error'] = 'access denied';
                }
            }else{
                $result['error'] = 'album not found';
            }
        break;
    case 'del_photo':
            $photo_id = (int) $_REQUEST['photoId'];
            if (0 == $photo_id) break;
            $photo = new photo_class($photo_id);
            //Нет прав на фото? тогда и делать тут нечего:
            if (!$photo->check_permissions()) break;
            $photo_info = $photo->get_info();
            $result['after_del']['redirect'] = true;
            $result['after_del']['albumID'] = $photo_info['fk_photo_album'];
            if (!empty($photo_info['i_prev_photo'])){
                $result['after_del']['redirect'] = false;
                $result['after_del']['openphoto'] = $photo_info['i_prev_photo'];
            }
            if (!empty($photo_info['i_next_photo'])){
                $result['after_del']['redirect'] = false;
                $result['after_del']['openphoto'] = $photo_info['i_next_photo'];
            }
            $photo->del_me();
        break;
    case 'rename_album':
            $album_ID = (int) $_REQUEST['albumID'];
            if (0 == $album_ID) break;
            $photo_album = new photo_album_class($album_ID);
            if (!$photo_album->check_permission()) break;
            $photo_album->set_name($_REQUEST['textDescription']);
        break;
}

echo json_encode($result);