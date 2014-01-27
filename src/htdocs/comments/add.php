<?php
include '../../engine/engine.inc.php';
//$session_info = users::session_info();

$tmp_com=comment::create()->add(
        (int)$_REQUEST['id'],
        $_REQUEST['type'],
        (int)$_REQUEST['user_id'],
        $_REQUEST['text'],
        (int)$_REQUEST['parent']
      );

$smarty->assign('con', $tmp_com);
$smarty->display('comments/item.tpl');
