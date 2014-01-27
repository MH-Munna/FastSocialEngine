<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 26.11.13
 * Time: 0:55
 */


include '../../../engine/engine.inc.php';
$sess = users::session_info();

$result = array();
$dialog_id = (int) $_REQUEST['dialog_id'];
switch($_REQUEST['action']){
    case 'dialog_update_message_list':
        $d['messages']=message::create()->get_after(0,$dialog_id, 0);
        $smarty->assign('d', $d);
        $smarty->display('dialogs/messages.tpl');
        break;
    case 'chat_tab_dialog_list_update':
        $d['dialogs']=dialog::create()->get_all();
        $smarty->assign('d', $d);
        $smarty->display('dialogs/dialogs_list.tpl');
        break;
}