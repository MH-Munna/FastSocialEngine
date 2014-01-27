<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Spectrum
 * Date: 21.08.13
 * Time: 23:35
 * To change this template use File | Settings | File Templates.
 */

include '../../engine/engine.inc.php';
$session_info = users::session_info();

$result = array();
$result['width'] = 640;
$result['height'] = 480;
$result['app_id'] = (int) $_REQUEST['app_id'];
if (!empty($_REQUEST['width']))
{
    $result['width'] = (int) $_REQUEST['width'];
    $result['height'] = (int) $_REQUEST['height'];
}
if (0==$result['app_id']) {die;}

$result['app_info'] = array();
$result['uid'] = $session_info['uid'];

if ($result['app_id']>0){
    $app = new apps($result['app_id']);
    $result['app_info'] = $app->get_info();

    //Если приложение флеш
    if (0==$result['app_info']['app_type']){
        if (!$result['app_info']['fileName']){
            die('Приложение не загружено');
        }
        $srv = new servers_class($result['app_info']['fk_server']);
        $srv_info = $srv->get_info();

        $result['url'] = $srv_info['vc_baseurl'].$result['app_info']['dirName'].'/'.$result['app_info']['fileName'];
        $result['tpl'] = 'apps/app_start_swf.tpl';
    }
    //Если приложение iFrame
    if (1==$result['app_info']['app_type']){
        $result['url'] = $result['app_info']['app_iframe_url'];
        $result['tpl'] = 'apps/app_start_iframe.tpl';
    }
}

$smarty->assign('app_config', $result);
$smarty->display($result['tpl']);