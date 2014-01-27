<?php
/**
 * Class users
 * Класс для работы с пользователями
 */
class users
{
    private $id = false, $data = array(), $db;

    static $user = false;
    static $error = array(
        0 => 'авторизован',
        1 => 'Неверный логин или пароль',
        2 => 'Не активирован',
        3 => 'Заблокирован',
        4 => 'Удален с возможностью восстановления',
        5 => 'Удален без возможности восстановления',
        6 => 'Не найден'
    );
    public $error_no = 0, $error_text = '';
    /**
     * Конструктор класса users
     * @param $id
     */
    function __construct($id)
    {
        $this->db = db::create();
        $this->id = $id;
        $this->data = $this->db->getone('users', $id);
        return $this->get_info();
    }

    /**
     * Функция не используется в данный момент
     * @param $uids
     * @return bool
     */
    static function validate_uids($uids)
    {
        $res = false;
        return $res;
    }

    /**
     * Метод для получения информации о пользователях
     * используется в API
     * @param $uids
     * @param $fields
     * @param string $name_case
     * @return array
     */
    function get_api($uids, $fields, $name_case = 'nom')
    {
        $result = array();
        $i = 0;
        if (count($uids) > 1000) return $result;
        if (count($fields) > 1000) return $result;
        $uids = array_unique(uids);
        $fields = array_unique($fields);
        foreach ($uids as $uids_item) {
            $tmp_user_data = $this->db->getone('users', $uids_item);
            $result[$i]['uid'] = $tmp_user_data['id'];
            foreach ($fields as $fields_item) {
                //if ($fields_item == '')
            }
        }

    }

    /**
     * Создает нового пользвоателя
     * @param $mail
     * @param $pass
     * @param $fname
     * @param string $iname
     * @param string $pname
     * @return users
     */
    static function create($mail, $pass, $fname, $iname = '', $pname = '')
    {
        $array = array(
            'ch_email' => $mail,
            'ch_fname' => $fname,
            'ch_lname' => $iname,
            'ch_pname' => $pname,
            'ch_pass' => md5($pass),
            'ch_active' => 1
        );

        //Если пользователь зашел по ссылке друга, то пишем UID друга ему в профиль
        if (!empty($_SESSION['referid'])) {
            $array['refer_uid'] = $_SESSION['referid'];
        }


        $user_info = db::create()->insert('users', $array);
        db::create()->mem_clear('users', $user_info['id']);
        self::$user = new users($user_info['id']);
        return self::$user;
    }

    /**
     * Возвращает uid пользователя
     * @return mixed
     */
    static function id()
    {
        $user = users::get()->get_info();
        return $user['id'];
    }

    function name()
    {
        $user = $this->data;
        return $user['ch_fname'] . ' ' . $user['ch_lname'];
    }

    static function get($redirect = false)
    {
        $sess = users::session_info($redirect);
        if (!self::$user) self::$user = new users($sess['uid']);
        //получает класс пользвоателя
        return self::$user;
    }

    static function logout()
    {
        session_destroy();
        return true;
    }

    /**
     * Функция проверяет наличие такого пользователя, если он есть, то проверяется работоспособность пароля
     * @param $login
     * @param string $pass
     * @return array
     */
    static function check_login($login, $pass = "")
    {
        $result = array(
            'login_result' => false,
            'uid' => false,
            'error' => false,
        );
        $db = db::create();
        $sql = 'SELECT id, ch_email, ch_pass FROM users WHERE ch_email = ' . $db->quote($login);
        $dbRes = $db->query($sql);
        if ($dbRes->rowCount() > 0) {
            $user_row = $dbRes->fetch();
            if ($user_row['ch_pass'] == md5($pass)) {
                $result['login_result'] = true;
                $result['uid'] = $user_row['id'];
            } else {
                $result['error'] = 'Неправильный пароль';
            }
        }
        return $result;
    }

