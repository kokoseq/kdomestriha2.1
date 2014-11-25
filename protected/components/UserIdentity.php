<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	
	/**
	 * Authenticates a user.
	 * Prihlasovaci jmeno ($username) je email
	 * 
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$user=User::model()->findByAttributes(array('email'=>$this->username));	
		
		//pokud uzivatel neexistuje
		if($user===null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		//pokud zadal spatne heslo nebo email
		else if(!$user->validatePassword($this->password))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		//jinak je vse spravne
		else
		{	
			$this->_id = $user->id;
			$this->errorCode=self::ERROR_NONE;
		}
		return !$this->errorCode;
	}
	
	/**
	 * @see CUserIdentity::getId()
	 */
	public function getId()
	{
		return $this->_id;	
	}
}