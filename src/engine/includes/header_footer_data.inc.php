<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 12.07.13
 * Time: 15:47
 * To change this template use File | Settings | File Templates.
 */

$session_info = users::session_info(false);

if ($session_info['logged']){
    $user = new users($session_info['uid']);
    $u['info'] = $user->get_info();
    $smarty->assign('u', $u);
    $i['base_url'] = base_site_url;
    $i['gp']['totalGroups'] = (int) db::create()->get_global_parameter('totalGroups');
    $smarty->assign('i', $i);

//    $opened_profile = (int) @$_REQUEST['opened_profile'];
//    if (0==$opened_profile){$opened_profile = (int) @$_GET['profile'];;}
//    if (0==$opened_profile){$opened_profile = $session_info['uid'];}
//    $opened_profile_info = new users($opened_profile);
//
//    $smarty->assign('session_uid',  $session_info['uid']);
//    $smarty->assign('opened_profile', $opened_profile);
//    $smarty->assign('opened_profile_info', $opened_profile_info->get_info());
//    #$smarty->assign('profile_wall_items', $opened_profile_info->get_wall_items(0, 10));
//    $smarty->assign('profile_friends', $opened_profile_info->get_friends());
}