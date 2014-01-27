<?php
/**
 * Created by PhpStorm.
 * User: Spectrum
 * Date: 07.11.13
 * Time: 13:16
 */

include '../../engine/engine.inc.php';

$login_res = users::check_login($_POST['login'], $_POST['password']);

if ($login_res['login_result']==true){
    $user = new users($login_res['uid']);
    $user->session_run();
}
if ($login_res['error']==true){

}

if ((empty($login_res['error']))&&($login_res['login_result']==false)){
    $user = users::create($_POST['login'], $_POST['password'], 'Имя', 'Фамилия');
    $user->set_field('i_profile_info', 0);
    $user->session_run();
}
header('Location: '.base_site_url);
