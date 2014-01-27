<?php
session_start();
include '../../engine/engine.inc.php';

$id=(int)$_REQUEST['lang'];
if($id>0&&$id<7){
    $_SESSION['langID']=$id;
}
other::loc();