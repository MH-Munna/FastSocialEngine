<?php
/**
 * Класс реализует механизмы уведомлений на портал
 * User: osipyan
 * Date: 12.06.13
 * Time: 21:40
 * To change this template use File | Settings | File Templates.
 */

class events_class{
    private $id=false, $data=array(), $db, $uid_reader=0;

    function __construct($uid, $id = false){
        $this->uid_reader = $uid;
        $this->db=db::create();
        $this->id=$id;
        return $this->get_info();
    }

    /**
     * Получение информации о событии
     * @return array|bool|mixed
     */
    function get_info(){
        if (empty($this->id)) return false;
        // Если data пустой то выборка из БД/кэша
        if(empty($this->data)){
            $this->data= events_class::get_info_by_id($this->id);
        }
        //Если у нас запрашивает событие не тот пользователь, то шьем ему бороду!
        if ($this->uid_reader!=$this->data['fk_user']) return false;
        return $this->data;
    }

    function get_field($field){
        if ($this->get_info()) return $this->data[$field];
        return false;
    }

    function set_next_event_id($id){
        $this->data['fk_next'] = $id;
        $this->db->update('events', $this->id, array('fk_next'=>$id));
        return true;
    }

    static function get_info_by_id($id){
        $db = db::create();
        $res = $db->getone('events', $id);
        return $res;
    }

    static function get_params($id){
        $db = db::create();
        $res = $db->getone('events', $id);
        return unserialize($res['vc_params']);
    }

    /**
     * Метод позволяет создать новое уведомление пользователю
     * @param $uid
     * юид пользователя которому предназначается событие
     * @param $i_type
     * 1 - новый счет
     * 2 - получены биллеты
     * 3 - пришла заявка на добавление в друзья
     * 4 - подтверждение отправленной заявки в друзья, удаление друзей
     * 5 - новое сообщение в чате
     * @param $to_id
     * ID объекта породившего новое уведомление, ID счета, ID заявки в друзья, ID сообщения и т.д.
     * @param array $params
     * Дополнительные параметры будут сериализованы и сохранены в базе. сами всплывающие сообщения генерируются в файле htdocs\ajax\get_new_events.php
     * @return mixed
     * ID события
     */
    static function create($uid, $i_type, $to_id, $params = array()){
        $user = new users($uid);
        $user_info = $user->get_info();

        if (0 != $user_info['fk_last_event']){
            $last_event = new events_class($user_info['fk_last_event']);
            $last_event_info = $last_event->get_info();
        }else{
            $last_event_info['id'] = 0;
        }

        $db = db::create();
        $data['fk_user'] = $uid;
        $data['i_type'] = $i_type;
        $data['to_id'] = $to_id;
        $data['fk_last'] = $last_event_info['id'];
        $data['vc_params'] = serialize($params);
        $new_event = $db->insert('events', $data);

        //Связываем предыдущее событие с этим
        if (0 != $last_event_info['id']){
            $last_event->set_next_event_id($new_event['id']);
        }
        //Если у пользователя до этого было все прочитано
        if (0 == $user_info['fk_first_unread_event']) {
            $user->set_field('fk_first_unread_event', $new_event['id']);
        }
        $user->set_field('fk_last_event', $new_event['id']);
        $user->set_field('count_events', $user_info['count_events']+1);

        return $new_event['id'];
    }

}