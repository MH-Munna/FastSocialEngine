<?php
/**
 * Created by PhpStorm.
 * User: Spectrum
 * Date: 27.11.13
 * Time: 17:55
 */

include '../../engine/engine.inc.php';
include '../../engine/admin_include.php';

if ($_REQUEST['id']){
$banner = banner::get_banner_by_id($_REQUEST['id']);
}
$smarty->assign('banner', $banner->get_info());
$smarty->display('admin/banner_edit.tpl');