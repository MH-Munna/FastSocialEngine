<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Spectrum
 * Date: 29.08.13
 * Time: 3:17
 * To change this template use File | Settings | File Templates.
 */

include '../engine/engine.inc.php';
include '../engine/includes/api.inc.php';
include '../htdocs_oauth2/lib/PDOOAuth2.inc';


$oauth = new PDOOAuth2();
$oauth->verifyAccessToken();

$app = new apps($oauth->app_id);
$app_info = $app->get_info();

$result = array();

$method = $_REQUEST['method'];

switch ($method) {
    case 'users.get':
        $user_ids = str_replace(' ', '', $_REQUEST['user_ids']);
        $user_ids = explode(',', $user_ids);
        $result['response'] = api_users_get($user_ids);
        break;
//    case 'invoice.init':
//        break;
    case 'add.billets':
        $user_id = (int) $_REQUEST['user_id'];
        $billets = (int) $_REQUEST['billets'];
        if (1==$app_info['app_from_av']){
            $user = new users($user_id);
            $user->add_billets($billets);
            $result['add_billets'] = 'ok';
        }else{
            $result['error'] = 'bad request';
        }
        break;
    case 'take.av':
        $user_id = (int) $_REQUEST['user_id'];
        $av = (int) $_REQUEST['av'];
        if (1==$app_info['app_from_av']){
            /*Parameters:
                $fk_user
                ид - пользователя
                $from_type
                тип приложения (network)
                $from_id
                ид - приложения
                $summ
                сумма
                $description
                описание платежа
                $params
                доп параметры, входной тип - varchar
                int
                $i_type
                */
            $invoice = invoice_class::create($user_id, 'network', $app_info['id'], $av, '', '', 0);

            $result['add_billets'] = 'ok';
        }else{
            $result['error'] = 'Ошибка доступа';
        }
        break;
    case 'users.get.ext':
        if (1==$app_info['app_from_av']){
        $user_ids = str_replace(' ', '', $_REQUEST['user_ids']);
        $user_ids = explode(',', $user_ids);
        $result['response'] = api_users_get($user_ids, false, false, true);
        }else{
            $result['error'] = 'access denied';
        }
        break;
    case 'get_invited_users':
        if (1==$app_info['app_from_av']){
            $user_id = (int) $_REQUEST['user_id'];
            $search = new search();
            $result['response'] = $search->get_invited_users($user_id);
        }else{
            $result['error'] = 'access denied';
        }
        break;
    case 'get_extended_field':
        if (1==$app_info['app_from_av']){
            $user_id = (int) $_REQUEST['user_id'];
            $field_name = $_REQUEST['field_name'];
            $user = new users($user_id);
            $result['response'][$field_name] = $user->get_extended_field($field_name);
        }
        break;
    case 'set_extended_field':
        if (1==$app_info['app_from_av']){
            $user_id = (int) $_REQUEST['user_id'];
            $field_name = $_REQUEST['field_name'];
            $value = $_REQUEST['value'];
            $user = new users($user_id);
            $result['response'] = $user->set_extended_field($field_name, $value);
        }
        break;
    case 'set_unlime_expire':
        if (1==$app_info['app_from_av']){
            $access_token = $_GET['access_token'];
            $db = db::create();
            $db->query('UPDATE tokens SET expires=1484951406 WHERE oauth_token='.$db->quote($access_token));
        }
        break;
    case 'add_item_to_cart':
        if (1==$app_info['app_from_av']){
            $user_id = (int) $_REQUEST['user_id'];
            $ts_active = $_REQUEST['ts_active']?$_REQUEST['ts_active']:604800;
            $vc_name = $_REQUEST['product_name'];
            $i_price = $_REQUEST['price'];
            $vc_price_type = $_REQUEST['price_type']?$_REQUEST['price_type']:'RUB';
            $description = $_REQUEST['description'];

            $result['invoiceID'] = invoice_class::create($user_id, 'app', $app_info['id'], $ts_active, $vc_name, $i_price, $vc_price_type, $description, 0, 0);
        }
        break;
    case 'get_items_cart_info':
        $ids = $_REQUEST['ids'];
        if (is_array($ids)){
            foreach($ids as $id){
                $invoice = new invoice_class($id);
                $invoice_info = $invoice->get_info();
                if ((1==$app_info['app_from_av'])&&($invoice_info['from_type']=='app')&&($invoice_info['from_id']==$app_info['id'])){
                    $result[$id]['info'] = $invoice->get_info();
                    $result[$id]['error'] = false;
                }else{
                    $result[$id]['info'] = false;
                    $result[$id]['error'] = 'access denied';
                }
                unset($invoice);
                unset($invoice_info);
            }
        }
        break;
    case 'del_item_cart':
            $id = $_REQUEST['id'];
            $invoice = new invoice_class($id);
            $invoice_info = $invoice->get_info();
            if ((1==$app_info['app_from_av'])&&($invoice_info['from_type']=='app')&&($invoice_info['from_id']==$app_info['id'])){
                $result['delete'] = $invoice->cancel();
            }else{
                $result['error'] = 'access denied';
            }
            unset($invoice);
            unset($invoice_info);
        break;
}

echo json_encode($result);