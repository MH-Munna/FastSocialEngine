<?php
/**
 * Created by PhpStorm.
 * User: Spectrum
 * Date: 04.11.13
 * Time: 18:28
 */

include '../../engine/engine.inc.php';
$session_info = users::session_info();

$result = array();
$user = users::get(true);

switch($_REQUEST['action']){
    case 'create':
        $result = groups_class::create_group()->id();
        break;
}

echo json_encode($result);