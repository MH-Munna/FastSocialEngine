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
                        'redirect_uri' => configure::$ok['redirect_uri'],
                        'grant_type' => 'authorization_code',
                        'client_id' => configure::$ok['client_id'],
                        'client_secret' => configure::$ok['client_secret'],
                    )
                ),
        ),
    );
    $context  = stream_context_create($options);
    $token = json_decode(file_get_contents(configure::$ok['access_token_uri'], true, $context));

    if (isset($token->access_token)) {

        //sig = md5( request_params_composed_string+ md5(access_token + application_secret_key)  );
        //http://api.odnoklassniki.ru/fb.do?access_token=kjdhfldjfhgldsjhfglkdjfg9ds8fg0sdf8gsd8fg&method=......
        $params = array(
            'application_key' => configure::$ok['public_key'],
            'method' => 'users.getCurrentUser',
        );
        $params['sig'] =  md5('application_key='.$params['application_key'].'method='.$params['method'].md5($token->access_token.configure::$ok['client_secret']));
        $params['access_token'] = $token->access_token;

        $userInfo = json_decode(file_get_contents('http://api.odnoklassniki.ru/fb.do' . '?' . urldecode(http_build_query($params))), true);
        if (isset($userInfo['uid'])) {
            $result = true;
            $check_social_user = users::get_user_by_social_uid('ok'.$userInfo['uid']);
            if (!empty($check_social_user)){ //Если он уже завязан - вход
                $user = new users($check_social_user);
                #todo: не прошла у меня авторизация через одноклассников
                $user->session_run();
            }else{ // нет юзера? регаем его!
                $user = users::create($userInfo['uid'].'@odnoklassniki.ru', create_password(10), $userInfo['first_name'], $userInfo['last_name']);
                users::create_social_uid('ok'.$userInfo['uid'], $user->id(), $userInfo);
                if ('male'==$userInfo['gender']) $user->set_field('i_sex', 2); //пол
                if ('female'==$userInfo['gender']) $user->set_field('i_sex', 1); //пол
                if ($userInfo['birthday']) $user->set_field('d_bdate', $userInfo['birthday']); //день рождения

                if (!empty($userInfo['pic_2'])){
                    $tmp = tempnam('/tmp', 'gg_av');
                    file_put_contents($tmp, file_get_contents($userInfo['pic_2']));
                    photo_class::upload_photo_to_avatar($user->id(), $tmp);
                    unlink($tmp);
                }
                $user->session_run();
            }
        }

    }
}
header('location: '.base_site_url);

























