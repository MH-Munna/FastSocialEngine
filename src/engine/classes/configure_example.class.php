<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 24.09.13
 * Time: 13:03
 * To change this template use File | Settings | File Templates.
 */

define('base_site_url', 'http://localhost');

class configure{
    static $db=array(
        'db_host'=>'localhost',         // хост
        'db_user'=>'root',              // логин к БД
        'db_pass'=>'',                  // пароль к БД
        'db_name'=>'phpSocial',         // база
        'db_code'=>'utf8',              // Кодировка
        'mem_host'=>'localhost',    	// Хост мемкэша
        'mem_port'=>'11211'             // Порт мемкэша
    );

    static $photo_albums_limit = 300;   //Ограничение на количество фотоальбомов
    static $apps_limit = 300;   //Ограничение на количество фотоальбомов
    protected function __construct(){}
    private function __clone(){}
    private function __wakeup(){}

    //vkontakte oauth
    static $vk=array(
        'auth_url' => 'http://oauth.vk.com/authorize', //URL для авторизации
        'access_token_uri' => 'https://oauth.vk.com/access_token', // URI для получения access_token-а
        'client_id' => '', // ID приложения
        'client_secret' => '', // Защищённый ключ
        'redirect_uri' => 'http://localhost/login/vk_auth.php' // Адрес сайта
    );

    //odnoklassniki oauth
    static $ok=array(
        'auth_url' => 'http://www.odnoklassniki.ru/oauth/authorize',
        'access_token_uri' => 'http://api.odnoklassniki.ru/oauth/token.do', // URI для получения access_token-а
        'client_id' => '',
        'public_key' => '',
        'client_secret' => '',
        'redirect_uri' => 'http://localhost/login/ok_auth.php' // Адрес сайта
    );

    //mail.ru oauth
    static $mr=array(
        'auth_url' => 'https://connect.mail.ru/oauth/authorize',
        'client_id' => '',
        'public_key' => '',
        'client_secret' => '',
        'redirect_uri' => 'http://localhost/login/mr_auth.php' // Адрес сайта
    );

    //Google oauth
    static $gg=array(
        'auth_url' => 'https://accounts.google.com/o/oauth2/auth',
        'access_token_uri' => 'https://accounts.google.com/o/oauth2/token',
        'client_id' => '',
        'client_secret' => '',
        'redirect_uri' => 'http://localhost/login/gg_auth.php' // Адрес сайта
    );

    //Facebook auth
    static $fb=array(
        'auth_url' => 'https://www.facebook.com/dialog/oauth',
        'access_token_uri' => 'https://graph.facebook.com/oauth/authorize',
        'access_token' => 'https://graph.facebook.com/oauth/access_token',
        'client_id' => '',
        'client_secret' => '',
        'redirect_uri' => 'http://localhost/login/fb_auth.php'
    );


}