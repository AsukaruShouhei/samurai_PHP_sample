<?php
	session_start();
	require_once "functions/blog.php";
	require_once "functions/Security.php";
	// csrf_token 発行
	// $token = Security::makeCsrf();
	$sec = new Security();
	$token = $sec->makeCsrf();
	$_SESSION['csrf_token'] = $token;
	$blog = new blog();

	// 2019/03/08　　header.php 読み込み
	include_once 'header.php';
?>

<?php include_once 'sideBar.php'; ?>

	<div id="main">
							<!-- 2019/03/08 Limit区を使った取得制限 追加 -->
		<h3>
			新規投稿記事
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
		<div class="form-group">
		    <label for="exampleFormControlSelect2">投稿カテゴリを選択</label>
		    <select class="form-control" id="exampleFormControlSelect2" name="category_id">
		      <?php
		      	$categories = $blog->getCategory();
		      	foreach ($categories as $key => $value) {
		      		echo "<option value='{$value['id']}'>".$value['category_name']."</option>";
		      	}
		      ?>
		    </select>
		</div>
		<div class="form-group">
			<label for="exampleFormControlInput1">記事タイトル</label>
			<input type="text" class="form-control" id="exampleFormControlInput1" name="title">
		</div>
		<div class="form-group">
			<label for="exampleFormControlTextarea1">記事本文</label>
			<textarea class="form-control" id="exampleFormControlTextarea1" rows="13" name="message"></textarea>
		</div>
		<button type="submit" class="btn btn-primary btn-lg btn-block">投稿する</button>
		</form>
	</div><!-- // main -->
<?php include_once 'footer.php'; ?>