<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 02.08.13
 * Time: 12:26
 * To change this template use File | Settings | File Templates.
 */

include '../../engine/engine.inc.php';
$session_info = users::session_info();
$result = array();

$smarty->assign('session_uid',  $session_info['uid']);
$smarty->assign('opened_profile',  $opened_profile);

switch (@$_POST['tab']) {
    case 'main':
        break;
    case 'photo':
        break;
    case 'wall':
//            $user = new users($opened_profile);
//            $smarty->assign('profile_wall_items', $user->get_wall_items(0, 10));
//            $smarty->display('wall/main.tpl');
        break;
    case 'apps':
//            $smarty->assign('profile_apps', get_installed_apps_info_by_uid($opened_profile));
//            $smarty->display('apps/apps_main_old.tpl');
        break;
    case 'friends':
//            $usr = new users($opened_profile);
//            $smarty->assign('profile_friends', $usr->get_friends());
//            $smarty->display('friends/friends_list_old.tpl');
        break;
    case 'videos':
//            $vi=new video;
//            $smarty->assign('videos',$vi->getall($opened_profile));
//            $smarty->assign('count_video',$vi->getcount($opened_profile));
//            $smarty->display('videos/main.tpl');
        break;
}