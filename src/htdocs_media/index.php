<?php
/**
 * Данный файл занимается выдачей медиа - контента
 * Ссылка действует только для одного IP. в приходящих ссылках ID мемкеш записи которая хранится на этой же машине
 * User: Spectrum
 * Date: 06.01.14
 * Time: 20:11
 */

$memcacheID = $_REQUEST['memcacheID'];
$user_ip = $_SERVER['HTTP_X_REAL_IP']?$_SERVER['HTTP_X_REAL_IP']:$_SERVER['REMOTE_ADDR'];

if (empty($memcacheID)){
    die('Bad request');
}

$mem=new Memcached;

//Коннект к мемкэшу и если его нет то отключение
if (!$mem->addServer('localhost',11211)) {
    die('ERROR! Memcache not found');
}

$memRes = $mem->get($memcacheID);

//Если в мемкеше отсутствует ip адрес или путь до файла который нужно выдать, то нам точно ему нечего выдавать
//Если ip не совпадает с тем что в мемкеш записи, то этот файл не предназначен для этого пользователя
if ((!$memRes['ip'])||(!$memRes['filePath'])||($memRes['ip']!=$user_ip)){
    die('access denied');
}

if (file_exists($memRes['filePath'])) {
    // сбрасываем буфер вывода PHP, чтобы избежать переполнения памяти выделенной под скрипт
    // если этого не сделать файл будет читаться в память полностью!
    if (ob_get_level()) {
        ob_end_clean();
    }
    // заставляем браузер показать окно сохранения файла
    //header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($memRes['filePath']));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($memRes['filePath']));
    // читаем файл и отправляем его пользователю
    readfile($memRes['filePath']);
    exit;
}else{
    die('file not found');
}