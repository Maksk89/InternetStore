<?php
// Для контроллеров указываем свое пространство имен.
namespace controllers;

// Указываем, что используем базовый класс контроллера.
use classes\BaseController;
use classes\App;

// Объявляем класс контроллера как дочерний от базового контроллера.
class RegisterController extends BaseController
{
    // Переопределенный метод run для отрисовки страницы
    public function run($data)
    {
        // Собираем данные для формы.
        $tplData = [
            // Указываем базовый адрес для экшина формы из конфига.
            'baseUrl'=>App::$config->get('baseUrl')
        ];
        // Отрисовываем шаблон register и выводим его на экран.
        echo $this->renderFull('register', $tplData);
    }
}
?>