<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 29.12.13
 * Time: 5:10
 */

include '../../engine/engine.inc.php';
$session_info = users::session_info();

$video=new video($_REQUEST['id']);

switch($_REQUEST['action']){
    case 'editForm':
        if (!$video->check_permissions()) die('access denied');
        $vi = $video->get_info();
        $smarty->assign('video',$vi);
        $smarty->display('videos/video_edit_form.tpl');
        break;
}

