<?php
	session_start();
	require_once "functions/blog.php";
	require_once "functions/Security.php";
	// csrf_token 発行
	$token = Security::makeCsrf();
	$_SESSION['csrf_token'] = $token;
	$blog = new blog();
?>

<!DOCTYPE html>
<html>
<head>
	<!--  BootStrap 使用 -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<title></title>
</head>
<body>
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
</body>
</html>