<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Spectrum
 * Date: 28.07.13
 * Time: 13:38
 * To change this template use File | Settings | File Templates.
 */

include '../../engine/engine.inc.php';
$session_info = users::session_info();

switch (@$_POST['action']) {
    case 'get_comment':
        $photoId = (int) $_POST['photoId'];
        $commentId = (int) $_POST['commentId'];
        if (0==$photoId) {die;}
        $photo = new photo_class($photoId);
        $photo_info = $photo->get_info();
        $comment = $photo->get_comment_by_id($commentId);
        $smarty->assign('photo_info',  $photo_info);
        $smarty->assign('con',  $comment);
        $smarty->display('photo/photo_comment.tpl');
        break;
}