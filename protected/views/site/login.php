<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<h1>Login</h1>

<p>Please fill out the following form with your login credentials:</p>

<?php
$form = $this->beginWidget(
	'booster.widgets.TbActiveForm',
	array(
		'id' => 'login-form',	
		'enableClientValidation'=>true,
		'clientOptions'=>array(
		'validateOnSubmit'=>true,
),	
		)
); ?>

<?php 
echo $form->textFieldGroup($model, 'email');
echo $form->passwordFieldGroup($model, 'password');
$this->widget(
		'booster.widgets.TbButton',
		array('buttonType' => 'submit', 'label' => 'Přihlásit')
);
$this->endWidget();
unset($form); ?>