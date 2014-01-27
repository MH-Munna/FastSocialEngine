<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 27.12.13
 * Time: 20:50
 */


include '../../engine/engine.inc.php';
$session_info = users::session_info();

$video=new video;

//if($_REQUEST['delete']&&$_REQUEST['id']){
//    switch($video->delete((int)$_REQUEST['id'])){
//        case '1':echo 'Неверный ID видео';break;
//        case '2':echo 'Данного видео нету у вас в коллекции';break;
//        case '0':echo 'Видео успешно удалено';break;
//    }
//    die();
//}
//if($_REQUEST['add']&&$_REQUEST['id']){
//    switch($video->add((int)$_REQUEST['id'])){
//        case '1':echo 'Неверный ID видео';break;
//        case '2':echo 'Данное видео уже у вас в коллекции';break;
//        case '0':echo 'Видео успешно доабвлено';break;
//    }
//    die();
//}


$result = array();

switch (@$_REQUEST['action']) {
    case 'delete':
            $result = $video->delete((int)$_REQUEST['id']);
        break;
    case 'add':
            $vi=new video;
            $video=$vi->load($_REQUEST['url'],$_REQUEST['name'],$_REQUEST['text']);
            $result['text']='<h1>Видео успешно загружено</h1>';
        break;
    case 'editInfo':
            $result = $video->edit((int)$_REQUEST['id'], $_REQUEST['name'], $_REQUEST['description']);
        break;
    case 'copyVideo':
            $vi = new video((int)$_REQUEST['id']);
            $vi->copy();
            $result['result'] = 0;
            $result['text'] = 'Добавлено';
        break;
}

echo json_encode($result);