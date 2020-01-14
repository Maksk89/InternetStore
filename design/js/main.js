// Эта функция вызывается сразу после того, как вся страница будет загружена, это делается для того,
// чтобы скрипт не срабатывал на незаконченной странице, так как там могут быть загружены не все элементы
$(document).ready(function(){
    // Вызов обновления корзины.
    refreshBasket();
    refreshComment();

    // Устанавливаем обработчик событий на клик любого div`а с классом "logo".
    $(".logo").click(function(){
        // Выводим сообщение.
        alert("Привет всем!");
    })

    // Обрабатываем клик на картинку.
    $(".good-pic-info").click(function(){
        // Открываем div с картинкой в модальном режиме.
        $(this).modal({opacity:80,overlayCss: {backgroundColor:"#000"}});
    })

    // Обрабатываем клик на кнопку входа.
    $("#loginButton").click(function(){
        $.post(
            // URL запроса берется из поля action формы.
            $("#loginForm").attr("action"),
            {
                // Перечисляем post переменные.
                email:$("#email").val(), // С помощью метода val() получаем значение input по селектору.
                password:$("#password").val()
            },
            function(data)
            {
                // Если статус пришел false, то авторизация не удалась.
                if (data.status==false)
                {
                    // Выводим ошибку авторизации в виде сообщения.
                    alert(data.message);
                    return;
                }
                else
                {
                    // Если авторизация удалась, перезагружаем окно.
                    window.location=window.location;
                }
            },
            "json"
        );
    })

    // Обрабатываем клик на кнопку выхода.
    $("#logoutButton").click(function(){
        $.post(
            // URL запроса берется из поля action формы.
            $("#logoutForm").attr("action"),
            {
                // С помощью метода val() получаем значение input по селектору.
                user_id:$("#userId").val()
            },
            function(data)
            {
                // Если статус пришел false, то авторизация не удалась.
                if (data.status==false)
                {
                    // Выводим ошибку авторизации в виде сообщения.
                    alert(data.message);
                    return;
                }
                else
                {
                    // Если авторизация удалась, перезагружаем окно.
                    window.location=window.location;
                }
            },
            "json"
        );
    })

    // Обрабатываем клик на кнопку регистрации.
    $("#registerButton").click(function(){
        $.post(
            // URL запроса берется из поля action формы.
            $("#registerForm").attr("action"),
            {
                // Перечисляем post переменные.
                reg_email:$("#reg_email").val(), // С помощью метода val() получаем значение input по селектору.
                reg_password:$("#reg_password").val(),
                reg_password_repeat:$("#reg_password_repeat").val()
            },
            function(data)
            {
                // Если статус пришел false, то авторизация не удалась.
                if (data.status==false)
                {
                    // Выводим ошибку регистрации в виде сообщения.
                    alert(data.message);
                    return;
                }
                else
                {
                    // Если авторизация удалась, перезагружаем окно.
                    alert(data.message);
                    window.location=window.location;
                }
            },
            "json"
        );
    })

    // Обрабатываем клик на кнопку удаления товара.
    $("#deleteGoodButton").click(function(){
        $.post(
            // URL запроса берется из поля action формы.
            $("#deleteGoodForm").attr("action"),
            {
                // С помощью метода val() получаем значение input по селектору.
                goods_id:$("#deleteGoodId").val()
            },
            function(data)
            {
                if (data.status==false)
                {
                    alert(data.message);
                    return;
                }
                else
                {
                    alert(data.message);
                }
            },
            "json"
        );
    })



    // Обрабатываем клик на кнопку добавления в корзину.
    $("#addToBasketButton").click(function(){
        $.post(
            // URL запроса берется из поля action формы.
            $("#addToBasketForm").attr("action"),
            {
                // С помощью метода val() получаем значение input по селектору.
                goods_id:$("#goodsId").val()
            },
            function(data)
            {
                if (data.status==false)
                {
                    alert(data.message);
                    return;
                }
                else
                {
                    alert(data.message);
                    // Вызов обновления корзины.
                    refreshBasket();
                }
            },
            "json"
        );
    })

    // Обрабатываем клик на кнопку добавления комментария.
    $("#addCommentButton").click(function(){
        $.post(
            // URL запроса берется из поля action формы.
            $("#addCommentForm").attr("action"),
            {
                // С помощью метода val() получаем значение input по селектору.
                goods_id:$("#goodsId").val(),
                email: $("#cemail").val(),
                text: $("#ctext").val()
            },
            function(data)
            {
                if (data.status==false)
                {
                    return;
                }
                else
                {
                    // Вызов обновления комментариев.
                    refreshComment();
                }
            },
            "json"
        );
    })




    // Функция обновления комментариев.
    function refreshComment()
    {
        $.post(
            $('#baseUrl').val()+"api/refreshcomment/",
            {
                goods_id:$("#goodsId").val()
            },
            function(data)
            {
                if (data.status==false)
                {
                    return;
                }
                else
                {
                    // Очищаем div с комментариями.
                    $("#commentList").empty();
                    // Добавляем в него новые данные.
                    $("#commentList").append(data.commentList);
                }
            },
            "json"
        );
    }

    // Функция обновления корзины.
    function refreshBasket()
    {
        $.post(
            "адрес сайта/api/refreshbasket/",
            {
            },
            function(data)
            {
                if (data.status==false)
                {
                    alert(data.message);
                    return;
                }
                else
                {
                    // Очищаем div с корзиной.
                    $("#basket").empty();
                    // Добавляем в него новые данные.
                    $("#basket").append(data.basket);
                }
            },
            "json"
        );
    }
})