<?php

class ResetPasswordForm extends User
{
	public $password_repeate;
	
	public function rules()
	{
		//zdedeni pravidel z parent tridy a pridani vlastnich pravidel
		return array_merge(parent::rules(), array(
				array('email', 'required', 'message' => 'Toto pole je povinné',
						'on' => 'resetRequest'),
				array('email', 'exist', 'message' => 'Uživatel s tímto emailem neexistuje',
						'on' => 'resetRequest'),
				array('password, password_repeate', 'required', 'message' => 'Toto pole je povinné',
						'on' => 'resetSubmit'),
				array('password', 'compare', 'compareAttribute'=>'password_repeate', 
						'message' => 'Zadaná hesla nejsou stejná', 'on' => 'resetSubmit'),
				)
		);
	}
	
}
