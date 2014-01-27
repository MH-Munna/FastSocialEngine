<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 30.12.13
 * Time: 0:02
 */

class groups_class extends users{
    private $id = false, $data = array(), $db;

    function __construct($id) {
        parent::__construct($id);
        $this->db = db::create();
        $this->id = $id;
        return $this->get_info();
    }

    /**
     * Возвращает список существующих групп в сети
     * @return array
     */
    static function get_all_groups_in_network(){
        $result = array();
        $db = db::create();
        $sql = 'SELECT id FROM users WHERE i_group = 1 ORDER BY i_members DESC LIMIT 30';
        $dbRes = $db->query($sql);
        if ($dbRes->rowCount() > 0) {
            while($row = $dbRes->fetch()){
                $groups_class_obj_tmp = new groups_class($row['id']);
                $result[$row['id']] = $groups_class_obj_tmp->get_info();
                unset ($groups_class_obj_tmp);
            };
        }
        return $result;
    }

    /**
     * Создание группы
     * @param null $refer_uid
     * @param string $group_name
     * @return groups_class
     */
    static function create_group($refer_uid=null, $group_name="Без имени")
    {
        $db = db::create();
        if (empty($refer_uid)) $refer_uid = users::get()->id();
        $array = array(
            'ch_email' => create_password(10).'@avatoria.com',
            'ch_fname' => '',
            'ch_lname' => '',
            'ch_pname' => '',
            'ch_pass' => md5(create_password(10)),
            'i_group' => 1,
            'i_members' => 0,
            'ch_group_name' => $group_name,
            'refer_uid' => $refer_uid,
            'ch_active' => 1
        );

        $group_info = $db->insert('users', $array);
        $db->create()->mem_clear('users', $group_info['id']);
        self::$user = new groups_class($group_info['id']);
        $sv_id = self::$user->add_to_group($refer_uid);
        self::$user->set_admin($sv_id);
        //Накручиваем глобальный счетчик колличества групп
        $count_groups_total = $db->create()->get_global_parameter('totalGroups');
        $count_groups_total++;
        $db->create()->set_global_parameter('totalGroups', $count_groups_total);

        return self::$user;
    }

    function check_friendship(){
        return false;
    }

    function check_member($uid = false){
        if (empty($uid)) $uid = users::get()->id();
        $result = false;
        $sql = 'SELECT * FROM sv_groups WHERE group_id = '.$this->db->quote((int)$this->id).' AND user_id = '.$this->db->quote((int)$uid);
        $dbRes = $this->db->query($sql);
        if ($dbRes->rowCount()){
            $member_tmp = $dbRes->fetch();
            $result['member'] = true;
            $result['role'] = (int) $member_tmp['i_role'];
        }
        return $result;
    }

    static function get_all_userGroups(){
        $result = array();
        $db = db::create();
        $sql = 'SELECT * FROM sv_groups WHERE user_id = '.$db->quote(users::get()->id());
        $dbRes = $db->query($sql);
        if ($dbRes->rowCount() > 0) {
            while($row = $dbRes->fetch()){
                $groups_class_obj_tmp = new groups_class($row['group_id']);
                $result[$row['group_id']] = $groups_class_obj_tmp->get_info();
                unset ($groups_class_obj_tmp);
            };
        }
        return $result;
    }

    function add_to_group($uid){
        $result = false;
        $member = $this->check_member($uid);
        if (!$member) {
            $arr_to_add = array();
            $arr_to_add['group_id'] = $this->id;
            $arr_to_add['user_id'] = (int) $uid;
            $arr_to_add['i_role'] = 0; // роль обычного пользователя
            $tmp_res = $this->db->insert('sv_groups', $arr_to_add);
            $result = $tmp_res['id'];
            //Увеличиваем счетчик участников группы
            $this->i_members_inc();
            //У пользователя увеличиваем счетчик групп в  которых он состоит
            $user = new users($uid);
            $user->i_members_inc();
        }
        return $result;
    }

    function set_admin($sv_id){
        $arr_to_update['i_role'] = 1;
        $this->db->update('sv_groups', $sv_id, $arr_to_update);
        return true;
    }

}