<?php
namespace api;

use classes\App;
use classes\Tpl;
use models\BasketModel;

class RefreshbasketAction
{
    // Метод запуска экшна.
    public function run()
    {
        // Инициализация модели товаров.
        $basket = new BasketModel();

        // Получение списка товаров в корзине.
        $basketList = $basket->getBasket(session_id());

        // Строка для хранения страницы со списком товаров.
        $out = '';

        // Перебор всех товаров в корзине.
        foreach ($basketList as $basketItem) {
            // Инициализация шаблона.
            $tpl = new Tpl();

            // Заполнение шаблона данными.
            $tpl->addVars([
                'baseUrl'   => App::$config->get('baseUrl'),
                'pic'       => $basketItem['pic'],
                'name'      => $basketItem['name'],
                'price'     => $basketItem['count'] * $basketItem['price'],
                'count'     => $basketItem['count']
            ]);

            // Отрисовка шаблона.
            $out .= $tpl->render('goodSmall');
        }

        return ['status' => true, 'basket' => $out];
    }
}
?>