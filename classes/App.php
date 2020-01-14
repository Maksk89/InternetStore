<?php
// Пространство имен
namespace classes;

// Создание класса App.
class App
{
    // Статичное свойство, содержащее конфигурацию.
    public static $config;
    // Статичное свойство, содержащее подключение к базе данных.
    public static $db;
    // Статичное свойство, содержащее роутер.
    public static $router;
    // Статичное свойство, содержащее пользователя.
    public static $user;

    //Статичный метод.
    public static function init()
    {
        // Инициализация сессии пользователя.
        session_start();

        // Инициализация конфигурации.
        self::$config = new Config();

        // Инициализация базы данных.
        self::$db = new Db();
        self::$db->connect(self::$config->get('database'));

        // Инициализация роутера.
        self::$router = new Router();

        // Инициализация пользователя.
        self::$user =  new User();
    }

    // Запуск приложения.
    public static function run()
    {
        self::$router->getController($_GET);
        // Получение контроллера в зависимости от гет-переменной.
        $controller = self::$router->getController($_GET);
        // Запускаем работу контроллера.
        $controller->run($_GET);
    }
}
?>