<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Spectrum
 * Date: 20.08.13
 * Time: 22:50
 * To change this template use File | Settings | File Templates.
 */

include '../../engine/engine.inc.php';
$session_info = users::session_info();

$result = array();

switch (@$_REQUEST['action']) {
    case 'create_app':
        $result['uid'] = $session_info['uid'];
        $app = new apps();
        $result['new_app'] = $app->create($result['uid']);
        break;
    case 'del_app':
        $app_id = (int) $_REQUEST['app_id'];
        $user = new users($session_info['uid']);
        $result = $user->del_apps($app_id);
        break;
    case 'add_app_to_me':
        $app_id = (int) $_REQUEST['app_id'];
        $user = new users($session_info['uid']);
        $result = $user->del_apps($app_id);
        break;
}

echo json_encode($result);