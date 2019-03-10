<?php
	session_start();
	require_once "functions/blog.php";
	require_once "functions/Security.php";
	$blog = new blog();

	// 2019/03/08　　header.php 読み込み
	include_once 'header.php';
?>

<?php include_once 'sideBar.php'; ?>

	<div id="main">
		<h3>記事一覧</h3>
		<a href="index.php"><span class="glyphicon glyphicon-home"></span>TOP</a>
		<div>
		<?php
			$getBlog = $blog->getMessageAll();
			if (!empty($getBlog)) {
				foreach ($getBlog as $key => $value) {
					?>
					<!-- 2019/03/08 詳細ページへのリンクを貼る -->
					<a href="shosai.php?id=<?php echo $value['id']; ?>"><?php echo $value["title"]; ?></a><br>
					<?php
				}
			}else{
				echo "まだ記事がありません。";
			}
		?>
		</div>

<?php include_once 'footer.php'; ?>