<?php
/**
 * Класс для работы с поиском
 * Created by PhpStorm.
 * User: Spectrum
 * Date: 14.11.13
 * Time: 16:22
 */

class search extends db{
    protected $db;

    /**
     * Конструктор
     */
    function __construct(){
        parent::__construct();
        $this->db=db::create();
    }

    /**
     * Метод осуществляет поиск по базе людей и групп
     * @param $query
     * @return array
     */
    function search($query){
        $result = array();
        if ((strlen($query)>100)||(empty($query))){
            return $result;
        }

        $words = explode(' ', $query);
        $sql_where_array = array();

        foreach($words as $word){
            $sql_where_array[] = "ch_fname LIKE(".$this->db->quote('%'.$word.'%').")";
            $sql_where_array[] = "ch_lname LIKE(".$this->db->quote('%'.$word.'%').")";
        }

        $sql = 'SELECT id FROM users WHERE '.implode(' OR ', $sql_where_array);
        $users_db_res = $this->db->query($sql);
        if ($users_db_res->rowCount()>0){
            while($user_row = $users_db_res->fetch()){
                $user = new users($user_row['id']);
                $result[] = array(
                    'type' => 'people',
                    'info' => $user->get_info()
                );
            }

        }
        return $result;
    }

    /**
     * Возвращает список приглашенных пользователей в сеть заданным пользователем
     * @param $user_id
     * юид пользователя
     * @return array
     * список приглашенных пользователей с основной информацией о них, аватарками и прочим.
     */
    function get_invited_users($user_id){
        $result = array();
        $sql = 'SELECT id, ch_fname, ch_lname, avatar_url233x233, avatar_url50x50 FROM users WHERE refer_uid = '.$this->db->quote($user_id);
        $users_db_res = $this->db->query($sql);
        if ($users_db_res->rowCount()>0){
            while($user_row = $users_db_res->fetch()){
                $result[] = $user_row;
            }
        }
        return $result;
    }

    private function __clone(){}
    private function __wakeup(){}
}