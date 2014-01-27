<?php
/* index.php */
include '../../engine/engine.inc.php';

users::session_info();

$view_profile_id = (int)$_REQUEST['profile'];
//А нефиг без ID заходить сюда, пусть прогуляется
if (0 == $view_profile_id) header('location: ' . base_site_url);

$opened_profile = new users($view_profile_id);

$op['info'] = $opened_profile->get_info();


if ($opened_profile->error_no){
    die($opened_profile->error_text);
}

if (1==$op['info']['i_group']){
    header('Location: /group/'.$op['info']['id']);
    die();
}

/**
 * Получаем информацию о существующих фотоальбомах
 */
foreach ($opened_profile->get_photo_albums() as $album_item_id) {
    $album = new photo_album_class($album_item_id);
    $result['photo_albums'][] = $album->get_info();
}


/**
 * Собираем информацию о диалогах
 */
$d['dialogs']=dialog::create()->get_all();

$tmp = current($d['dialogs']);
$d['selected_dialog'] = $tmp['id'];
$d['dialogs'][$tmp['id']]['selected'] = true;
$d['messages']=message::create()->get_after(0,$d['selected_dialog'], 0);

$smarty->assign('d', $d);

$op['friends'] = $opened_profile->get_friends();
$op['photo_albums'] = $result['albums'];
$op['apps']= get_installed_apps_info_by_uid($view_profile_id);

/**
 * Собираем информацию о видеозаписях
 */
$vi = new video;
$op['videos'] = $vi->getall($view_profile_id);
$op['videos_count'] = $vi->getcount($view_profile_id);


/**
 * Аудиозаписи
 */

$op['media']['playlists'] = media_class::get_playlists($view_profile_id);
$op['media']['tracks'] = media_class::get_playlist_content(0);


$op['friendship'] = $opened_profile->check_friendship();


$op['photo_albums'] = $result['photo_albums'];
if ($view_profile_id == $session_info['uid']) {
    $requestes_to_friend_count = count($opened_profile->get_requestes_to_friend());
    $op['requestes_to_friend'] = $user->get_requestes_to_friend();
} else {
    $requestes_to_friend_count = false;
}
$op['requestes_to_friend_count'] = $requestes_to_friend_count;

//Группы

$op['groups']['userGroups'] = groups_class::get_all_userGroups(users::get()->id());

$ban[1] = banner::get_banner_for(1);
$ban[2] = banner::get_banner_for(2);
$ban[3] = banner::get_banner_for(3);

$smarty->assign('ban', $ban);
$smarty->assign('op', $op);
$smarty->display('main/main.tpl');

