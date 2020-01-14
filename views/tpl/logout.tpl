

<div class="lg-12">
    <form name="addGoodForm" id="addGoodForm" action="{#baseUrl}/goocreate" method="post">
        <input id="goodsId" type="hidden" value="{#goods_id}"/>
        <input name="addGoodButton" id="addGoodButton" value="Добавить товар" type="button" onclick="location.href='{#baseUrl}/goodcreate'" />
    </form>
    <form name="logoutForm" id="logoutForm" action="{#baseUrl}api/logout" method="post">
        <p>Добро пожаловать, {#user}</p>
        <p><input value="Выйти" id="logoutButton" type="button"></p>
    </form>
</div>