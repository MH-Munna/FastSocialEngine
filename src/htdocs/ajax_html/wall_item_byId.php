<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 06.08.13
 * Time: 16:42
 * To change this template use File | Settings | File Templates.
 */

include '../../engine/engine.inc.php';
$session_info = users::session_info();

$result = array();

$wall_item_ID = (int) $_POST['wallItemID'];

if (0==$wall_item_ID) die;

$user = new users($session_info['uid']);
$smarty->assign('profile_wall_items', array($user->get_wall_item_byId($wall_item_ID)));
$smarty->display('wall/wall_items.tpl');