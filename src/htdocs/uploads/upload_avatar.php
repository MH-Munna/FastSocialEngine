<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Spectrum
 * Date: 22.08.13
 * Time: 23:36
 * To change this template use File | Settings | File Templates.
 */
ini_set('display_errors', 1);
error_reporting(E_ALL);

$time_start = microtime(true);
include '../../engine/engine.inc.php';


$profile_user = users::session_info();

if (empty($_FILES['upload_avatar']['tmp_name'])) die;

$tmpFile['tmp_name'] = $_FILES['upload_avatar']['tmp_name'];
//$current_file_type = substr(strrchr($_FILES['upload_avatar']['name'], '.'), 1);
$info = getimagesize($tmpFile['tmp_name']); //получаем размеры картинки и ее тип

$ext = false;
if ($info['mime'] == 'image/jpeg') $ext = 'jpg';
if ($info['mime'] == 'image/png') $ext = 'png';

if ($ext) {
    photo_class::upload_photo_to_avatar($profile_user['uid'], $tmpFile['tmp_name'], $ext);
}


unset($tmpFile);
?>
<script type="text/javascript">
    parent.document.getElementById('console-avatar').innerHTML = 'Готово!';
    parent.window.load_main_avatar();
</script>