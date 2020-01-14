<?php
namespace api;

use classes\App;
use models\GoodsModel;

class GoodcreateAction
{
    // Метод запуска экшна.
    public function run()
    {
        // Задание: добавьте проверку переменных.

        // Инициализация переменной под файл.
        $uploadFile = "";

        // Создание имени файла для хранения на сервере.
        $tmp = 'uploads/' . time() . ".jpg";

        // Если файл был загружен, его имя заносится в переменную.
        if (move_uploaded_file($_FILES['myfile']['tmp_name'], $tmp)) {
            $uploadFile = $tmp;
        }

        // Инициализация модели товаров.
        $good = new GoodsModel();

        // Инсерт товара в базу данных.
        $good->insert([
            'name'          => $_POST['name'],
            'price'         => $_POST['price'],
            'description'   => $_POST['description'],
            'created'        => time(),
            'pic'           => $uploadFile
        ]);
        return [
            'status' => true,
            'message' => 'Товар добавлен'
        ];
    }
}
?>