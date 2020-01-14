<form action="{#baseUrl}api/goodcreate" method="post" enctype="multipart/form-data">
    <p>Название  <input name="name" value="Название" type="text"></p>
    <p>Описание <textarea name="description" cols="20" rows="20" wrap="virtual">Описание</textarea></p>
    <p>Цена  <input name="price" value="0.0" type="text"></p>
    <p>Изображение  <input name="myfile" type="file"></p>
    <p><input value="Создать" type="submit"></p>
</form>