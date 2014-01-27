<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Spectrum
 * Date: 20.09.13
 * Time: 1:42
 * To change this template use File | Settings | File Templates.
 */

include '../../engine/engine.inc.php';

$session_info = users::session_info();

$result = '';

$fields = array(
    'ch_fname',     'ch_lname',     'd_bdate',      'ch_hobbi',
    'ch_mechta',    'vc_country',   'vc_city',      'vc_status'
);

foreach($fields as $fields_item){
    $arr_to_update[$fields_item] = strip_tags($_POST[$fields_item]);
}
$arr_to_update['i_sex'] = abs((int) $_POST['i_sex']);

if ($arr_to_update['i_sex']>2) $arr_to_update['i_sex']=2;

$user = users::get();

foreach($fields as $fields_item){
    $user->set_field($fields_item, $arr_to_update[$fields_item]);
}
$user->set_field('i_profile_info', 1);
$result['result'] = 'ok';

echo json_encode($result);