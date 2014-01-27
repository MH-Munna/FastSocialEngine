<?php
/**
 * Данный файл выдает аяксом страницу с фотографиями выбранного альбома
 *
 * User: Spectrum
 * Date: 23.08.13
 * Time: 3:38
 * To change this template use File | Settings | File Templates.
 */

$result = array();

include '../../engine/engine.inc.php';
$session_info = users::session_info();

$opened_profile = (int) $_REQUEST['opened_profile'];
if (0==$opened_profile){$opened_profile = $session_info['uid'];}

$albumID = (int) $_REQUEST['albumID'];
$album = new photo_album_class($albumID);
$album_info = $album->get_info();

if (false == $album_info) die('album not found');

$photos_ids =  unserialize($album_info['ser_photos']);
$result['photos'] = array();

if (!empty($photos_ids))
foreach($photos_ids as $photo_id){
    $tmpPhoto = new photo_class($photo_id);
    $result['photos'][] = $tmpPhoto->get_info();
}

$smarty->assign('session_uid',  $session_info['uid']);
$smarty->assign('opened_profile', $opened_profile);
$smarty->assign('photos', $result['photos']);
$smarty->assign('photos_count', count($result['photos']));
$smarty->assign('albumName', $album_info['ch_name']);
$smarty->assign('albumID', $albumID);
$smarty->display('photo/photos_tab.tpl');
