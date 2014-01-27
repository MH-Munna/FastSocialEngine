<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 02.08.13
 * Time: 10:43
 * To change this template use File | Settings | File Templates.
 */

include '../../engine/engine.inc.php';
$session_info = users::session_info();

$result = array();
$result['apps'] = array();

$result['uid'] = (int) @$_REQUEST['opened_profile'];
if (0==$result['uid']) $result['uid'] = $session_info['uid'];
$user_item = new users($result['uid']);

foreach($user_item->get_apps() as $apps_item_id){
    $app = new apps($apps_item_id);
    $result['apps'][] = $app->get_info();
}
$op['apps'] = get_installed_apps_info_by_uid($result['uid']);
$op['info'] = $user_item->get_info();

$smarty->assign('op', $op);
$smarty->display('apps/apps_tab.tpl');