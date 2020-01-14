<?php
// Для контроллеров указываем свое пространство имен.
namespace controllers;

// Указываем, что используем базовый класс контроллера.
use classes\BaseController;
use classes\App;

// Объявляем класс контроллера как дочерний от базового контроллера.
class GoodcreateController extends BaseController
{
    // Переопределенный метод run для отрисовки страницы
    public function run($data)
    {
        // Проверка на то, что пользователь залогинен.
        if (!App::$user->isLogin()) {
            // Если он уже залогинен, то регистрация невозвожна. Возвращается сообщение об этом.
            header( 'Location: '.App::$config->get('baseUrl') , true);
            exit;
        }
        // Собираем данные для формы.
        $tplData = [
            // Указываем базовый адрес для экшна формы.
            'baseUrl'=>App::$config->get('baseUrl')
        ];
        // Отрисовываем шаблон goodCreate и выводим его на экран.
        echo $this->renderFull('goodCreate', $tplData);
    }
}
?>