<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 06.08.13
 * Time: 16:16
 * To change this template use File | Settings | File Templates.
 */

include '../../engine/engine.inc.php';
$session_info = users::session_info();

$result = array();

$startID = (int) $_POST['startID'];

$user = new users($session_info['uid']);
$smarty->assign('profile_wall_items', $user->get_wall_items($startID, 10));
$smarty->display('wall/wall_items.tpl');