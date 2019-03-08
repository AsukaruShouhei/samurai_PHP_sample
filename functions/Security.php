<?php

/**
 * セキュリティ対策 
 */
class Security
{
	/**
	 * make token
	 * @return boolean 
	 */
	public function makeCsrf()
	{
	    $toke_byte = openssl_random_pseudo_bytes(16);
	    $token = bin2hex($toke_byte);
	    return $token;
	}


	/**
	 * @param $sessionToken string session["csrf_token"] 
	 * @param $postToken string post["csrf_token"] 
	 * @return boolean 
	 */
	public function csrf($sessionToken, $postToken)
	{
		$postToken = htmlspecialchars($postToken, ENT_QUOTES, 'utf-8');
		if ( isset($postToken) && ($postToken === $sessionToken) ) {
			return true;
		}
		else{
			return false;
		}
	}

}