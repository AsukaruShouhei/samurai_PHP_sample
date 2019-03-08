<?php
	session_start();
	// csrf_token check
	require_once '../functions/Security.php';

	if( Security::csrf($_SESSION["csrf_token"], $_POST["csrf_token"]) ){
		// true
		require_once '../functions/blog.php';
		$category_name = htmlspecialchars($_POST["category_name"], ENT_QUOTES, 'utf-8');
		if (isset($_POST["user_id"])) {
			$user_id = htmlspecialchars($_POST["user_id"], ENT_QUOTES, 'utf-8');
		}else{
			$user_id = null;
		}
		$blog = new blog();
		$ress = $blog->insertCategory($user_id, $category_name);
		header('location: ../category.php');
	}else{
		$_SESSION["ress_msg"] = "不正な処理が行われました";
		header('location: ../category.php');
	}