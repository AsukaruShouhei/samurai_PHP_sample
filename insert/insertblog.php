<?php
	session_start();
	$_SESSION["ress_msg"] = null;
	require_once '../functions/blog.php';

	//scrf_token check
	require_once '../functions/Security.php';
	if( Security::csrf($_SESSION['csrf_token'], $_POST["csrf_token"]) ) {

		$category_id = htmlspecialchars($_POST["category_id"], ENT_QUOTES, 'utf-8');
		$title = htmlspecialchars($_POST["title"], ENT_QUOTES, 'utf-8');
		$message = htmlspecialchars($_POST["message"], ENT_QUOTES, 'utf-8');

		$blog = new blog();
		$blog->insertBlogMessage($category_id, $title, $message);

		header('location: ../index.php');
	}
	else{

		$_SESSION["ress_msg"] = "不正な処理が行われました";
		header('location: ../index.php');
	}