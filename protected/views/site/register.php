<?php
/* @var $this SiteController */
/* @var $model RegistrationForm */

$form = $this->beginWidget(
	'booster.widgets.TbActiveForm',
	array(
		'id' => 'registration-form',		
		)
);

echo $form->textFieldGroup($model, 'email');
echo $form->textFieldGroup($model, 'nickname');
echo $form->passwordFieldGroup($model, 'password');
echo $form->passwordFieldGroup($model, 'password_repeate');
$this->widget(
		'booster.widgets.TbButton',
		array('buttonType' => 'submit', 'label' => 'Registrovat')
);

$this->endWidget();
unset($form);
?>

