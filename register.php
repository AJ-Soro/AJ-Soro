<?php include "assets/header.html"; ?>

<div class="reg_contain">
        <h1>Регистрация</h1>
        <form action="" method="POST">
            <input type="text" class="reg_input" placeholder="Введите Имя" name="name">
            <input type="text" class="reg_input" placeholder="Введите Фамилию" name="lastName">
            <input type="text" class="reg_input" placeholder="Введите логин" name="login">
            <input type="text" class="reg_input" placeholder="Введите пароль" name="pass"> 
            <button class="send_reg" type="submit">Зарегистрировать</button>
        </form>
</div>

<?php
    $name = $_POST['name'];
    $last_name = $_POST['lastName'];
    $login = $_POST['login'];
    $pass = $_POST['pass'];

    $conn = mysqli_connect('127.0.0.1', 'mysql', '', 'mdk', '3307');

    $conn->query("INSERT INTO users (`name`, `lastName`, `login`, `pass`) VALUES ('$name','$last_name','$login', '$pass')");

    $conn->close();
?>