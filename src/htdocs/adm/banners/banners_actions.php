<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 27.11.13
 * Time: 3:23
 */

include '../../../engine/engine.inc.php';
include '../../../engine/admin_include.php';

switch($_REQUEST['action']){
    case 'add':
        $ban_info = banner::banner_add()->get_info();
        header('location: '.base_site_url.'/adm/banners/banner_edit.php?id='.$ban_info['id']);
    break;
    case 'delete':
        $ban = new banner($_REQUEST['ban_id']);
        $ban->banner_delete();
        header('location: '.base_site_url.'/adm/banners/banners.php');
    break;
    case 'get_list':
        $banners = banner::get_banner_for(1);
        var_dump($banners);
        break;
    case 'edit_banner':
        $ban = banner::get_banner_by_id($_REQUEST['id']);
        $ban->set_fields($_REQUEST['ban']);
        header('location: '.base_site_url.'/adm/banners/banners.php');
        break;
    case 'upload_banner':
        $ban = new banner($_REQUEST['ban_id']);

        $tmpFile['tmp_name'] = $_FILES['ban']['tmp_name'];
        $info = getimagesize($tmpFile['tmp_name']); //получаем размеры картинки и ее тип
        $ext = '';
        if ($info['mime'] == 'image/jpeg') $ext = 'jpg';
        if ($info['mime'] == 'image/png') $ext = 'png';

        if (!empty($ext)){
            $ban->upload_banner($_FILES['ban']['tmp_name'], $ext);
        }
        $ban->set_fields(array('vc_type'=>$ext));
        header('location: '.base_site_url.'/adm/banners/banner_edit.php?id='.$_REQUEST['ban_id']);
        break;
    case 'del_image':
        $ban = new banner($_REQUEST['ban_id']);
        $ban->set_fields(array(
            'vc_url_content' => '',
            'vc_type' => '',
        ));
        header('location: '.base_site_url.'/adm/banners/banner_edit.php?id='.$_REQUEST['ban_id']);
        break;
}
