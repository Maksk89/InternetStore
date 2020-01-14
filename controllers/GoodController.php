<?php
// Для контроллеров указываем свое пространство имен.
namespace controllers;

// Указываем, что используем базовый класс контроллера.
use classes\BaseController;
use classes\App;
use classes\Tpl;
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

        // Переменная для формы модерации.
        $goodModerate = '';

        // Проверка, залогинен ли пользователь.
        if (App::$user->isLogin())
        {
            // Вывод имени товаров в строку.
            $moderateTpl = new Tpl();
            // Добавление переменных в шаблон.
            $moderateTpl->addVars([
                'baseUrl'   => App::$config->get('baseUrl'),
                'goods_id'  => $good[0]['goods_id']
            ]);
            // Отрисовка шаблона и складывание его в переменную.
            $goodModerate = $moderateTpl->render('goodModerate');
        }
        // Собираем данные для формы.
        $tplData = [ // Указываем базовый адрес для экшна формы.
            'baseUrl'   => App::$config->get('baseUrl'),
            'pic'       => $good[0]['pic'],
            'name'      => $good[0]['name'],
            'price'     => $good[0]['price'],
            'text'      => $good[0]['description'],
            'goods_id'  => $good[0]['goods_id'],
            'moderate'  => $goodModerate
        ];
        // Отрисовываем шаблон и выводим его на экран.
        echo $this->renderFull('goodInfo', $tplData);
    }
}
?>