    /**
     * Вход пользователя в систему
     * @param $login
     * @param $pass
     * @return array
     */
    static function login($login, $pass)
    {
        if (!self::$user) {
            $db = db::create();
            $id = $db->login($login, $pass);
            if (!empty($id)){
                $user = new users($id);
            }
        }
        // коды ошибок находятся в user::$error
        $login_result = 0;
        if (!isset($user->data['id'])) {
            $login_result = 1;
        }
        switch ($user->data['ch_active']) {
            case '1':
                $login_result = 2;
                break;
            case '2':
                $login_result = 3;
                break;
            case '3':
                $login_result = 4;
                break;
            case '4':
                $login_result = 5;
                break;
        }
        return array('login_result' => $login_result, 'user_id' => $id);
    }

    /**
     * Старт сессии, если в инфе о пользователе
     * @return bool
     */
    function session_run()
    {
        if (empty($this->data['vc_city'])){
            $gb = new geo_av();
            $data = $gb->getRecord($_SERVER['HTTP_X_REAL_IP']);
            if ($data){
                $this->set_field('vc_city', $data['city']);
            }
        }
        $_SESSION['logged'] = true;
        $_SESSION['uid'] = $this->id;
        return true;
    }

    /**
     * Возвращение информации о сессии пользователя
     * @param bool $auto_redirekt
     * редиректить его на главную если сесси нет
     * @return array
     */
    static function session_info($auto_redirekt = true)
    { //возвращает содержимое сессии, либо перенаправляет на страницу входа
        $res = array('logged' => false);

        if (empty($_SESSION['langID'])) $_SESSION['langID'] = 1;

        if ((empty($_SESSION['logged'])) && ($auto_redirekt)) {
            header('Location: ' . base_site_url . '/login/');
            die;
        }

        $res = array_merge($res, $_SESSION);

        return $res;
    }

    /**
     * Принудительная очистка кеша
     */
    function cc()
    {
        $this->data = array();
    }

    /**
     * Возвращает информацию о пользователе
     * @param int $id
     * @param bool $protected
     * В случае передачи "тру" возвращает только основную информацию о пользователе
     * @return array|bool|mixed
     */
    function get_info($id = 0, $protected = false)
    {
        if (!$id) $id = $this->id;
        if (!$id) return false;
        // если ид пользвоателя не текущий то выбираем инфу по указаному ИД
        if ($id != $this->id) return $this->db->getone('users', $id);
        // Если data пустой то выборка из БД/кэша
        if (empty($this->data)) {
            $this->data = $this->db->getone('users', $id);
        }
        if (!$this->data){
            $this->error_no = 1;
            $this->error_text = 'not found';
            return false;
        }
        if (empty($this->data['avatar_url50x50'])) {
            $srv_url = servers_class::get_server_url(servers_class::find_server_by_type(2));
            $this->data['avatar_url50x50'] = $srv_url . 'avatar_50x50.jpg';
        }
        if (empty($this->data['avatar_url233x233'])) {
            $srv_url = servers_class::get_server_url(servers_class::find_server_by_type(2));
            $this->data['avatar_url233x233'] = $srv_url . 'avatar_233x233.jpg';
        }
        if ($protected==true){
            $tmp = array();
            $protected_info = array('id', 'ch_fname', 'ch_lname', 'avatar_url50x50');
            foreach($protected_info as $field){
                $tmp[$field] = $this->data[$field];
            }
            return $tmp;
        }else{
            return $this->data;
        }
    }

    /**
     * Изменение данных о пользователе
     * @param $array
     * @return array|bool|mixed
     */
    function change($array)
    {
        if (!$this->id) return false;
        // Изменение данных о пользователе
        $this->db->update('users', $this->id, $array);
        // Очистка массива чтобы get_info подцепил свежие данные
        $this->data = array();
        return $this->get_info();
    }

