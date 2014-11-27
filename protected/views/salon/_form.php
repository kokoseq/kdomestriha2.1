<?php
/* @var $this SalonController */
/* @var $model Salon */
/* @var $scenario String */
/* @var $form CActiveForm */

if($scenario == 'unregisteredCreate')
{
	$user = $model['user'];
	$model = $model['model'];
}

$form = $this->beginWidget(
	'booster.widgets.TbActiveForm',
	array(
		'id' => 'registration-form',		
		)
);

if($scenario == 'unregisteredCreate')
{
	echo $form->textFieldGroup($user, 'email');
	echo $form->textFieldGroup($user, 'nickname');
}

echo $form->textFieldGroup($model, 'name');
echo $form->textFieldGroup($model, 'address');
echo $form->textFieldGroup($model, 'phone');
echo $form->textFieldGroup($model, 'website');
echo $form->textFieldGroup($model, 'fb_site');

//@todo moznost zadat i dalsi udaje

$this->widget(
		'booster.widgets.TbButton',
		array('buttonType' => 'submit', 'label' => 'Uložit')
);

$this->endWidget();
unset($form);
?>
