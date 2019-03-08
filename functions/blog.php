<?php
session_start();
/**
 *  
 * blog class
 */
class blog
{
	// require 'DbManager.php';
	// $db = DbManager::getDb();
	/**
	 * get Blog All
	 *  @param id integer blog id defalt is null
	 *
	 * return 
	 */
	public function getMessageAll($id=null){
		require_once 'functions/DbManager.php';
		$db = DbManager::getDb();
		if ( $id !== null ) {
			$stt = $db->prepare("SELECT * FROM blogs WHERE id=:id");
			$stt->bindValue(':id', $id);
			$stt->execute();
			return $stt->fetch(PDO::FETCH_ASSOC);
		}
		else{
			$db = DbManager::getDb();
			$stt = $db->prepare("SELECT * FROM blogs");
			$stt->execute();
			return $stt->fetchAll();
		}
	}

	/**
	 *  get new Blogs Limit
	 *  @param limit integer blog get Limit defalt is null
	 *
	 * return 
	 */
	public function getMessageLimit($limit=null){
		require_once 'functions/DbManager.php';
		$db = DbManager::getDb();
		$stt = $db->prepare("SELECT * FROM blogs ORDER BY id DESC LIMIT 5");
		// $stt->bindValue(':l', $limit);
		$stt->execute();
		return $stt->fetchAll();
	}

	/**
	 * insert blog
	 *  @param category_id integer category id defalt is null
	 *  @param title varchar max 255 string
	 *  @param message text string
	 *  return session
	 *
	 * return 
	 */
	public function insertBlogMessage($category_id, $title, $message){
		require_once '../functions/DbManager.php';
		$db = DbManager::getDb();
		// title max 255 byte => strlen ( string $string ) : int
		if (strlen($title) > 255) {
			return $_SESSION["ress_msg"] = "タイトルの文字数が長すぎます";
		}else{
			try{
				$stt = $db->prepare("INSERT INTO blogs(category_id, title, message) VALUES(:category_id, :title, :message)");
				$stt->bindValue(':category_id', $category_id);
				$stt->bindValue(':title', $title);
				$stt->bindValue(':message', $message);
				$stt->execute();
				return $_SESSION["ress_msg"] = "記事の投稿が完了しました。";
			} catch (Exception $e) {
				return $_SESSION["ress_msg"] = "error: ". $e;
			}
		}
	} 
	

}

