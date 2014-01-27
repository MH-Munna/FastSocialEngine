<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Spectrum
 * Date: 24.08.13
 * Time: 16:28
 * To change this template use File | Settings | File Templates.
 */

include '../../engine/engine.inc.php';
$session_info = users::session_info();

$photoID = (int) $_POST['photoID'];

$photo = new photo_class($photoID);

//Накручиваем счетчик просмотров
$photo->register_view();

$photo_info = $photo->get_info();

$photo_album = new photo_album_class($photo_info['fk_photo_album']);
$photo_album_info = $photo_album->get_info();

$photos_in_album = array_values(unserialize($photo_album_info['ser_photos']));
$position = array_search($photoID, $photos_in_album);

$photo_info['count_photos'] = count($photos_in_album);
$photo_info['position_photo'] = $position+1;
$photo_info['vc_date'] = date('Y.m.d', $photo_info['ts_date']);

$photo_comments = $photo->get_comments();

$smarty->assign('photo_album',  $photo_album_info);
$smarty->assign('photo_info',  $photo_info);
$smarty->assign('photo_comments',  $photo_comments);

$smarty->display('photo/photo_popup_box.tpl');
