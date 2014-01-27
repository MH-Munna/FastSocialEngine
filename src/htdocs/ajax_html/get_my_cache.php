<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 23.12.13
 * Time: 2:00
 */

include '../../engine/engine.inc.php';
$session_info = users::session_info();

$user = new users($session_info['uid']);

$smarty->assign('user_info',  $user->get_info());
$smarty->assign('unpaid_items',  invoice_class::get_invoices_for_user($session_info['uid']));
$smarty->display('cache/main.tpl');
?>
