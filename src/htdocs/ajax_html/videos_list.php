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
 * Получаем информацию о существующих видеозаписях
 */
$vi = new video;
$op['videos'] = $vi->getall($view_profile_id);
$op['videos_count'] = $vi->getcount($view_profile_id);

$op['info'] = $opened_profile->get_info();

$smarty->assign('op', $op);

$smarty->display('videos/videos_tab.tpl');