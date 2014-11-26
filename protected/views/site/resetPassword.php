<?php
if(Yii::app()->user->hasFlash('resetPasswordMessage'))
	$this->widget('booster.widgets.TbAlert', array(
		'closeText' => false,
		'alerts' => array(
			'resetPasswordMessage' => array(
				'htmlOptions' => array(
					'class' => 'alert-success',					
				)
			)
		)
	)		
);

$form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
				'id' => 'reset-password-form',
		)
);	
	
//zobrazeni formulare pro zadani emailu
if($scenario == 'resetRequest')
{
	echo $form->textFieldGroup($model, 'email');
	$this->widget(
			'booster.widgets.TbButton',
			array('buttonType' => 'submit', 'label' => 'Odeslat')
	);
	
	$this->endWidget();
	unset($form);
}
//zobrazeni formulare pro zadani noveho hesla
else 
{
	echo $form->passwordFieldGroup($model, 'password');
	echo $form->passwordFieldGroup($model, 'password_repeate');
	$this->widget(
			'booster.widgets.TbButton',
			array('buttonType' => 'submit', 'label' => 'Odeslat')
	);
	
	$this->endWidget();
	unset($form);
}