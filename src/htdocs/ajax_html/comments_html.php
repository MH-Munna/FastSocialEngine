<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 26.12.13
 * Time: 16:25
 */

include '../../engine/engine.inc.php';
$session_info = users::session_info();

$result = array();

$comment_id = (int) $_REQUEST['commentId'];

if (0==$comment_id) die;


switch($_REQUEST['action']){
    case 'get_comment':
        $con = comment::create()->getone($comment_id);
        $smarty->assign('con', $con);
        $smarty->display('comments/item.tpl');
        break;
}

