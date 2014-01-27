<?php
/**
 * Created by PhpStorm.
 * User: Spectrum
 * Date: 09.11.13
 * Time: 12:59
 */

include '../../engine/engine.inc.php';

$profile_user = users::session_info();
$view_profile_id = (int) $_REQUEST['profile'];
//А нефиг без ID заходить сюда, пусть прогуляется
if (0!=$view_profile_id){
    $opened_profile = new users($view_profile_id);

    $smarty->assign('opened_profile_info', $opened_profile->get_info());
    $smarty->assign('friendship', $opened_profile->check_friendship());
    $smarty->display('friends/button_add_friend.tpl');
}

