<?php

namespace api;

class NotfoundAction
{
    // Метод запуска экшна.
    public function run()
    {
        // Возвращает статус false и сообщение о том, что экшн не найден.
        return [
            // Статус ответа: true – все хорошо, false – произошла ошибка.
            'state' => false,
            // Сообщение, возвращаемое скриптом. В данном случае, что апи не найдено.
            'message'=>'404 Not found'
        ];
    }
}

?>