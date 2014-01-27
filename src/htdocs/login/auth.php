<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 06.07.13
 * Time: 13:44
 * To change this template use File | Settings | File Templates.
 */
//sleep(3);
/* login/index.php */

$i = 0;
include '../../engine/engine.inc.php';

$login_res = users::login($_REQUEST['login'], $_REQUEST['pass']);

$result = array();

if (!empty($login_res['user_id'])) { //Вход
    $user = new users($login_res['user_id']);
    $user->session_run();
    if ($user->get_field('i_admin')==1){
        $result['redirect'] = base_site_url.'/adm';
    }else{
        $result['redirect'] = base_site_url.'/profile/'.$login_res['user_id'];
    }

    $result['result_login'] = 'ok';
}else{
    $result['result_login'] = 'error';
    $result['error_text'] = users::$error[$login_res['login_result']];
}

echo json_encode($result);