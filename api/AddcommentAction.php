<?php
namespace api;

use classes\App;
use models\CommentModel;

class AddcommentAction
{
    // Метод запуска экшна.
    public function run()
    {
        // Добавьте проверку переменных.

        // Создание модели пользователя.
        $comment = new CommentModel();

        // Добавление нового комментария.
        $comment->insert([
            'goods_id'  => $_POST['goods_id'],
            'email'     => $_POST['email'],
            'text'      => $_POST['text'],
            'created'    => time()
        ]);

        // Возвращение положительного результата.
        return ['status' => true];
    }
}
?>