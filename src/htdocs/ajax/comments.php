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
    case 'add_comment':
        $result=comment::create()->add(
            (int)$_REQUEST['id'],
            $_REQUEST['type'],
            (int) $user->id(),
            $_REQUEST['text'],
            (int)$_REQUEST['parent']
        );
        break;
    case 'delete_comment':
        $result['id']=comment::create()->delete(
            (int)$_REQUEST['id']
        );
        break;
}

echo json_encode($result);