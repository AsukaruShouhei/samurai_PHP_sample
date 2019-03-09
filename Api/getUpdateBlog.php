<?php
	header("Content-Type: application/json; charset=UTF-8"); //ヘッダー情報の明記。必須。

	// get update data Ajax
	require_once '../functions/DbManager.php';
	$dm = new DbManager();
	$db = $dm->getDb();
	$id = filter_input(INPUT_POST,"id");
	$id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'utf-8');

	// get blog info
	$stt = $db->prepare("SELECT * FROM blogs WHERE id=:id");
	$stt->bindValue(':id', $id);
	$stt->execute();
	$row = $stt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($row);
    exit; //処理の終了
?>