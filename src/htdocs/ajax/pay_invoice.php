<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Spectrum
 * Date: 20.09.13
 * Time: 6:38
 * To change this template use File | Settings | File Templates.
 */

//include '../../engine/engine.inc.php';
//
//$session_info = users::session_info();
//
//$result = '';
//
//$invoiceID = (int) $_POST['invoiceID'];
//
//if (0==$invoiceID) die('Bad request');
//
//$invoice = new invoice_class($invoiceID);
//
//if ($session_info['uid']!=$invoice->get_field('fk_user')) die('Bad request');
//
//$invoice->pay();
//
//$result['result'] = 'ok';
//
//echo json_encode($result);