<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Spectrum
 * Date: 22.08.13
 * Time: 23:36
 * To change this template use File | Settings | File Templates.
 */
$time_start = microtime(true);
include '../../engine/engine.inc.php';

$profile_user = users::session_info();
$app_id = (int) $_POST['app_id'];

if (0 == $app_id) die;

$srv = new servers_class(servers_class::find_server_by_type(5));
$srv_info = $srv->get_info();

$app = new apps($app_id);
$app->get_info();

$dirName = rand(1000, 2000);
$tmpFile['tmp_name'] = $_FILES['upload_swf']['tmp_name'];
$current_file_type = substr(strrchr($_FILES['upload_swf']['name'], '.'), 1);
$tmpFile['name'] = create_password(5).'-'.create_password(5).'.'.$current_file_type;

if ((strtolower($current_file_type)=='swf')&&(!empty($tmpFile['tmp_name']))){
        uploadftp($srv->get_first_ip(), $srv_info['vc_ftp_user'], $srv_info['vc_ftp_pass'], $srv_info['vc_ftp_path'], $dirName, $tmpFile);
        $db = db::create();
        $db->update('clients', $app_id, array('fk_server'=>$srv_info['id'], 'dirName'=>$dirName, 'fileName' => $tmpFile['name']));
    }

?>
<script type="text/javascript">
    parent.document.getElementById('upload-files').innerHTML += '<ul id=\"files-list\"></ul>';
    <?php
        print ("parent.document.getElementById('console').innerHTML += 'успешно загружен: <pre>" . print_r($_FILES, true) . "</pre><br />';");
    ?>
</script>