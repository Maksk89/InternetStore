<?php
class Product {
// переменные (свойства):
public $goods_ver2 = array (
"Тако" => array ("Цена" => 300, "Тип"  => "Мексиканская кухня"),
"Пицца" => array ("Цена" => 400, "Тип"  => "Итальянская кухня"),
"Суши" => array ("Цена" => 450, "Тип"  => "Японская кухня")); //Двухмерный массив, заданный по-другому

public $goods = [ [ name => "Пицца",
    price => 400,
    type => "Итальянская кухня"
],
    [ name => "Суши",
        price => 450,
        "type" => "Японская кухня",
    ],
    [ name => "Тако",
        price => 300,
        type => "Мексиканская кухня"
    ]
];

// конструктор
    function __construct($name_) {

    }



public function output()
{
    foreach ($goods_ver2 as $name => $item) {
        echo "<br>$Название:<br>";
        foreach ($item as $parameter => $pp) {
            echo "$parameter = $pp<br>";
        }
    }
}


    public function add($name,$type, $price)
    {

    }
}
?>