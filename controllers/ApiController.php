<?php
// Для контроллеров указываем свое пространство имен.
namespace controllers;

// Указываем, что используем базовый класс контроллера.
use classes\BaseController;

// Объявляем класс контроллера как дочерний от базового контроллера.
class ApiController extends BaseController
{
    // Переопределенный метод run для отрисовки страницы
    public function run($data)
    {
        // Установка экшна по умолчанию.
        $action = 'notfound';
        // Если в дате есть переменная vars.
        if (isset($data['vars'])) {
            // Установка в $vars имени экшна.
            $action = $data['vars'];
        }
        // С помощью функции mb_convert_case изменяется имя переменной в формат первая буква – заглавная, остальные строчные.
        // Добавляется в конец переменной слово Action. Таким образом переменная vars преобразуется в имя экшна.
        $actionClass = mb_convert_case($action, MB_CASE_TITLE, "UTF-8") . 'Action';
        // Проверка на существование файла экшна с помощью функции file_exists.
        if (!file_exists('api/' . $actionClass . '.php')) {
            // Если экшн не существует, устанавливаем имя экшна NotfoundAction.
            $actionClass = 'NotfoundAction';
        }
        // Подключение файла экшна.
        require_once 'api/' . $actionClass . '.php';
        // Формирование имени класса экшна с учетом пространства имен.
        $actionClass = 'api\\' . $actionClass;
        // Создание экземпляра экшна.
        $actionObject = new $actionClass();
        // Запуск экшна и вывод результата в формате json.
        echo json_encode($actionObject->run(), JSON_UNESCAPED_UNICODE);
    }
}
?>