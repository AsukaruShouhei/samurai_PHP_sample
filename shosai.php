<?php

	require_once 'functions/blog.php';
	$id = htmlspecialchars($_GET['id'], ENT_QUOTES, 'utf-8');
	$blog = blog::getMessageAll($id);

?>

<!DOCTYPE html>
<html>
<head>
	<title>記事詳細</title>
</head>
<body>
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
</body>
</html>