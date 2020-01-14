<?php
namespace api;

use classes\App;
use models\GoodsModel;

class GooddeleteAction
{
    // Метод запуска экшна.
    public function run()
    {
        // Проверка на то, что пользователь залогинен.
        if (!App::$user->isLogin()) {
            // Если он не залогинен, то удаление не возможно.
            return ['state' => false, 'message' => 'Для удаления товара требуется авторизация.', ];
        }
        // Задание: добавьте проверку переменной с id товара.

        // Инициализация модели товаров.
        $good = new GoodsModel();

        // Удаление товара по его id.
        $good->delete([
            [
                'AND',
                '=',
                'goods_id',
                $_POST['goods_id']
            ]
        ]);

        return [
            'status' => true,
            'message' => 'Товар удален'
        ];
    }
}
?>