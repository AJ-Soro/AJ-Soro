<?php 
    include "assets/header.html";
    
    $conn = mysqli_connect('127.0.0.1', 'mysql', '', 'mdk', '3307');
    $posts_list = mysqli_query($conn, "SELECT * FROM posts");

    $post_id = empty($_GET['post'])?1:$_GET['post'];
    $post_info = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM posts WHERE `id` = '$post_id'"));
?>
<link rel="stylesheet" type="text/css" href="css/main.css">
<div class="container editContainer">
    <nav class="post-list">
        <?php
            while($post = mysqli_fetch_array($posts_list)){
                echo "<li class='card-item'>","<a class = 'card-title' href='?post=".$post["id"]."'>".$post["name"]."</a>","</li>";
            }
        ?>
    </nav>
    <div class="post-info">
        <h2>Редактирование поста</h2>
        <form method="post" enctype="multipart/form-data">
            <div class="input-group">
                <img src="<?php echo $post_info['img'];?> " alt="" width="100">
            </div>
            <div class="input-group">
                <label for="title_post">Введите заголовок поста</label>
                <input type="text" name="title_post" value="<?php echo $post_info['name'];?>">
            </div>
            <div class="input-group">
                <label for="text_post">Введите текст поста</label>
                <textarea name="text_post"  id="text_post" cols="30" rows="10"><?php echo $post_info['text'];?></textarea>
            </div>
            <div class="input-group">
                <label for="img_post">Выберите изображение поста</label>
                <input type="file" id="img_post" name="img_post">
            </div>
            <div class="input-group">
                <button class="btn" type="submit">Добавить</button>
            </div>
        </form>
    </div>
</div>

<?php
    $title = empty($_POST['title_post'])?false:$_POST['title_post'];
    $text = empty($_POST['text_post'])?false:$_POST['text_post'];
    $tmp = empty($_FILES['img_post']['tmp_name'])?false:$_FILES['img_post']['tmp_name'];
    echo $tmp;
    
    if($title and $text){

        if($title!=$post_info['name']){
            mysqli_query($conn, "UPDATE posts SET `name`='$title' WHERE `id`=".$post_info['id']);
            echo "UPDATE posts SET `name`='$title' WHERE `id`=".$post_info['id'];
        }
        
        if($title!=$post_info['text']){
            mysqli_query($conn, "UPDATE posts SET `text`='$text' WHERE `id`=".$post_info['id']);
        }
    }
    if($tmp){
        $image = $_FILES['img_post']['name'];
        $image = str_replace(' ', '|', $image);
        $image = "img/".$image;

        $result = mysqli_query($conn, "UPDATE posts SET `img`='$image' WHERE `id`=".$post_info['id']);
        echo "UPDATE posts SET `img`='$image' WHERE `id`=".$post_info['id'];

        if($result){
            move_uploaded_file($_FILES['img']['tmp_name'],$image);
        }
    }
?>