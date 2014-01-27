<?php
/**
 * Класс для работы со счетами
 * Created by JetBrains PhpStorm.
 * User: osipyan
 * Date: 12.06.13
 * Time: 21:40
 * To change this template use File | Settings | File Templates.
 */

class invoice_class
{
    private $id = false, $data = array(), $db;
    static $invoice = false;

    /**
     * Конструктор
     * @param bool $id
     */
    function __construct($id = false)
    {
        $this->db = db::create();
        $this->id = $id;
        return $this->get_info();
    }

    /**
     * Вытаскивает информацию о заказе
     * @return array|bool|mixed
     */
    function get_info()
    {
        if (empty($this->id)) return false;
        // Если data пустой то выборка из БД/кэша
        if (empty($this->data)) {
            $this->data = $this->db->getone('money_invoices', $this->id);
        }
        return $this->data;
    }

    /**
     * выставляет счет пользователю
     * @param $fk_user
     * юид пользователя которому выставляется счет
     * @param $from_type
     * от кого: app, user, network
     * @param $from_id
     * id объекта сгенерировавшего счет
     * @param int $ts_active
     * длительность в секундах сколько счет будет считаться актуальным
     * @param $vc_name
     * название товара на который выставлен счет
     * @param $price
     * цена
     * @param string $vc_price_type
     * Код валюты по международному стандарту ISO 4217 (alfa-3)
     * @param $description
     * Комментарий к счету
     * @param int $i_type
     * 0 - стандартный счет, 1 - перевод средств от пользователя (последнее уже не используется здесь)
     * @param int $i_reserved
     * 1 - отображать счет в кошельке, 1 - не отображать
     * @return int $id
     * id - айдишник заказа
     */
    static function create($fk_user, $from_type, $from_id, $ts_active, $vc_name, $price, $vc_price_type = 'RUB', $description, $i_type = 0, $i_reserved = 0)
    {
        $data['fk_user'] = $fk_user;
        $data['from_type'] = $from_type;
        $data['from_id'] = $from_id;
        $data['ts_create'] = time();
        $data['ts_active'] = time() + $ts_active;
        $data['i_type'] = $i_type;
        $data['vc_name'] = $vc_name;
        $data['vc_description'] = $description;
        $data['price'] = $price;
        $data['vc_price_type'] = $vc_price_type;
        $data['i_status'] = 0;
        $data['i_reserved'] = $i_reserved;

        $db = db::create();
        $result_db = $db->insert('money_invoices', $data);

        $id = $result_db['id'];
        return $id;
    }

    /**
     * Метод используется для показа списка заказов в кошельке пользователя
     * @param $uid
     * @return array
     */
    static function get_invoices_for_user($uid){
        $result = array();
        $db = db::create();

        $sql = 'SELECT * FROM money_invoices WHERE fk_user='.$db->quote($uid).' AND ts_active >= '.$db->quote(time()).' AND i_type = 0 AND i_status = 0 AND i_reserved = 0 ORDER BY id DESC LIMIT 7';

        $dbRes = $db->query($sql);
        if ($dbRes->rowCount()){
            while($row = $dbRes->fetch()){
                $result[] = $row;
            }
        }
        return $result;
    }

    function cancel(){
        $this->set_field('i_status', 3);
        return 'ok';
    }
    /**
     * Оплата счета, так же выполняется вызов метода users::take_av которая производит попытку списания средств со счета пользователя
     * @return bool
     */
    function pay()
    {
        if (($this->data['from_type'] == 'app') || ($this->data['from_type'] == 'network')) {
            $this->set_field('i_status', 1);

            /* тут происходит чудесная магия списания средств */
            $user = new users($this->data['fk_user']);
            $result_take_av = $user->take_av($this->data['summ'], $this->data['vc_description'], $this->data['from_id']);

            if ($result_take_av['result']==true){
                return true;
            }else{
                return false;
            }

            $app = new apps($this->data['from_id']);
            $tmp_fburl = $app->get_field('fburl');

            if (!empty($tmp_fburl)){
                $q = $tmp_fburl . '?invoiceID=' . $this->id;
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $q);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_exec($ch);
                curl_close($ch);
            }

        } else {
            return false;
        }
    }

    /**
     * Получить поле счета
     * @param $field
     * поле
     * @return mixed
     * значение
     */
    function get_field($field)
    {
        $this->get_info();
        return $this->data[$field];
    }

    /**
     * Задать поле счета
     * @param $field
     * поле
     * @param $value
     * значение
     * @return bool
     * результат задания свойства
     */
    function set_field($field, $value)
    {
        $this->get_info();
        $this->data[$field] = $value;
        $this->db->update('money_invoices', $this->id, array($field => $value));
        return true;
    }

}