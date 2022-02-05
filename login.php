<?php include "assets/header.html"; ?>

<div class="login_contain">
        <h1>Вход</h1>
        <form action="" method="POST">
            <input type="text" class="reg_input" placeholder="Введите логин" name="login">
            <input type="text" class="reg_input" placeholder="Введите пароль" name="pass"> 
            <button class="send_reg" type="submit">Войти</button>
        </form>
</div>

<?php 
    $login = $_POST['login'];
    $pass = $_POST['pass'];

    $conn = mysqli_connect('127.0.0.1', 'mysql', '', 'mdk', '3307');

    $result = $conn->query("SELECT * FROM `users` WHERE `login` = '$login' AND `pass` = '$pass'");

    $user = $result->fetch_assoc(); //функция конвертирует полученные данные из БД в массив 

    if($user == 0){
        echo "Такой пользователь не найден";
        exit();
    }
    else echo "Привет ".$login;

    

    $conn->close();
?>
