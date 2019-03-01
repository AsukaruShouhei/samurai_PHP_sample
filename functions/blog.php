<?php

/**
 *  
 * blog class
 */
class blog extends AnotherClass
{
	
	require 'DbManager.php';
	$db = getDb();


	/**
	 * get Blog All
	 *  @param id integer blog id defalt is null
	 *
	 * return 
	 */
	public function getMessageAll($id=null){
		global $db;
		if ( $id !== null ) {
			$stt = $db->prepare("SELECT * FROM blogs");
			$stt->execute();
			return $stt->fectchAll();
		}
		else{
			$stt = $db->prepare("SELECT * FROM blogs WHERE id=:id");
			$stt->bincValue(':id', $id);
			$stt->execute();
			return $stt->fetch(PDO::FETCH_ASSOC);
		}
	} 
	
}

