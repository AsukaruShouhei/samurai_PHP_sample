<?php
	session_start();
	unset($_SESSION['ress_msg']);
	require '../functions/blog.php';

	// csrf cheack
	require '../functions/Security.php';
	if ( Security::csrf($_SESSION["csrf_token"], $_POST['csrf_token']) ) {
		$id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'utf-8');
		$kbn = htmlspecialchars($_POST["kbn"], ENT_QUOTES, 'utf-8');
		$category_name = htmlspecialchars($_POST["category_name"], ENT_QUOTES, 'utf-8');
		
		$blog = new blog();
		$blog->changeCategory($id, $kbn, $category_name);
		header('location: ../category.php');
	}else{
		$_SESSION["ress_msg"] = "不正な処理が行われました";
		header('location: ../category.php');
	}
