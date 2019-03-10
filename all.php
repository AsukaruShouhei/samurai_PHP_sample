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
		<!-- 2019/03/10  検索機能の実装 -->
		<div class="search">
			<form class="form-inline" action="" method="POST">
				<div class="form-group mx-sm-3 mb-2">
					<label for="inputPassword2" class="sr-only">検索</label>
					<input type="text" class="form-control" id="search" placeholder="記事本文検索" name="search_word"> 
				</div>
				<button type="submit" class="btn btn-primary mb-2" name="searchBtn">検索</button>
			</form>
		</div>
		<div class="clear"></div>
		<hr>
		<?php
			if(!isset($_POST["searchBtn"])){
				// 検索ボタンを押されていないときの処理
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
			}
			else{
				$searchBlog = $blog->searchBlog($_POST["search_word"]);
				if (!empty($searchBlog)) {
					echo "<h4> 「".$_POST['search_word']."」での検索結果：</h4>";
					foreach ($searchBlog as $value) {
						?>
						<!-- 2019/03/08 詳細ページへのリンクを貼る -->
						<a href="shosai.php?id=<?php echo $value['id'] ;?>"><?php echo $value["title"]; ?></a><br>
						<?php
						}
				}else{
					echo "検索条件に合致するブログ記事はありませんでした。";
				}
			}
		?>
		</div>

<?php include_once 'footer.php'; ?>