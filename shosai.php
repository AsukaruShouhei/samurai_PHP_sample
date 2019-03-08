<?php

	require_once 'functions/blog.php';
	$id = htmlspecialchars($_GET['id'], ENT_QUOTES, 'utf-8');
	$blog = blog::getMessageAll($id);

?>

<!DOCTYPE html>
<html>
<head>
	<!--  BootStrap 使用 -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<title>記事詳細</title>
	<link rel="stylesheet" href="css/main.css">
</head>
<body>
	<div id="sideBar">
		<ul>
			<li><a href="">投稿一覧</a></li>
			<li><a href="">カテゴリ設定</a></li>
			<li><a href=""></a></li>
			<li><a href=""></a></li>
		</ul>
	</div><!-- // sideBar -->
	
	<div id="main">
		<a href="index.php">TOP</a>
		<div>
			記事を書いた人  <?php echo $blog["user_id"];?><br>
			投稿日 <?php echo $blog["created_at"] ;?>
		</div>
		<div>
			<h2><?php echo $blog["title"] ;?></h2>
		</div>
		<div>
			<?php echo $blog["message"] ;?>
		</div>
	</div><!-- // main -->
</body>
</html>