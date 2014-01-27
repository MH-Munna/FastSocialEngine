<?php
/**
 * Created by PhpStorm.
 * User: Spectrum
 * Date: 29.10.13
 * Time: 15:05
 */


include '../../engine/engine.inc.php';
$res = users::session_info(false);



if (isset($_GET['code'])) {
    $params = array(
        'client_id' => configure::$fb['client_id'],
        'redirect_uri' => configure::$fb['redirect_uri'],
        'client_secret' => configure::$fb['client_secret'],
        'code' => $_GET['code'],
    );

    parse_str(file_get_contents('https://graph.facebook.com/oauth/access_token' . '?' . urldecode(http_build_query($params))), $token);

    if (isset($token['access_token'])) {
        $params = array(
            'access_token' => $token['access_token'],
        );
        $userInfo = json_decode(file_get_contents('https://graph.facebook.com/me' . '?' . urldecode(http_build_query($params))), true);
        if (isset($userInfo['id'])) {
            $result = true;
            $check_social_user = users::get_user_by_social_uid('fb'.$userInfo['id']);
            if (!empty($check_social_user)){ //Если он уже завязан - вход
                $user = new users($check_social_user);
                $user->session_run();
            }else{ // нет юзера? регаем его!
                $user = users::create($userInfo['id'].'@facebook.com', create_password(10), $userInfo['first_name'], $userInfo['last_name']);
                users::create_social_uid('fb'.$userInfo['id'], $user->id(), $userInfo);
                if ('male'==$userInfo['gender']) $user->set_field('i_sex', 2); //пол
                if ('female'==$userInfo['gender']) $user->set_field('i_sex', 1); //пол

//                if (!empty($userInfo['picture'])){
//                    $tmp = tempnam('/tmp', 'gg_av');
//                    file_put_contents($tmp, file_get_contents($userInfo['picture']));
//                    photo_class::upload_photo_to_avatar($user->id(), $tmp);
//                    unlink($tmp);
//                }
                $user->session_run();
            }
        }
    }
}
header('location: '.base_site_url);