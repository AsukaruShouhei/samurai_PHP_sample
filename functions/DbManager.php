<?php
	
	/*
	* DB connection
	*
	*/
	public function getDb(){
		$dsn = 'mysql:dbname=dbName; host=hostName; charset=utf8';
		$user = "userName";
		$pass = "passWord";
		$db = new PDO($dsn,$user,$pass);
		$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $db;
	}
