<?php

// Инициализация моделей.
$good = new GoodsModel();
$session = new SessionModel();
$basket = new BasketModel();

// Получение сессии пользователя.
$userSession = $session->select([],[
    [
        'AND',
        '=',
        'sid',
        // Метод возвращает идентификатор сессии пользователя.
        session_id()
    ]
],[]);

// Если сессия пользователя отсутствует.
if (empty($userSession))
{
    return [
        'status'    => false,
        'message'   => 'Сессии не существует'
    ];
}

// Получение товара в корзине пользователя.
$userBasket = $basket->select([],[
    [
        'AND',
        '=',
        'session_id',
        $userSession[0]['session_id']
    ],
    [
        'AND',
        '=',
        'goods_id',
        $_POST['goods_id']
    ]
],[]);

// Если товар отсутствует.
if (empty($userBasket))
{
    // Внесение товара в корзину.
    $basket->insert([
        'session_id'    => $userSession[0]['session_id'],
        'goods_id'      => $_POST['goods_id'],
        'count'         => 1
    ]);
} else {
    // Обновление товара в корзине, инкремент количества товара.
    $basket->update([
        'count' => $userBasket[0]['count']+1,
    ],[
        [
            'AND',
            '=',
            'session_id',
            $userSession[0]['session_id']
        ],
        [
            'AND',
            '=',
            'goods_id',
            $_POST['goods_id']
        ]
    ]);
}

return [
    'status' => true,
    'message' => 'Товар добавлен в корзину'
];
}
}
?>