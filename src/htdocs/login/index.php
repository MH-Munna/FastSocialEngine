<?php
/**
 * Created by JetBrains PhpStorm.
 * User: spectrum
 * Date: 12.06.13
 * Time: 22:40
 * To change this template use File | Settings | File Templates.
 */

/* login/index.php */

include '../../engine/engine.inc.php';
$res = users::session_info(false);

/**
 * Если пользователь перешел по реферальной ссылке то пишем информацию в сессию, а потом уже в базу в момент самой регистрации
 */

$_SESSION['referid'] = (int) $_REQUEST['referid'];

//Подготавливаем авторизацию через vk
$vk_auth_array = array(
        'client_id' => configure::$vk['client_id'],
        'redirect_uri' => configure::$vk['redirect_uri'],
        'response_type' => 'code'
);

$smarty->assign('vk_auth_link', configure::$vk['auth_url'].'?'.urldecode(http_build_query($vk_auth_array)) );


//Подготавливаем авторизацию через odnoklassniki
$ok_auth_array = array(
        'client_id' => configure::$ok['client_id'],
        'scope' => '',
        'response_type' => 'code',
        'redirect_uri' => configure::$ok['redirect_uri']
);

$smarty->assign('ok_auth_link', configure::$ok['auth_url'].'?'.urldecode(http_build_query($ok_auth_array)) );

//Подготавливаем авторизацию через mail.ru
$mr_auth_array = array(
        'client_id' => configure::$mr['client_id'],
        'response_type' => 'code',
        'redirect_uri' => configure::$mr['redirect_uri']
);

$smarty->assign('mr_auth_link', configure::$mr['auth_url'].'?'.urldecode(http_build_query($mr_auth_array)) );

//Подготавливаем авторизацию через google.com
$gg_auth_array = array(
        'client_id' => configure::$gg['client_id'],
        'response_type' => 'code',
        'redirect_uri' => configure::$gg['redirect_uri'],
        'scope' => 'https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.email+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.profile',
);

$smarty->assign('gg_auth_link', configure::$gg['auth_url'].'?'.urldecode(http_build_query($gg_auth_array)) );

//Подготавливаем авторизацию через facebook.com
$fb_auth_array = array(
        'client_id' => configure::$fb['client_id'],
        'redirect_uri' => configure::$fb['redirect_uri'],
        'response_type' => 'code',
);

$smarty->assign('fb_auth_link', configure::$fb['auth_url'].'?'.urldecode(http_build_query($fb_auth_array)) );

$smarty->display('login/main.tpl');