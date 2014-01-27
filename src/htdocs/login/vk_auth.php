<?php
/**
 * Created by PhpStorm.
 * User: Spectrum
 * Date: 28.10.13
 * Time: 21:36
 */


include '../../engine/engine.inc.php';
$res = users::session_info(false);

if (isset($_GET['code'])) {
    $params = array(
        'client_id' => configure::$vk['client_id'],
        'client_secret' => configure::$vk['client_secret'],
        'code' => $_GET['code'],
        'redirect_uri' => configure::$vk['redirect_uri']
    );
    $token = json_decode(file_get_contents(configure::$vk['access_token_uri'] . '?' . urldecode(http_build_query($params))), true);
    if (isset($token['access_token'])) {
        $params = array(
            'uids'         => $token['user_id'],
            'fields'       => 'uid,first_name,last_name,screen_name,sex,bdate,photo_big',
            'access_token' => $token['access_token']
        );
        $userInfo = json_decode(file_get_contents('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params))), true);
        if (isset($userInfo['response'][0]['uid'])) {
            $userInfo = $userInfo['response'][0];
            $result = true;
            $check_social_user = users::get_user_by_social_uid('vk'.$userInfo['uid']);
            if (!empty($check_social_user)){ //Если он уже завязан - вход
                $user = new users($check_social_user);
                $user->session_run();
            }else{ // нет юзера? регаем его!
                    $user = users::create($userInfo['screen_name'].'@vk.com', create_password(10), $userInfo['first_name'], $userInfo['last_name']);
                    users::create_social_uid('vk'.$userInfo['uid'], $user->id(), $userInfo);
                    $user->set_field('i_sex', $userInfo['sex']); //пол
                    $user->set_field('d_bdate', $userInfo['bdate']); //день рождения
                     if (!empty($userInfo['photo_big'])){
                        $tmp = tempnam('/tmp', 'vk_av');
                        file_put_contents($tmp, file_get_contents($userInfo['photo_big']));
                        photo_class::upload_photo_to_avatar($user->id(), $tmp);
                        unlink($tmp);
                    }
                $user->session_run();
            }
        }
    }
}
header('location: '.base_site_url);