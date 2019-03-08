<?php

	require_once 'functions/blog.php';
	$id = htmlspecialchars($_GET['id'], ENT_QUOTES, 'utf-8');
	$blog = blog::getMessageAll($id);

	// 2019/03/08　　header.php 読み込み
	include_once 'header.php';
?>

<?php include_once 'sideBar.php'; ?>

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