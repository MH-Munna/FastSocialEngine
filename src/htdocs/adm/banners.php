<?php
/**
 * Created by PhpStorm.
 * User: Spectrum
 * Date: 27.11.13
 * Time: 17:55
 */

include '../../engine/engine.inc.php';
include '../../engine/admin_include.php';

$filters = array();

if ($_REQUEST['city']){
    $filters['geo']['city'] = $_REQUEST['city'];
}

$banners = banner::get_banners($filters, false);
$smarty->assign('filters', $filters);
$smarty->assign('banners', $banners);
$smarty->display('admin/banners.tpl');