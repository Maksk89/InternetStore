<?php
namespace models;

use classes\App;
use classes\BaseModel;

class BasketModel extends BaseModel
{
    // Имя таблицы.
    public $tableName = 'basket';

    // Метод возвращает корзину пользователя.
    public function getBasket($sid)
    {
        return App::$db->query('SELECT * FROM `basket`' .
            ' INNER JOIN `session` ON `session`.`session_id`=`basket`.`session_id`' .
            ' INNER JOIN `goods` ON `goods`.`goods_id`=`basket`.`goods_id`' .
            '  WHERE `session`.`sid`=?', array($sid));
    }
}

?>