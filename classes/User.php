<?php
namespace classes;

use models\UserModel;
use models\SessionModel;

class User
{
    // Переменная, показывающая, вошел ли пользователь.
    protected $login = false;
    // Переменная, содержащая адрес электронной почты пользователя.
    public $email = "";

    // Конструктор класса, внутри осуществляется проверка авторизации.
    function __construct()
    {
        // Добавление сессии пользователя в базу данных.
        $this->addSession();
        $this->login = false;
        // Если в сессии существует user_id.
        if (isset($_SESSION['user_id'])) {
            // Создание объекта модели пользователя.
            $user = new UserModel();
            // Попытка получить пользователя по его id, данные пользователя возвращаются в userData.
            $userData = $user->getUserById($_SESSION['user_id']);
            // Если запрос вернул пустой массив, значит пользователя не существует.
            if (!empty($userData)) {
                // Если пользователь есть, то:
                // Флаг авторизации ставится в "правда".
                $this->login = true;
                // Сохраняется почта пользователя в свойство email
                $this->email = $userData[0]['email'];
                return;
            }
        }
    }

    // Метод добавления сессии пользователя.
    public function addSession()
    {
        // Инициализация модели сессии.
        $session = new SessionModel();

        // Получение сессии пользователя.
        $userSession = $session->select([],[
            [
                'AND',
                '=',
                'sid',
                // Метод возвращает идентификатор сессии пользователя.
                session_id(),
                'AND',
                '=',
                'browser',
                $_SERVER['HTTP_USER_AGENT']
            ]

        ],[]);

        // Если сессия пользователя отсутствует.
        if (empty($userSession))
        {
            // Добавление сессии пользователя в базу данных.
            $session->insert([
                'sid' => session_id()
            ]);
        }
    }

    // Метод возвращает флаг авторизации пользователя.
    public function isLogin()
    {
        return $this->login;
    }

    // Метод возвращает данные текущего пользователя.
    public function getCurrentUser()
    {
        // Создание объекта модели пользователя.
        $user = new UserModel();

        // Получение пользователя по его id из сессии.
        $userData = $user->getUserById($_SESSION['user_id']);

        // Если пользователя нет, метод возвращает пустое значение.
        if (empty($userData)) {
            return null;
        }
        // Метод возвращает данные пользователя.
        return $userData[0];
    }
}

?>