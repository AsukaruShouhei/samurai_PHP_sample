<?php
	session_start();
	$_SESSION["ress_msg"] = null;
	require_once '../functions/blog.php';

	$category_id = htmlspecialchars($_POST["category_id"], ENT_QUOTES, 'utf-8');
	$title = htmlspecialchars($_POST["title"], ENT_QUOTES, 'utf-8');
	$message = htmlspecialchars($_POST["message"], ENT_QUOTES, 'utf-8');

	$blog = new blog();
	$blog->insertBlogMessage($category_id, $title, $message);

	header('location: ../index.php');