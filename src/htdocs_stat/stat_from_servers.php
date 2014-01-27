<pre>
<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Spectrum
 * Date: 17.06.13
 * Time: 22:54
 * To change this template use File | Settings | File Templates.
 */
$time_start = microtime(true);

/* index.php */
include '../engine/engine.inc.php';

/*
 Данный файл принимает информацию о состоянии подчиненных серверов
*/

$server_id = (int) $_GET['id'];

$server = new servers_class($server_id);

$update['d_loadavarage'] = $_GET['load_avarage'];
$update['i_disk_gb'] = $_GET['diskgb'];
$update['s_ips'] = serialize(explode(':', $_GET['ips']));

$server->update_info($update);
$server->check_servers();
?>
    </pre>