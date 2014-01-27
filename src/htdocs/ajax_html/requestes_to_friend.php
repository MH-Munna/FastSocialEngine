<?php
/**
 * Created by PhpStorm.
 * User: Spectrum
 * Date: 07.11.13
 * Time: 19:38
 */

include '../../engine/engine.inc.php';
$sess = users::session_info();

$user = new users($sess['uid']);
$smarty->assign('requests', $user->get_requestes_to_friend());
$smarty->display('friends/requestes.tpl');