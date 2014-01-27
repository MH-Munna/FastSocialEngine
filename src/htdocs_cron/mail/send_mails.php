<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 05.01.14
 * Time: 7:06
 */

include '../../engine/engine.inc.php';

$result = array();

if (!empty($_REQUEST['mailID'])){
    $mailID = $_REQUEST['mailID'];
    $result = send_mail::send_mail_by_id($mailID);
}else{
    $result = send_mail::send_mails(100);
}

echo json_encode($result);