<?php
include '../engine/engine.inc.php';
$res = users::get(true)->get_info();
header('location: '.base_site_url.'/profile/'.$res['uid']);