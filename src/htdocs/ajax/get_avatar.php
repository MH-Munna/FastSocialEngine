<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Spectrum
 * Date: 06.09.13
 * Time: 3:28
 * To change this template use File | Settings | File Templates.
 */

include '../../engine/engine.inc.php';
$session_info = users::session_info();

$result = array();

$uid = (int) $_POST['uid'];
if (0==$uid) die;

$user = new users($uid);
$user_info = $user->get_info();

$result['avatar_url_233x233'] = $user_info['avatar_url233x233'];
$result['avatar_url_50x50'] = $user_info['avatar_url50x50'];

echo json_encode($result);