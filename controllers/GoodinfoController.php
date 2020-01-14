<?php
// Для контроллеров указываем свое пространство имен.
namespace controllers;

// Указываем, что используем базовый класс контроллера.
use classes\BaseController;
use classes\App;
use models\GoodsModel;

// Объявляем класс контроллера как дочерний от базового контроллера.
class GoodController extends BaseController
{
    // Переопределенный метод run для отрисовки страницы
    public function run($data)
    {
        // Проверка, пришел ли id товара в vars.
        if (!isset($_GET['vars'])) {
            header('Location: ' . App::$config->get('baseUrl') . 'notfound', true);
            exit;
        }

        // Создание объекта модели товаров.
        $goods = new GoodsModel();

        // Запрос на получение данных из таблицы.
        $good = $goods->select([], [
            [
                'AND',
                '=',
                'goods_id',
                $_GET['vars']
            ]
        ],[]);

        // Проверка, существует ли такой товар.
        if (empty($good))
        {
            header('Location: ' . App::$config->get('baseUrl') . 'notfound', true);
            exit;
        }
        // Собираем данные для формы.
        $tplData = [ // Указываем базовый адрес для экшна формы.
            'baseUrl'   => App::$config->get('baseUrl'),
            'pic'       => $good[0]['pic'],
            'name'      => $good[0]['name'],
            'price'     => $good[0]['price'],
            'text'      => $good[0]['description'],
            'id'        => $good[0]['goods_id']
        ];
        // Отрисовываем шаблон и выводим его на экран.
        echo $this->renderFull('goodInfo', $tplData);
    }
}
?>