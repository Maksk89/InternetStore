<div class="lg-12">
    {#moderate}
</div>
<div class="lg-4">
    <div class="good-pic-info" style="background-image:url('{#baseUrl}{#pic}')"></div>
</div>
<div class="lg-8">
    <div class="good-info-info">
        <h3>{#name}</h3>
        <h4>{#price} руб.</h4>
        <pre>
{#text}
</pre>
        <script type="text/javascript">
            //добавляем кнопку
            document.write(VK.Share.button());
            </script>
        <div class="fb-share-button" data-href="" data-layout="button"></div>
        <script type="text/javascript">
            $(".fb-share-button").attr("data-href",window.location.pathname);
            </script>
        <p>
        <form name="addToBasketForm" id="addToBasketForm" action="{#baseUrl}api/addtobasket" method="post">
            <input id="goodsId" type="hidden" value="{#goods_id}"/>
            <input name="addToBasketButton" id="addToBasketButton" value="Добавить в корзину" type="button" />
        </form>
        </p>
    </div>
    <h3>Комментарии</h3>
    <div class="comment-add">
        <form action="{#baseUrl}api/addcomment" name="addCommentForm" id="addCommentForm" method="post">
            <p>Email<input type="text" id="cemail"/></p>
            <p>Text<input type="text" id="ctext"/></p>
            <p><input type="button" value="Добавить комментарий" id ="addCommentButton"/></p>
        </form>
    </div>
    <div class="lg-8" id="commentList"></div>
</div>

