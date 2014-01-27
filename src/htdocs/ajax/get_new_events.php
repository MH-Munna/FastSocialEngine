<?php
/**
 * Created by JetBrains PhpStorm.
 * User: spectrum
 * Date: 02.08.13
 * Time: 14:01
 * To change this template use File | Settings | File Templates.
 */

include '../../engine/engine.inc.php';
$session_info = users::session_info();

$result = array();
$user = new users($session_info['uid']);


$event_id = (int) $_POST['getEvent'];
if (0 == $event_id){
    $event_id = $user->get_field('fk_first_unread_event');
}

if (0 != $event_id) {
    $event = new events_class($session_info['uid'], $event_id);
    $result['nextEventID'] = $event->get_field('fk_next');
    $user->set_field('fk_first_unread_event', $result['nextEventID']);
    $i_type = $event->get_field('i_type');
    switch ($i_type){
        case '1':
            $inv_id = $event->get_field('to_id');
            $inv = new invoice_class($inv_id);
            //Сделать мультиязычным
            $result['summ'] = $inv->get_field('summ');
            $result['info'] = 'Создан новый счет! #'.$inv_id.'<br />Сумма: '.$result['summ'].'<br ><a href="#" onclick="pay_invoice('.$inv_id.'); return false;">Оплатить</a>';
            $result['inv_id'] = $inv_id;
            break;
        case '2':
            $params = $event::get_params($event_id);
            $result['info'] = 'Получены биллеты! '.$params['addbillets'].' шт! <br /> Поздравляем!';
            $result['billets'] = $user->get_field('d_money_bonus');
            break;
        case '3':
            $params = $event::get_params($event_id);
            $result['info'] = '<a href="#" onclick="get_requestes(); return false;">'.$params['name'].' хочет добавить Вас в друзья</a>';
            break;
        case '4':
            $params = $event::get_params($event_id);
            if ($params['action']=='add'){
                $result['info'] = $params['name'].' теперь Ваш друг<script>update_add_friend_button();</script>';
            }
            if ($params['action']=='del'){
                $result['info'] = $params['name'].' удалил Вас из друзей<script>update_add_friend_button();</script>';
            }
            if ($params['action']=='i_del'){
                $result['info'] = $params['name'].' удален из друзей<script>update_add_friend_button();</script>';
            }
            break;
        case '5': //Новые сообщения в чате
            $params = $event::get_params($event_id);
            $result['info'] = '<a href="#" onclick="tab_select(\'chat\'); dialog_update_message_list('.$params['dialog_id'].'); return false;"> Новое сообщение от '.$params['name'].'</a>';
            $result['dialog_id'] = $params['dialog_id'];
            break;
    }
    $result['v'] = '1';
}
echo json_encode($result);