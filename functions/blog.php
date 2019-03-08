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



	/**
	 * insert category
	 *  @param user_id integer category id defalt is null
	 *  @param category_name varchar max 255 string
	 *  
	 *  @return session
	 * 
	 */
	public function insertCategory($user_id=null, $category_name){
		require_once '../functions/DbManager.php';
		$db = DbManager::getDb();
		// title max 255 byte => strlen ( string $string ) : int
		if (strlen($title) > 255) {
			return $_SESSION["ress_msg"] = "文字数が長すぎます";
		}else{
			try{
				$stt = $db->prepare("INSERT INTO category(user_id, category_name) VALUES(:user_id, :category_name)");
				$stt->bindValue(':user_id', $user_id);
				$stt->bindValue(':category_name', $category_name);
				$stt->execute();
				return $_SESSION["ress_msg"] = "カテゴリ登録が完了しました。";
			} catch (Exception $e) {
				return $_SESSION["ress_msg"] = "error: ". $e;
			}
		}
	} 


	/**
	 * 登録 category　取得
	 *  @param user_id integer category id defalt is null
	 *  @param category_name varchar max 255 string
	 *  
	 *  @return session
	 * 
	 */
	public function getCategory($id=null){
		require_once 'DbManager.php';
		$db = DbManager::getDb();
		if ($id === null ) {
			$stt = $db->prepare("SELECT * FROM category");
			$stt->execute();
			return $stt->fetchAll();
		}else{
			$stt = $db->prepare("SELECT * FROM category WHERE id=:id");
			$stt->bindValue(':id', $id);
			$stt->execute();
			return $stt->fetch(PDO::FETCH_ASSOC);
		}
	} 


	/**
	 *  category　編集/削除　メソッド
	 *  @param id integer category id defalt is null
	 *  @param kbn integer 
	 *  @param category_name varchar max 255 string
	 *  
	 *  @return session
	 * 
	 */
	public function changeCategory($id, $kbn, $category_name){
		require_once '../functions/DbManager.php';
		$db = DbManager::getDb();
		$id = (int)$id;
		$kbn = (int)$kbn;
		// update delete 処理区分
		if ( $kbn === 1 ) {
			// update
			$stt = $db->prepare("UPDATE category SET category_name=:category_name WHERE id=:id");
			$stt->bindValue(':id', $id);
			$stt->bindValue(':category_name', $category_name);
			$stt->execute();
			return $_SESSION["ress_msg"] = "カテゴリ変更が完了しました。";
		}else{
			// delete
			$stt = $db->prepare("DELETE category WHERE id={$id}");
			$stt->bindValue(':id', $id);
			$stt->execute();
			return $_SESSION["ress_msg"] = "カテゴリ{$id}を削除しました。";
		}
	} 
	

}

