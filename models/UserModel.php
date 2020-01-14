<?php
namespace models;

use classes\BaseModel;

class UserModel extends BaseModel
{
    // Имя таблицы.
    public $tableName = 'user';

    // Метод возвращает пользователя по его id.
    public function getUserById($userId)
    {
        return $this->select(
        // Выборка всех полей.
            [],
            [
                // Выборка пользователя с определенным id.
                [
                    'AND',
                    '=',
                    'user_id',
                    $userId
                ],

            ],
            []);
    }

    // Метод возвращает пользователя по его e-mail.
    public function getUserByEmail($email)
    {
        return $this->select(
        // Выборка всех полей.
            [],
            [
                // Выборка пользователя с определенным id.
                [
                    'AND',
                    '=',
                    'email',
                    $email
                ],

            ],
            []);
    }

    // Метод создает новую запись пользователя.
    public function register($email, $password)
    {
        return $this->insert(
            [
                'email'     => $email,
                'password'  => $password
            ]
        );
    }
    // Метод возвращает пользователя по его e-mail и password.
    public function getUserByEmailAndPassword($email, $password)
    {
        return $this->select(
        // Выборка всех полей.
            [],
            [
                // Выборка пользователя с определенным id.
                [
                    'AND',
                    '=',
                    'email',
                    $email
                ],
                [
                    'AND',
                    '=',
                    'password',
                    $password
                ],

            ],
            []);
    }
}
?>