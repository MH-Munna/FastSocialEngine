<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Spectrum
 * Date: 02.09.13
 * Time: 3:40
 * To change this template use File | Settings | File Templates.
 */


function api_users_get($user_ids = array(), $fields = array(), $name_case = 'NOM', $ext = false){
    $result = array();
    if (count($user_ids)>0){
        foreach($user_ids as $uid){
            $tmp_user = new users($uid);
            $tmp_user_info = $tmp_user->get_info();
            $to_result = array(
                'id' => $tmp_user_info['id'],
                'first_name' => $tmp_user_info['ch_fname'],
                'last_name' => $tmp_user_info['ch_lname'],
            );
            if (true == $ext){
                $to_result['av'] = $tmp_user_info['d_money_av'];
                $to_result['bonus'] = $tmp_user_info['d_money_bonus'];
                $to_result['check'] = $tmp_user_info['d_money_check'];
                $to_result['count_messages'] = 0;
            }
            $result = $to_result;
        }
    }
    return $result;
}