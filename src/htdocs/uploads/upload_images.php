<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Spectrum
 * Date: 22.08.13
 * Time: 23:36
 * To change this template use File | Settings | File Templates.
 */

include '../../engine/engine.inc.php';

$profile_user = users::session_info();
$album_id = (int) $_POST['album_id'];

if (0 == $album_id) die;

$size = count ( $_FILES['upload_images']['tmp_name'] );
for ( $n = 0; $n < $size; $n++ ) {
    //move_uploaded_file ( $_FILES['uploaded_files']['tmp_name'][$n], 'upload/' . basename ($_FILES['uploaded_files']['name'][$n]) );
    $tmpFile['tmp_name'] = $_FILES['upload_images']['tmp_name'][$n];
    $current_file_type = substr(strrchr($_FILES['upload_images']['name'][$n], '.'), 1);

    $info = photo_class::is_picture($tmpFile['tmp_name']);
    if ($info['pic']){
        photo_class::upload_photo_to_album($album_id, $profile_user['uid'], $tmpFile['tmp_name'], $info['ext']);
    }
    unset($tmpFile);
}
?>
<script type="text/javascript">
    parent.document.getElementById('console').innerHTML = 'Готово!';
    parent.window.open_photo_album(<?=$album_id?>);
</script>