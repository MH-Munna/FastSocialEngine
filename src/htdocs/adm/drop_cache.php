<?php
/**
 * Created by PhpStorm.
 * User: Spectrum
 * Date: 13.11.13
 * Time: 13:46
 */

include '../../engine/engine.inc.php';
include '../../engine/admin_include.php';

$db = db::create();
$db->drop_cache();

header('location: '.base_site_url.'/adm/');