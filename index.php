<?php
	session_start();
	require_once "functions/blog.php";
	require_once "functions/Security.php";
	// csrf_token 発行
	$token = Security::makeCsrf();
	$_SESSION['csrf_token'] = $token;
	$blog = new blog();

	// 2019/03/08　　header.php 読み込み
	include_once 'header.php';
?>

<?php include_once 'sideBar.php'; ?>

	<div id="main">
							<!-- 2019/03/08 Limit区を使った取得制限 追加 -->
		<h3>
			新着記事
		</h3>
		<div>
			<?php
				$getLimitBlog = $blog->getMessageLimit(5);
				if (!empty($getLimitBlog)) {
					foreach ($getLimitBlog as $key => $value) {
						// 記事の投稿日時と現座の時刻を比較いて、投稿日時が現在時刻の過去１日以内であればバッジを表示
							// 現在時刻から1日前の時刻を取得 http://php.net/manual/ja/function.date.php
							$oneWeekBefore = date("Y-m-d H:i:s", strtotime("-1 day"));
						if( $value["created_at"] >= $oneWeekBefore){
							echo "<span class='badge badge-warning'>新着記事</span>";
						}
			?>
					<a href="shosai.php?id=<?php echo $value['id']; ?>"><span style="font-size: 8px;">更新日時：< <?php echo $value['created_at']; ?> ></span>  <?php echo $value["title"]; ?></a><br>
			<?php
					} // endforeach
				}else{
					echo "まだ記事がありません。";
				}
			?>
		</div>
		

		<p style="background: red;color: #fff;"><?php if(!empty($_SESSION["ress_msg"])){	echo $_SESSION["ress_msg"];} ?></p>
		<form action="insert/insertblog.php" method="post">
			<input type="hidden" name="csrf_token" value="<?php echo $token; ?>"> 
		<select name="category_id">
			<option></option>
		</select>
		<br>
		<input type="text" name="title" size="10"><br>
		<textarea name="message" rows="3" cols="5"></textarea><br>
		<button type="submit">送信</button>
		</form>



		<h3>
			記事一覧
		</h3>
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
	</div><!-- // main -->
</body>
</html>