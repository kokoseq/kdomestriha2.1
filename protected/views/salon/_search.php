<?php
/* @var $this SalonController */
/* @var $model Salon */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>70)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>70)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lat'); ?>
		<?php echo $form->textField($model,'lat'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lng'); ?>
		<?php echo $form->textField($model,'lng'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'website'); ?>
		<?php echo $form->textField($model,'website',array('size'=>60,'maxlength'=>70)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fb_site'); ?>
		<?php echo $form->textField($model,'fb_site',array('size'=>60,'maxlength'=>70)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'create_time'); ?>
		<?php echo $form->textField($model,'create_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'update_time'); ?>
		<?php echo $form->textField($model,'update_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'avg_rating'); ?>
		<?php echo $form->textField($model,'avg_rating'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'avg_sub_rating1'); ?>
		<?php echo $form->textField($model,'avg_sub_rating1'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'avg_sub_rating2'); ?>
		<?php echo $form->textField($model,'avg_sub_rating2'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'avg_sub_rating3'); ?>
		<?php echo $form->textField($model,'avg_sub_rating3'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'avg_price_women'); ?>
		<?php echo $form->textField($model,'avg_price_women'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'avg_price_men'); ?>
		<?php echo $form->textField($model,'avg_price_men'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'account_level'); ?>
		<?php echo $form->textField($model,'account_level'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'create_user_id'); ?>
		<?php echo $form->textField($model,'create_user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'owner_user_id'); ?>
		<?php echo $form->textField($model,'owner_user_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->