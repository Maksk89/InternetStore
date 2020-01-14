<?php
namespace api;

use classes\App;
use models\UserModel;

class RegisterAction
{
    // Метод запуска экшна.
    public function run()
    {
        // Создание модели пользователя.
        $user = new UserModel();

        // Проверка на то, что пользователь залогинен.
        if (App::$user->isLogin()) {
            // Если он уже залогинен, то регистрация невозвожна. Возвращается сообщение об этом.
            return ['state' => false, 'message' => 'Вы уже вошли на сайт.', ];
        }
        // Проверка на то, что все нужные данные пришли с формы в $_POST.
        if ((empty($_POST['reg_email'])) || (empty($_POST['reg_password'])) || (empty($_POST['reg_password_repeat']))) {
            return ['status' => false, 'message' => 'Заполните все поля'];
        }
        // Проверка на то, что пароль и поле "повторите пароль" совпадают.
        if ($_POST['reg_password'] != $_POST['reg_password_repeat']) {
            return ['status' => false, 'message' => 'Пароли не совпадают'];
        }

        // Проверка на существование пользователя. Модель запрашивает наличие пользователя с таким e-mail.
        // Если пользователь существует, возвращается соответствующая ошибка.
        if (!empty($user->getUserByEmail($_POST['reg_email']))) {
            return ['status' => false, 'message' => 'Такой пользователь уже существует'];
        }

        //Перевод всех символов e-mail к нижнему регистру (пользователи заполняют свои адреса разными буквами, а нам надо хранить их в одинаковом виде).
        $email = strtolower($_POST['reg_email']);
        // Функция sha1 создает строку-хеш от конкатенации почты и пароля. Чем запутаннее комбинация, от которой берется хеш, тем сложнее его подобрать.
        // Главное условие: хеш должен быть повторяем.
        $password = sha1($email . $_POST['reg_password']);

        // Регистрация пользователя в системе. Возвращает id пользователя.
        $userId = $user->register($email, $password);

        // userId вносится в сессию, организуя таким образом авторизацию.
        $_SESSION['user_id'] = $userId;

        // Возвращение положительного результата.
        return ['status' => true];
    }
}
?>