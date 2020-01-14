<?php
namespace classes;

class BaseController
{
    // Метод запускает работу контроллера.
    public function run($data)
    {

    }

    // Метод отрисовывает страницу полностью.
    protected function renderFull($tplName, $data)
    {
        // Отрисовка head.
        $out = $this->render('head', [
            'css' => App::$config->get('css'),
            'js' => App::$config->get('js'),
            'name' => App::$config->get('name'),
        ]);
        // Отрисовка меню.
        $out .= $this->render('menu', ['baseUrl'=> App::$config->get('baseUrl')]);
    // Отрисовка дополнительной панели.
        $out .= $this->render('additional', [
            // Отрисовка формы входа или выхода.
            'userForm' => $this->renderLogin(),
        ]);
        //Отрисовка пробного контента
       $out .= $this->render('testcontent', []);
        // Отрисовка контента.
        $out .= $this->render($tplName, $data);
        // Отрисовка футера.
        $out .= $this->render('footer', []);
        // Возвращение результата.
        return $out;
    }

    // Метод отрисовывает один шаблон.
    protected function render($tplName, $data)
    {
        // Создание объекта шаблона.
        $out = new Tpl();
        // Заполнение шаблона данными.
        $out->addVars($data);
        // Отрисовка и возвращение шаблона.
        return $out->render($tplName);
    }
// Метод возвращает форму пользователя.
    protected function renderLogin()
    {
        // Если пользователь не залогинен.
        if (!App::$user->isLogin()) {
            // Вывод формы логина.
            return $this->render('login', [
                // Указываем базовый адрес для экшина формы.
                'baseUrl' => App::$config->get('baseUrl')
            ]);
        } else {
            // Вывод формы выхода.
            return $this->render('logout', [
                // Указываем базовый адрес для экшина формы.
                'baseUrl' => App::$config->get('baseUrl'),
                // Указываем e-mail пользователя.
                'user'    => App::$user->getCurrentUser()['email']
            ]);
        }
    }
}
?>