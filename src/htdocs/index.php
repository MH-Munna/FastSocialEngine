<?php
include '../engine/engine.inc.php';
$res = users::session_info();
header('location: '.base_site_url.'/profile/'.$res['uid']);