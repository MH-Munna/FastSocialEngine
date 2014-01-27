<?php

include '../../engine/engine.inc.php';
$session_info = users::session_info();

$video=new video($_REQUEST['id']);
//Накручиваем счетчик просмотров
$video->register_view();

$vi = $video->get_info();

//$smarty->assign('get',db::sv()->getcount('sv_video',array(users::get()->id(),$vi['id'])));
$user = new users($vi['user_id']);
$op['info'] = $user->get_info();
$smarty->assign('op',$op);
$smarty->assign('video',$vi);
$smarty->display('videos/video_get.tpl');