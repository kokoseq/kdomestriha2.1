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
				array('email, password, password_repeate', 'required',
						'message' => 'Toto pole je povinné'
				),
				array('email', 'unique', 'caseSensitive' => false,
						'message' => "Tento email je již používaný"),
				array('password', 'compare', 'compareAttribute'=>'password_repeate', 'message' => 'Zadaná hesla nejsou stejná'),
				array('password', 'length', 'max'=>15, 'min' => 4, 
						'tooShort' => 'Délka hesla musí být minimálně 4 znaky', 
						'tooLong' => 'Délka hesla může být maximálně 15 znaků'),
				array('nickname', 'unique', 'caseSensitive' => false,
						'message' => "Tato přezdívka je již používaná"),
				//array('email', 'unique', 'caseSensitive' => false, 'message' => "Uživatel s tímto emailem již existuje"),
		);
		
		//zdedeni pravidel z parent tridy
		return array_merge($rules, parent::rules());
	}
	
	public function attributeLabels()
	{
		$labels = array(
				'password_repeate' => 'Ověření hesla'
		);
		
		return array_merge($labels, parent::attributeLabels());
	}
	
	/**
	 * Nastavi reg_date, auth_level a zahashuje heslo
	 * 
	 * @see CActiveRecord::beforeSave()
	 */
	public function afterValidate()
	{
		parent::afterValidate();
		if(!$this->hasErrors()){
			$this->reg_date = date("Y-m-d", time());
			$this->auth_level = parent::AUTH_LEVEL_USER;
			$this->password = $this->hashPassword($this->password);
		}
	}
}