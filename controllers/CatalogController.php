<?php
// Для контроллеров указываем свое пространство имен.
namespace controllers;

// Указываем, что используем базовый класс контроллера.
use classes\BaseController;
// Указываем, что используем класс шаблона.
use classes\Tpl;
use classes\App;
use models\GoodsModel;

// Объявляем класс контроллера как дочерний от базового контроллера.
class CatalogController extends BaseController
{
    // Переопределенный метод run для отрисовки страницы.
    public function run($data)
    {
        // Создание объекта модели товаров.
        $goods = new GoodsModel();

        // Массив для передачи поля сортировки.
        $orderBy = [];

        // Если пришла переменная vars.
        if (!empty($_GET['vars']))
        {
            // В массив для сортировки добавляется поле из vars.
            $orderBy[] = $_GET['vars'];
        }

        // Запрос на получение данных из таблицы.
        $goodList = $goods->select([], [], $orderBy);
        // Обнуление строки для результата.
        $goodString = '';
        // Проход циклом по всем товарам из запроса.
        foreach ($goodList as $goodItem) {
            // Вывод имени товаров в строку.
            $good = new Tpl();
            // Добавление переменных в шаблон.
            $good->addVars([
                'baseUrl'   => App::$config->get('baseUrl'),
                'pic'       => $goodItem['pic'],
                'name'      => $goodItem['name'],
                'price'     => $goodItem['price'],
                'text'      => $goodItem['description'],
                'id'        => $goodItem['goods_id']
            ]);
            // Отрисовка шаблона и складывание его в переменную goodList.
            $goodString .= $good->render('good');
        }
        // Отрисовка шаблона catalog и вывод его на экран.
        echo $this->renderFull('catalog', [
            'goodList' => $goodString,
            'baseUrl'  => App::$config->get('baseUrl'),
        ]);
    }
}
?>