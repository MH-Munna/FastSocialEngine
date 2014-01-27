<?php
/**
 * Arthur Osipyan (Taganrog 2013)
 * arthur@osipyan.ru
 * Created by PhpStorm.
 * User: user
 * Date: 22.11.13
 * Time: 14:39
 * File: actions.php
 */

include '../../../engine/engine.inc.php';
$sess = users::session_info();

$result = array();

switch($_REQUEST['action']){
    case 'dialog_start':
        $uid = (int) $_REQUEST['uid'];
        if ($uid!=0){
        $result = dialog::create()->start($uid);
        }else{
        $result['error'] = 'bad uid';
        }
        break;
    case 'dialog_get_all':
        $result = dialog::create()->get_all();
        break;
    case 'message_add':
        $message = $_POST['message'];
        $dialog_id = $_POST['dialog_id'];
        $result = message::create()->add($message,$dialog_id);
        break;
    case 'message_get_after':
        $result = message::create()->get_after(0,5);
        break;
}

echo json_encode($result);