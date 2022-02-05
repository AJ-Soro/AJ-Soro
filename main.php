<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>main</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<?php include "assets/header.html"; ?>
		<!--
		<form method="post">
			<input type="text" name="name" placeholder="Name:">
			<input type="text" name="age" placeholder="Age:">
			<button>Send</button>
		</form>
		-->
	<div class="wrap">
		<?php
			$countPost_onPage = 4;

			$conn = mysqli_connect('127.0.0.1', 'mysql', '', 'mdk', '3307');

			$page = empty($_GET['page']) ? 1 : $_GET['page'];

			$page = $page * $countPost_onPage - $countPost_onPage;

			$posts_list = mysqli_query($conn, "SELECT * FROM `posts` LIMIT $page,$countPost_onPage");

			if(!$posts_list) echo "ERROR";
				else{
					while($post = mysqli_fetch_array($posts_list)){
						echo "<div class = 'card'>", 
						"<div class = 'card_title'>".$post["name"],"</div>", 
						"<div class = 'card_text'>".$post["text"], "</div>", 
						"<img src='".$post["img"]."'width = '300'>",
						"</div>";
					}
				}
		?>
	</div>
	<div class="pagination">
		<?php
			$count_posts = mysqli_fetch_array(mysqli_query($conn, "SELECT count(*) FROM posts"));
			$count_posts = ceil($count_posts[0]/$countPost_onPage);

			for($i = 1; $i <= $count_posts; $i++){
				echo "<li><a href='?page=$i'>$i</a></li>";
			}
		?>
	</div>
</body>
</html>