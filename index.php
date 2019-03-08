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
	<title></title>
</head>
<body>
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
</body>
</html>