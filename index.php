<?php
	require 'functions/blog.php';
	
	$blog = new blog();

	$getBlog = $blog->getMessageAll();

	foreach ($getBlog as $key => $value) {
		echo $value;
	}