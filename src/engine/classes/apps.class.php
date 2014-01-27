<?php
/**
 * Created by JetBrains PhpStorm.
 * Класс для работы с приложениями
 * User: Spectrum
 * Date: 20.08.13
 * Time: 22:19
 */

class apps
{
    private $id = false, $data = array(), $db;

    /**
     * Конструктор класса
     * @param int $id
     * id приложения
     */
    function __construct($id = 0)
    {
        $this->db = db::create();
        $this->id = $id;
        if (0 != $id) {
            $this->get_info();
        }
        return true;
    }

    /**
     * Получение информации о приложении
     * @return bool|mixed
     */
    function get_info()
    {
        $this->data = $this->db->getone('clients', $this->id);
        return $this->data;
    }

    /**
     * Выборка произвольного поля приложения
     * @param $field
     * @return bool
     */
    function get_field($field)
    {
        if ($this->get_info()) return $this->data[$field];
        return false;
    }

    /**
     * Создание приложения
     * @param $uid
     * @param string $app_name
     * @param string $redirect_uri
     * @return bool
     */
    function create($uid, $app_name = '', $redirect_uri = '')
    {
        $max_id = $this->db->get_max('clients');
        if (empty($app_name)) $app_name = 'my application ' . $max_id;
        $user = new users($uid);
        $user_apps = $user->get_apps();
        if (count($user_apps) >= configure::$apps_limit) return false; //Не превышен ли лимит на количество приложений

        $result = $this->db->insert(
            'clients',
            array(
                'id' => $max_id,
                'client_id' => 'app' . $max_id,
                'app_name' => $app_name,
                'fk_user' => $uid,
                'client_secret' => create_password(10),
                'redirect_uri' => $redirect_uri
            )
        );
        $this->id = $result['id'];

        if (!empty($this->id)) {
            //если удачно завели в базе запись о приложении то обновляем запись с пользователем
            $this->get_info();
            $user_apps[] = $result['id'];
            $user->change(array('ser_apps' => serialize($user_apps)));
            return $this->id;
        } else {
            //Если запись не удалось добавить, то возвращаем false
            return false;
        }
    }

    /**
     * Установка значения произвольного поля
     * @param $field
     * @param $value
     * @return bool
     */
    function set_field($field, $value)
    {
        $this->get_info();
        $this->data[$field] = $value;
        $this->db->update('clients', $this->id, array($field => $value));
        return true;
    }
}