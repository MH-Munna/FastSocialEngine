<?php

include '../../engine/engine.inc.php';
$session_info = users::session_info();

if($_REQUEST['url']&&$_REQUEST['name']){
    $vi=new video;
    $video=$vi->load(mysql_escape_string($_REQUEST['url']),mysql_escape_string($_REQUEST['name']),mysql_escape_string($_REQUEST['text']));
    $video['text']='<h1>Видео успешно загружено</h1>';
    echo json_encode($video);
    die();
}

$smarty->display('videos/video_load.tpl');
