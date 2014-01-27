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
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query(
                array(
                    'code' => $_GET['code'],
                    'client_id' => configure::$gg['client_id'],
                    'client_secret' => configure::$gg['client_secret'],
                    'redirect_uri' => configure::$gg['redirect_uri'],
                    'grant_type' => 'authorization_code',
                )
            ),
        ),
    );
    $context  = stream_context_create($options);
    $token = json_decode(file_get_contents(configure::$gg['access_token_uri'], true, $context));

    if (isset($token->access_token)) {
        $params = array(
            'access_token' => $token->access_token,
        );
        $userInfo = json_decode(file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo' . '?' . urldecode(http_build_query($params))), true);
            if (isset($userInfo['id'])) {
                $result = true;
                $check_social_user = users::get_user_by_social_uid('gg'.$userInfo['id']);
                if (!empty($check_social_user)){ //Если он уже завязан - вход
                    $user = new users($check_social_user);
                    $user->session_run();
                }else{ // нет юзера? регаем его!
                    $user = users::create($userInfo['email'], create_password(10), $userInfo['given_name'], $userInfo['family_name']);
                    users::create_social_uid('gg'.$userInfo['id'], $user->id(), $userInfo);
                    if ('male'==$userInfo['gender']) $user->set_field('i_sex', 2); //пол
                    if ('female'==$userInfo['gender']) $user->set_field('i_sex', 1); //пол

                    if (!empty($userInfo['picture'])){
                        $tmp = tempnam('/tmp', 'gg_av');
                        file_put_contents($tmp, file_get_contents($userInfo['picture']));
                        photo_class::upload_photo_to_avatar($user->id(), $tmp);
                        unlink($tmp);
                    }
                    $user->session_run();
                }
            }
        }
    }
header('location: '.base_site_url);