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
		
		//zdedeni pravidel z parent tridy a pridani vlastnich pravidel
		return array_merge(parent::rules(), array(
				array('email', 'required',
						'message' => 'Toto pole je povinné'
				),
				array('password, password_repeate', 'required',
						'message' => 'Toto pole je povinné', 'on' => 'registration'
				),
				array('password', 'compare', 'compareAttribute'=>'password_repeate',
						'message' => 'Zadaná hesla nejsou stejná', 'on' => 'registration'),
				array('email', 'unique', 'caseSensitive' => false,
						'message' => "Tento email je již používaný", 'on' => 'registration'),
				array('nickname', 'unique', 'caseSensitive' => false,
						'message' => "Tato přezdívka je již používaná"),
				array('nickname', 'default', 'setOnEmpty' => true, 'value' => null),
				//array('email', 'unique', 'caseSensitive' => false, 'message' => "Uživatel s tímto emailem již existuje"),
				)
		);
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
			if($this->scenario == 'registration')
				$this->password = $this->hashPassword($this->password);
		}
	}
}