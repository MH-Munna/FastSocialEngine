<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Spectrum
 * Date: 20.09.13
 * Time: 1:42
 * To change this template use File | Settings | File Templates.
 */

include '../../engine/engine.inc.php';

$session_info = users::session_info();

$result = '';

$app_id = (int) $_POST['app_id'];
$app_name = $_POST['app_name'];
$app_fburl = $_POST['app_fburl'];
$app_type = $_POST['app_type'];
$app_url = $_POST['app_url'];

if (0==$app_id) die('Bad request');

$app = new apps($app_id);
$app_info = $app->get_info();

if ($app_info['fk_user']!=$session_info['uid']) die('Bad request');

$app->set_field('app_name', $app_name);
$app->set_field('fburl', $app_fburl);
$app->set_field('app_iframe_url', $app_url);

switch($app_type){
    case 'iFrame':
            $app->set_field('app_type', 1);
        break;
    case 'SWF':
            $app->set_field('app_type', 0);
        break;
}

$result['result'] = 'ok';

echo json_encode($result);