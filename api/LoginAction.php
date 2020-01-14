<?php
namespace api;

use classes\App;
use models\UserModel;

class LoginAction
{
    // Метод запуска экшна.
    public function run()
    {
        // Создание модели пользователя.
        $user = new UserModel();

        // Проверка на то, что все нужные данные пришли с формы в $_POST.
        if ((empty($_POST['email'])) || (empty($_POST['password']))) {
            return ['status' => false, 'message' => 'Заполните все поля'];
        }

        //Перевод всех символов e-mail к нижнему регистру (пользователи заполняют свои адреса разными буквами, а нам надо хранить их в одинаковом виде).
        $email = strtolower($_POST['email']);
        // Функция sha1 создает строку-хеш от конкатенации почты и пароля. Чем запутаннее комбинация, от которой берется хеш, тем сложнее его подобрать.
        // Главное условие: хеш должен быть повторяем.
        $password = sha1($email . $_POST['password']);

        // Получение пользователя по его e-mail и хешу пароля.
        $userData = $user->getUserByEmailAndPassword($email ,$password);

        // Проверка на существование пользователя. Модель запрашивает наличие пользователя с таким e-mail и паролем.
        // Если пользователь не существует – возвращается соответствующая ошибка.
        if (empty($userData)) {
            return ['status' => false, 'message' => 'Введены неверные данные'];
        }

        // user_id вносится в сессию, организуя таким образом авторизацию.
        $_SESSION['user_id'] = $userData[0]['user_id'];

        // Возвращение положительного результата.
        return ['status' => true];
    }
}
?>