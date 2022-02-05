<?php include "assets/header.html"; ?>

<div class="container">
    <h2>
        Добавление поста
    </h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="input-group">
            <label for="name">Введите заголовок</label>
            <input type="text" name="name">
        </div>
        <div class="input-group">
            <label for="text">Введите текст поста</label>
            <textarea name="text" id="" cols="30" rows="10"></textarea>
        </div>
        <div class="input-group">
            <label for="img">Выберите изображение поста</label>
            <input type="file" name="img">
        </div>
        <div class="input-group">
            <button class="btn" type="submit">Добавить</button>
        </div>
    </form>
</div>
<?php
    $conn = mysqli_connect('127.0.0.1', 'mysql', '', 'mdk', '3307');

    if($_FILES['img']['tmp_name'] and $_POST["name"] and $_POST["text"]){
        $image = $_FILES['img']['name'];
        $image = str_replace(' ', '|', $image);
        $image = "img/".$image;

        $name_post  = $_POST["name"];
        $text_post  = $_POST["text"];

        $result = mysqli_query($conn, "INSERT INTO posts (`id`, `name`, `text`, `img`) VALUES (null, '$name_post','$text_post','$image')");

        if($result){
            move_uploaded_file($_FILES['img']['tmp_name'], $image);
        }
    }
?>