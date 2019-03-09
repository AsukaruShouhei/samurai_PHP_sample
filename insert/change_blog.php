<?php
	session_start();
	unset($_SESSION["ress-msg"]);
	require_once '../functions/blog.php'; 

	// csrf
	require_once '../functions/Security.php';
	$sec = new Security();
	if ( $sec->csrf($_SESSION["csrf_token"], $_POST["csrf_token"]) ) {
		
		// 変更処理
		$id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'utf-8');
		$kbn = htmlspecialchars($_POST["kbn"], ENT_QUOTES, 'utf-8');
		$title = htmlspecialchars($_POST["title"], ENT_QUOTES, 'utf-8');
		$message = htmlspecialchars($_POST["message"], ENT_QUOTES, 'utf-8');
		
		$blog = new blog();
		$re = $blog->changeBlog($id, $kbn, $title, $message);
		header('location: ../blogAdmin.php');

	}
	else{

		$_SESSION["ress-msg"] = "不正な処理が行われました。";
		header('location: ../blogAdmin.php');
	}