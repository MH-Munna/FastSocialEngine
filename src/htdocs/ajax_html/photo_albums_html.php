<?php
/**
 * Данный файл возвращает аяксом страницу со списком фотоальбомов пользователя по запросу
 * User: user
 * Date: 02.08.13
 * Time: 10:43
 * To change this template use File | Settings | File Templates.
 */

include '../../engine/engine.inc.php';

users::session_info();

$view_profile_id = (int)$_REQUEST['uid'];

if (0 == $view_profile_id) {
    $user = users::get(true);
    $view_profile_id = $user->id();
}

$opened_profile = new users($view_profile_id);

/**
 * Получаем информацию о существующих фотоальбомах
 */
foreach ($opened_profile->get_photo_albums() as $album_item_id) {
    $album = new photo_album_class($album_item_id);
    $result['photo_albums'][] = $album->get_info();
}

$op['info'] = $opened_profile->get_info();

$op['photo_albums'] = $result['photo_albums'];

$smarty->assign('op', $op);

$smarty->display('photo/photo_album_tab.tpl');