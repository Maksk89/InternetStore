<?php
namespace api;

use classes\App;
use models\UserModel;

class LogoutAction
{
    // Метод запуска экшна.
    public function run()
    {
        // Удаление пользователя из сессии.
        unset($_SESSION['user_id']);

        // Возвращение положительного результата.
        return ['status' => true];
    }
}
?>