<?php
namespace api;

use classes\App;
use classes\Tpl;
use models\CommentModel;

class RefreshcommentAction
{
    // Метод запуска экшна.
    public function run()
    {
        // Добавьте проверку переменных.

        // Создание модели пользователя.
        $comment = new CommentModel();

        // Получение списка комментариев.
        $commentList = $comment->select([],[
            [
                'AND',
                '=',
                'goods_id',
                $_POST['goods_id']
            ]
        ],['created']);

        // Переменная для хранения комментариев.
        $out = '';

        // Перебор всех комментариев в цикле
        foreach ($commentList as $commentItem)
        {
            // Наполнение шаблона данными.
            $tpl = new Tpl();
            $tpl->addVars([
                'email' => $commentItem['email'],
                'text'  => $commentItem['text'],
                'date'  =>$commentItem['created'],// date('Y-m-d H:i:s',$commentItem['created']),
            ]);

            // Отрисовка комментариев в выходную переменную.
            $out .= $tpl->render('comment');
        }

        // Возвращение положительного результата.
        return [
            'status' => true,
            'commentList' => $out
        ];
    }
}
?>