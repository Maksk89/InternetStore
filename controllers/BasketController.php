<?php
// Для контроллеров указываем свое пространство имен.
namespace controllers;

// Указываем, что используем базовый класс контроллера.
use classes\BaseController;
use classes\App;
use classes\Tpl;
use models\BasketModel;

// Объявляем класс контроллера как дочерний от базового контроллера.
class BasketController extends BaseController
{
    // Переопределенный метод run для отрисовки страницы
    public function run($data)
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
            $out .= $tpl->render('basket');
        }
        // Собираем данные для формы.
        $tplData = [ // Указываем базовый адрес для экшна формы.
            'baseUrl'   => App::$config->get('baseUrl'),
            'pic'       => $basketItem['pic'],
            'name'      => $basketItem['name'],
            'price'     => $basketItem['count'] * $basketItem['price'],
            'count'     => $basketItem['count']
        ];
        // Отрисовываем шаблон и выводим его на экран.
        echo $this->renderFull('basket', $tplData);
    }
}
?>