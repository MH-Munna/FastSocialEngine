<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 23.09.13
 * Time: 22:28
 * To change this template use File | Settings | File Templates.
 */

include '../../engine/engine.inc.php';
$session_info = users::session_info();

$user = new users($session_info['uid']);

$smarty->assign('user_info',  $user->get_info());
$smarty->display('config/main.tpl');
