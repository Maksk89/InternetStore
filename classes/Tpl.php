<?php
namespace classes;

class Tpl
{
    // Список переменных для шаблона.
    protected $varList = [];

    // Добавление новой переменной для шаблона.
    public function addVar($id, $value)
    {
        // Добавление в массив varList новой переменной.
    $this->varList[$id] = $value;
}


    // Добавление списка переменных для шаблона.
    public function addVars($varList)
    {
        // Перебор всех переменных в массиве.
    foreach ($varList as $id => $value) {
        // Добавление переменной в varList.
        $this->addVar($id, $value);
    }
    }

    // Отрисовка шаблона.
    public function render($tplName)
{
    // Загрузка шаблона из файла, в качестве части пути используется получение базовой директории сайта.
    $result = file_get_contents(App::$config->get('basedir').'/views/'.'/tpl/' . $tplName . '.tpl');
    // Перебор всех переменных из varList.
    foreach ($this->varList as $id => $value) {
        // Замена с помощью функции str_replace ид на значение.
        $result = str_replace('{#' . $id . '}', $value, $result);
    }
    // Возвращение результата обработки.
    return $result;
}
}
?>
