<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 06.08.13
 * Time: 22:14
 * To change this template use File | Settings | File Templates.
 */

include '../../engine/engine.inc.php';
$sess = users::session_info();

$user_id = (int) $_POST['user_id'];
$result = false;

if (!empty($user_id)){
    $user = new users($user_id);
    switch (@$_POST['action']) {
        case 'add':
            $result = $user->add_request_to_friend($sess['uid']); //отправляем заявку в друзья
            break;
        case 'del':
            $result = $user->del_friend($sess['uid']);
            break;
    }
}
echo json_encode($result);