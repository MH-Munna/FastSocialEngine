<?php

//Функция печати данных с обрамлением тегами pre
function print_pre($data){
    echo '<pre>' . print_r($data, 1) . '</pre>';
}

function get_perevod($content){
    $db=db::create();
    $res = $db->getone('langs', $_SESSION['langID'], array($content));
    return @$res[$content]?$res[$content]:false;
}

function create_password($len = 10){
    $chars="qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";
    // Определяем количество символов в $chars
    $size=StrLen($chars)-1;
    // Определяем пустую переменную, в которую и будем записывать символы.
    $password=null;
    // Создаём пароль.
    while($len--)
        $password.=$chars[rand(0,$size)];
    return $password;
}

function get_installed_apps_info_by_uid($uid){
    $result = array();
    $user = new users($uid);
    $apps_ids = $user->get_apps();
    foreach($apps_ids as $apps_ids_item){
        $app = new apps($apps_ids_item);
        $result[] = $app->get_info();
        unset ($app);
    }
    return $result;
}

function uploadftp($host, $login, $pass, $path, $pathLevel2="", $file)
{
    $tmp = $file['tmp_name'];
    $aname = $file['name'];

    $connect = ftp_connect($host);
    if(!$connect) exit();
    $result = ftp_login($connect, $login, $pass);
    if ($result==false) exit();
    if (ftp_chdir($connect, $path)){
        if (!empty($pathLevel2)){
            if (!in_array($pathLevel2, ftp_nlist($connect, ''))){
                ftp_mkdir($connect, $pathLevel2);
            }
            ftp_chdir($connect, $pathLevel2);
        }
        ftp_put($connect, $aname, $tmp, FTP_BINARY);
    }
    else exit();
    ftp_quit($connect);
    unlink($tmp);
};

if (isset($filename)) upload('filename')

?>