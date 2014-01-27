<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 12.07.13
 * Time: 16:18
 * To change this template use File | Settings | File Templates.
 */
include '../../engine/engine.inc.php';
users::logout();
users::session_info(true);
header('Location: '.base_site_url);