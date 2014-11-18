<?php

/*
 * Model pro registraci
 */
class RegistrationForm extends User
{
	public $password_repeate;
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		$rules = array(
				array('email, password, password_repeate', 'required'),
				array('password', 'compare', 'compareAttribute'=>'password_repeate', 'message' => 'Zadaná hesla nejsou stejná'),
				array('password', 'length', 'max'=>15, 'min' => 4, 
						'tooShort' => 'Špatné heslo, délka musí být minimálně 4 znaky', 
						'tooLong' => 'Špatné heslo, délka musí být maximálně 15 znaků'),
				array('nickname', 'unique', 'caseSensitive' => false,
						'message' => "Tato přezdívka je už používaná"),
				//array('email', 'unique', 'caseSensitive' => false, 'message' => "Uživatel s tímto emailem již existuje"),
		);
		
		//zdedeni pravidel z User modelu
		return array_merge($rules, parent::rules());
	}
	
	/**
	 * Nastavi reg_date, auth_level a zahashuje heslo
	 * 
	 * @see CActiveRecord::beforeSave()
	 */
	public function beforeSave()
	{
		$this->reg_date = date("Y-m-d", time());
		$this->auth_level = parent::AUTH_LEVEL_USER;
		$this->password = $this->hashPassword($this->password);
	}
}