    /**
     * Неиспользуемая функция
     * @param $id
     * @param array $data
     */
    private function set_user($id, array $data)
    {
        $this->id = $id;
        $this->data = $data;
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    /**
     * Неиспользуемая функция
     * @return array|mixed
     */
    function get_photo_albums()
    {
        $res = unserialize($this->data['ser_photo_albums']);
        if (false == $res) {
            $res = array();
            $this->data['ser_photo_albums'] = serialize($res);
            $this->db->update('users', $this->id, array('ser_photo_albums' => $this->data['ser_photo_albums']));
        }
        return $res;
    }

    /**
     * Неиспользуемая функция
     * @param $del_photo_album_id
     */
    function del_photo_album($del_photo_album_id)
    {
        $photo_albums_array = unserialize($this->data['ser_photo_albums']);
        array_unique($photo_albums_array);
        unset($photo_albums_array[array_search($del_photo_album_id, $photo_albums_array)]);
        $this->data['ser_photo_albums'] = serialize($photo_albums_array);
        $this->db->update('users', $this->id, array('ser_photo_albums' => $this->data['ser_photo_albums']));
    }

    /**
     * Неиспользуемая функция
     * @param $array_ids_albums
     */
    function set_photo_albums($array_ids_albums)
    {
    }

    function get_wall()
    {
    }

    /**
     * Неиспользуемая функция
     * @param string $text
     * @param $fromUser
     * @return mixed
     */
    function add_item_to_wall($text = '', $fromUser)
    {
        //$result = true;
        $item_to_add = array();
        $item_to_add['fk_user'] = $fromUser;
        $item_to_add['t_content'] = $text;
        //Новый пост свяжем с предыдущим
        $item_to_add['prev_wall'] = $this->data['fk_last_wall'];
        $wall_item = $this->db->insert('wall', $item_to_add);
        //предыдущий пост с новым
        if (!empty($item_to_add['prev_wall'])) {
            $this->db->update('wall', $item_to_add['prev_wall'], array('next_wall' => $wall_item['id']));
        }
        //Обновим данные профиля
        $this->data['fk_last_wall'] = $wall_item['id'];
        //Сохраняем данные в базу
        $this->db->update('users', $this->id, array('fk_last_wall' => $this->data['fk_last_wall']));
        return $this->data['fk_last_wall'];
    }

    /**
     * Неиспользуемая функция
     * @param $startID
     * @param $count
     * @return array
     */
    function get_wall_items($startID, $count)
    {
        $first_no_hidden = false;
        if (0 == $startID) {
            $startID = $this->data['fk_last_wall'];
            $first_no_hidden = true;
        }
        $result = array();
        $result_count = 0;
        $currentID = $startID;
        if ($currentID != 0) {
            do {
                $last_item = $this->get_wall_item_byId($currentID);
                $result_count++;
                $currentID = $last_item['prev_wall'];
                //На случай подгрузки аяксом, пост с этим айдишником уже показан на странице
                if (($first_no_hidden) || ($startID != $last_item['id'])) {
                    $result[] = $last_item;
                }
            } while (($result_count < $count) && (0 != $last_item['prev_wall']));
        }
        return $result;
    }

    /**
     * Неиспользуемая функция
     * @param $wallID
     * @return bool|mixed
     */
    function get_wall_item_byId($wallID)
    {
        $result = false;
        if (0 == $wallID) return $result;
        $result = $this->db->getone('wall', $wallID);

        $user = new users($result['fk_user']);
        $result['user_name'] = $user->name();
        $result['user_id'] = $user->get_field('id');
        $result['user_avatar_url50x50'] = $user->get_field('avatar_url50x50');

        if (0 != $result['fk_owner']) {
            $owner_user = new users($result['fk_owner']);
            $result['owner_user_name'] = $owner_user->name();
            $result['owner_id'] = $owner_user->get_field('id');
            $result['owner_avatar_url50x50'] = $owner_user->get_field('avatar_url50x50');
        }
        return $result;
    }

    /**
     * Неиспользуемая функция
     * @param $postID
     * @return bool
     */
    function dell_wall_byID($postID)
    {
        $del_post = $this->db->getone('wall', $postID);
        $prev_post = false;
        $next_post = false;
        if (0 != $del_post['prev_wall']) {
            $prev_post = $this->db->getone('wall', $del_post['prev_wall']);
        }
        if (0 != $del_post['next_wall']) {
            $next_post = $this->db->getone('wall', $del_post['next_wall']);
        }
        if ((!empty($prev_post)) && (!empty($next_post))) {
            $prev_post['next_wall'] = $next_post['id'];
            $next_post['prev_wall'] = $prev_post['id'];
        }
        if ((!empty($prev_post)) && (empty($next_post))) {
            $this->data['fk_last_wall'] = $prev_post['id'];
            $prev_post['next_wall'] = 0;
        }
        if ((empty($prev_post)) && (!empty($next_post))) {
            $next_post['prev_wall'] = 0;
        }
        if ((empty($prev_post)) && (empty($next_post))) {
            $this->data['fk_last_wall'] = 0;
        }
        if (!empty($next_post)) {
            $this->db->update('wall', $next_post['id'], array('prev_wall' => $next_post['prev_wall']));
        }
        if (!empty($prev_post)) {
            $this->db->update('wall', $prev_post['id'], array('next_wall' => $prev_post['next_wall']));
        }
        $this->db->update('wall', $del_post['id'], array('i_del' => 1));
        $this->db->update('users', $this->id, array('fk_last_wall' => $this->data['fk_last_wall']));
        return true;
    }

    /**
     * Получение списка друзей пользователя
     * @return array
     */
    function get_friends()
    {
        $result = array();
        $sql = "SELECT user_id FROM sv_friends WHERE fk_user=" . $this->id;
        $dbRes = $this->db->query($sql);
        if ($dbRes->rowCount() > 0) {
            while ($row = $dbRes->fetch()) {
                $usr_tmp = new users($row['user_id']);
                $result[] = $usr_tmp->get_info();
            }
        }
        return $result;
    }

    /**
     * проверка дружбы между пользователями
     * @return string
     */
    function check_friendship()
    {
        $me = users::get();
        if ($me->id() == $this->id) {
            return 'iam';
        }
        $sql = "SELECT id, user_id FROM sv_friends WHERE fk_user=" . $this->id;
        $dbRes = $this->db->query($sql);
        if ($dbRes->rowCount() > 0) {
            while ($row = $dbRes->fetch()) {
                $friends_ids[$row['id']] = $row['user_id'];
            }
        }
        $res = 'no';
        if (array_search($me->id(), $friends_ids)) {
            $res = 'yes';
        } else {

            $sql = 'SELECT * FROM request_to_friends WHERE fk_user in (' . $this->id . ',' . $me->id() . ') AND fk_to_user in (' . $this->id . ',' . $me->id() . ')';
            $dbRes = $this->db->query($sql);
            if (0 != $dbRes->rowCount()) {
                if ($dbRes->rowCount() == 2) {

                } elseif ($dbRes->rowCount() == 1) { //Одна заявка найдена, проверяем кто кому шлет эту заявку
                    $request_info = $dbRes->fetch();
                    if ($request_info['fk_user'] == $me->id()) { //Заявка уже была отправлена
                        $res = 'out';
                    } else {
                        $res = 'in'; //Была получена заявка текущему пользователю
                    }
                }
            }
        }
        return $res;
    }

    /**
     * удаление из друзей
     * @param $friend_id
     * @return bool
     */
    function del_friend($friend_id)
    {
        $sql = 'SELECT id FROM sv_friends WHERE user_id in (' . $this->id . ',' . $friend_id . ') AND fk_user in (' . $this->id . ',' . $friend_id . ')';
        $dbRes = $this->db->query($sql);
        if ($dbRes->rowCount() > 0) {
            while ($row = $dbRes->fetch()) {
                $this->db->delete('sv_friends', $row['id']);
            }
            $friend = new users($friend_id);
            $from_user_info = $friend->get_info();

            events_class::create($this->id, 4, 0, array(
                'uid' => $friend_id,
                'name' => $from_user_info['ch_fname'] . ' ' . $from_user_info['ch_lname'],
                'action' => 'del'
            ));
            events_class::create($friend_id, 4, 0, array(
                'uid' => $this->id,
                'name' => $this->data['ch_fname'] . ' ' . $this->data['ch_lname'],
                'action' => 'i_del'
            ));
        }
        return true;
    }

    /**
     * получает список заявок в друзья для текущего пользователя
     * @return array
     */
    function get_requestes_to_friend()
    {
        $result = array();
        $sql = 'SELECT id, fk_user FROM request_to_friends WHERE fk_to_user= ' . $this->id;
        $dbRes = $this->db->query($sql);
        if ($dbRes->rowCount() > 0) {
            while ($row = $dbRes->fetch()) {
                $rUser = new users($row['fk_user']);
                $result[] = array(
                    'user_info' => $rUser->get_info(),
                );
            }
        }
        return $result;
    }

    /**
     * Функция добавления заявки в друзья
     * @param $from_user_id
     * @return array
     */
    function add_request_to_friend($from_user_id)
    {
        $res = array(
            'result' => false,
            'error' => false,
            'error_text' => ''
        );
        $from_user = new users($from_user_id);
        $from_user_info = $from_user->get_info();
        //Проверка на наличие пол.. дружеской связи между пользователями
        switch ($this->check_friendship()) {
            case 'no':
                $request = $this->db->insert('request_to_friends', array(
                    'fk_user' => $from_user_id,
                    'fk_to_user' => $this->id,
                ));
                events_class::create($this->id, 3, $request['id'], array('uid' => $from_user_id, 'name' => $from_user_info['ch_fname'] . ' ' . $from_user_info['ch_lname']));
                $res['result'] = true; //Заявка была отправлена успешно
                break;
            case 'out':
                $res['error'] = true;
                $res['error_text'] = "Заявка уже была отправлена ранее";
                break;
            case 'in':
                $sql = 'SELECT id FROM request_to_friends WHERE fk_user in (' . $this->id . ',' . $from_user_id . ') AND fk_to_user in (' . $this->id . ',' . $from_user_id . ')';
                $dbRes = $this->db->query($sql);
                while ($row = $dbRes->fetch()) {
                    $this->db->delete('request_to_friends', $row['id']);
                }
                //Добавляем этих двух людей друг другу в друзья
                $this->db->insert('sv_friends', array(
                    'user_id' => $this->id,
                    'friends_group_id' => 1,
                    'fk_user' => $from_user_id
                ));
                $this->db->insert('sv_friends', array(
                    'user_id' => $from_user_id,
                    'friends_group_id' => 1,
                    'fk_user' => $this->id
                ));
                events_class::create($this->id, 4, 0, array(
                    'uid' => $from_user_id,
                    'name' => $from_user_info['ch_fname'] . ' ' . $from_user_info['ch_lname'],
                    'action' => 'add'
                ));
                events_class::create($from_user_id, 4, 0, array(
                    'uid' => $this->id,
                    'name' => $this->data['ch_fname'] . ' ' . $this->data['ch_lname'],
                    'action' => 'add'
                ));
                $res['result'] = true;
                break;
        }
        return $res;
    }

    /**
     * Добавляет приложение в коллекцию к пользователю
     * @param $id
     * @return bool
     */
    function add_apps($id){
        if (users::id()==$this->id){
            $apps_ids = $this->get_apps();
            $apps_ids[] = $id;
            $apps_ids = array_unique($apps_ids);
            $this->data['ser_apps'] = serialize($apps_ids);
            $this->db->update('users', $this->id, array('ser_apps' => $this->data['ser_apps']));
            return true;
        }else{
            return false;
        }
    }

    /**
     * Получает список установленных приложений у пользователя
     * @return array|mixed
     */
    function get_apps()
    {
        $result = array();
        $apps_ids = unserialize($this->data['ser_apps']);
        if (false == $apps_ids) {
            $apps_ids = array();
            $this->data['ser_apps'] = serialize($apps_ids);
            $this->db->update('users', $this->id, array('ser_apps' => $this->data['ser_apps']));
        } else {
            $result = $apps_ids;
        }
        return $result;
    }

    /**
     * Удаляет приложение из списка приложений пользователя, проверка прав доступа не требуется
     * @param $app_id
     * @return bool
     */
    function del_apps($app_id){
        //Проверка прав доступа
        if (users::id()==$this->id){
            $apps_ids = $this->get_apps();
            unset ($apps_ids[array_search($app_id, $apps_ids)]);
            $this->data['ser_apps'] = serialize($apps_ids);
            $this->db->update('users', $this->id, array('ser_apps' => $this->data['ser_apps']));
            return true;
        }else{
            return false;
        }
    }

    /**
     * Функция накидывания средств в кошелек
     * добавляются авы
     * @param $summ
     * @return bool
     */
    function add_money_av($summ)
    {
        $this->get_info();
        $this->data['d_money_av'] += $summ;
        $this->db->update('users', $this->id, array('d_money_av', $this->data['d_money_av']));
        return true;
    }

    /**
     * Получить колличество ав
     * @return mixed
     */
    function get_money_av()
    {
        $this->get_info();
        return $this->data['d_money_av'];
    }

    /**
     * Установка аватара пользователя
     * @param $srv_info_id
     * id сервера куда грузить фотки
     * @param $srv_info_dirName
     * имя подкаталога
     * @param $srv_info_vc_baseurl
     * базовый УРЛ сервера
     * @param $files
     * Файлы передаются массивом где:
     * name - путь до одного изображения
     * size_name - название размера изображения (например 50x50)
     */
    function setAvatar($srv_info_id, $srv_info_dirName, $srv_info_vc_baseurl, $files)
    {
        $update_array['avatar_fk_server'] = $srv_info_id;
        $update_array['avatar_dirName'] = $srv_info_dirName;
        foreach ($files as $file_item) {
            $update_array['avatar_fileName' . $file_item['size_name']] = $file_item['name'];
            $update_array['avatar_url' . $file_item['size_name']] = $srv_info_vc_baseurl . $srv_info_dirName . '/' . $file_item['name'];
        }
        $this->change($update_array);
    }

    /**
     * Функция устанавливает произвольное свойство пользователя
     * @param $field
     * поле для изменения
     * @param $value
     * значение
     * @return bool
     */
    function set_field($field, $value)
    {
        $this->get_info();
        $this->data[$field] = $value;
        $this->db->update('users', $this->id, array($field => $value));
        return true;
    }

    /**
     * получить произвольное свойство пользователя
     * @param $field
     * @return mixed
     */
    function get_field($field)
    {
        $this->get_info();
        return $this->data[$field];
    }

    /**
     * неиспользуемая функция
     */
    function get_options()
    {
    }

    /**
     * Используется в момент входа пользователя через соц сети, по его UID в соц сети возвращается fk_user с нашим UID
     * @param $uid
     * @return bool
     * false - в случае неудачного поиска
     * array('fk_user'=>UID) в случае если пользователь найден
     */
    static function get_user_by_social_uid($uid)
    {
        $db = db::create();
        $result = false;
        $social = $db->getone('social_users', $uid);
        if (1 == $social['i_active']) {
            $result = $social['fk_user'];
        }
        return $result;
    }

    /**
     * Связка пользователя с UID в соц сетях
     * @param $social_uid
     * @param $avatoria_uid
     * @param $userInfo
     */
    static function create_social_uid($social_uid, $avatoria_uid, $userInfo)
    {
        $db = db::create();
        $db->insert('social_users', array('id' => $social_uid, 'fk_user' => $avatoria_uid, 'text_user_info' => serialize($userInfo), 'i_active' => 1));
    }

    /**
     * API функция для накидывания биллетов приложением
     * @param $billets
     * @return bool
     */
    function add_billets($billets)
    {
        $this->get_info();
        $this->data['d_money_bonus'] += abs($billets);
        $this->db->update('users', $this->id, array('d_money_bonus' => $this->data['d_money_bonus']));
        events_class::create($this->id, 2, 0, array('addbillets' => $billets));
        return true;
    }

    /**
     * Функция списывания средств со счета пользователя
     * Вызывается внутри invoice класса
     * @param $av
     * колличество "АВ" списываемых со счета
     * @param $comment
     * комментарий списывания
     * @param $app_id
     * ид приложения которое списывает средства
     * @return array
     * результат - массив с двумя значениями:
     * error - текст ошибки (в случае успеха пустая строка)
     * result - (true/false) результат выполнения
     */
    function take_av($av, $comment, $app_id){
        $result = array(
            'error' => '',
            'result' => false
        );
        $this->get_info();
        if ($this->data['d_money_av']>=$av){
            $this->data['d_money_av'] = $this->data['d_money_av'] - $av;
            $this->db->update('users', $this->id, array('d_money_av'=>$this->data['d_money_av']));
            $result['error'] = '';
            $result['result'] = true;
        }else{
            $result['error'] = 'Недостаточно средств';
            $result['result'] = false;
        }
        return $result;
    }

    /**
     * Устанавливает значение дополнительного поля пользователя
     * @param $field
     * название поля
     * @param $value
     * значение
     * @return bool
     */
    function set_extended_field($field, $value){
        $sql = 'DELETE FROM users_extended_fields WHERE fk_user = '.$this->db->quote($this->id).' AND field_name = '.$this->db->quote($field);
        $this->db->query($sql);
        $sql = 'INSERT INTO users_extended_fields SET fk_user = '.$this->db->quote($this->id).', field_name = '.$this->db->quote($field).', field_value = '.$this->db->quote($value);
        $this->db->query($sql);
        return true;
    }

    /**
     * Запрашивает любое дополнительное поле сохраненное ранее через set_extended_field
     * полезно для использования в доп сервисах сети
     * @param $field
     * ключ поля
     * @return bool
     * возвращает false в случае отсутствия значения, либо само значение
     */
    function get_extended_field($field){
        $result = false;
        $sql = 'SELECT * FROM users_extended_fields WHERE fk_user = '.$this->db->quote($this->id).' AND field_name = '.$this->db->quote($field);
        $users_extend_res = $this->db->query($sql);
        if ($users_extend_res->rowCount()>0){
            while($user_row = $users_extend_res->fetch()){
                $result = $user_row['field_value'];
            }
        }
        return $result;
    }

    /**
     * Метод достает список товаров которые нуждаются в оплате (кошелек)
     * @return array
     */
    function get_unpaid_items(){
        $result = array();
        $sql = 'SELECT * FROM money_invoices WHERE fk_user = '.$this->db->quote($this->id).' AND i_status = 0 AND i_reserved = 0 AND i_type = 0 AND ts_active > NOW() ORDER BY ts_create DESC';
        return $result;
    }

    /**
     * Метод возвращает true если пользователь администратор аватории
     * @return bool
     */
    function is_admin(){
        $result = false;
        if ($this->data['i_admin']==1){
            $result = true;
        }
        return $result;
    }

    /**
     * Увеличивает счетчик состояния в группах на 1
     */
    function i_members_inc(){
        $this->data['i_members']++;
        $this->set_field('i_members', $this->data['i_members']);
    }

    /**
     * Уменьшает счетчик состояния в группах на 1
     */
    function i_members_dec(){
        $this->data['i_members']--;
        $this->set_field('i_members', $this->data['i_members']);
    }
}