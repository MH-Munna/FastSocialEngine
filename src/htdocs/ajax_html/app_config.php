<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Spectrum
 * Date: 21.08.13
 * Time: 23:35
 * To change this template use File | Settings | File Templates.
 */
//TODO: Сделать проверку на принадлежность приложения пользователю

include '../../engine/engine.inc.php';
$session_info = users::session_info();

$result = array();
$result['app_id'] = (int) $_POST['app_id'];
$result['app_info'] = array();
$result['uid'] = $session_info['uid'];

if ($result['app_id']>0){
$app = new apps($result['app_id']);
$result['app_info'] = $app->get_info();
}

$smarty->assign('app_config', $result);
$smarty->display('apps/app_config.tpl');