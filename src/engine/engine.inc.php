<?php
error_reporting(E_ERROR);
session_start();
$_SESSION['ip'] = $_SERVER['HTTP_X_REAL_IP']?$_SERVER['HTTP_X_REAL_IP']:$_SERVER['REMOTE_ADDR'];
/* engine.inc.php */

define('ROOT_DIR', dirname (__FILE__));
include ROOT_DIR.'/includes/functions.inc.php';                 //Разные полезные функции
include ROOT_DIR.'/classes/configure.class.php';                //Подключаем конфиг
include ROOT_DIR.'/classes/db.class.php';                       //Подключаем класс для работы с базой
include ROOT_DIR.'/lib/phpmailer/class.phpmailer.php';          //Подключаем класс для работы с почтой
include ROOT_DIR.'/classes/mail.class.php';                     //Подключаем класс для работы с почтой
include ROOT_DIR.'/classes/users.class.php';                    //Подключаем класс для работы с пользователями
include ROOT_DIR.'/classes/groups.class.php';                   //Подключаем класс для работы с группами
include ROOT_DIR.'/classes/photo_album.class.php';              //Подключаем класс для работы с фотоальбомами
include ROOT_DIR.'/classes/photo.class.php';                    //Подключаем класс для работы с фотографиями
include ROOT_DIR.'/classes/apps.class.php';                     //Подключаем класс для работы с приложениями
include ROOT_DIR.'/classes/servers.class.php';                  //Подключаем класс для работы с серверами
include ROOT_DIR.'/classes/invoice.class.php';                  //Подключаем класс для работы со счетами
include ROOT_DIR.'/classes/events.class.php';                   //Подключаем класс для работы с событиями
include ROOT_DIR.'/classes/message.class.php';                  //Подключаем класс для работы с сообщениями
include ROOT_DIR.'/classes/banners.class.php';                  //Подключаем класс для работы с баннерами
include ROOT_DIR.'/classes/media.class.php';                    //Подключаем класс для работы с медиа (аудиозаписи)
include ROOT_DIR.'/classes/videos.class.php';                   //Подключаем класс для работы с видео
include ROOT_DIR.'/classes/comments.class.php';                 //Подключаем класс для работы с комментариями
include ROOT_DIR.'/classes/other.class.php';                    //класс с различными функциями
include ROOT_DIR.'/classes/search_class.class.php';             //класс для работы с поиском

require(ROOT_DIR.'/lib/ipgeobase/class.ipgeobase.php');
require(ROOT_DIR.'/lib/smarty/SmartyBC.class.php');

$smarty = new SmartyBC;
$smarty
    ->setTemplateDir(ROOT_DIR.'/templates')
    ->setCompileDir(ROOT_DIR.'/templates_c');

#$smarty->debugging		= true;
$smarty->force_compile	= true;

require(ROOT_DIR.'/includes/header_footer_data.inc.php');

