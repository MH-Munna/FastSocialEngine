<?php
/**
 * Created by PhpStorm.
 * User: Spectrum
 * Date: 23.10.13
 * Time: 16:45
 */

include '../../../engine/engine.inc.php';

$profile_user = users::session_info();

$smarty->display('service/shopping/torg.tpl');