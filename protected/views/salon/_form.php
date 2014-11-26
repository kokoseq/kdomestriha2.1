<?php
/* @var $this SalonController */
/* @var $model Salon */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'salon-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>70)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>70)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lat'); ?>
		<?php echo $form->textField($model,'lat'); ?>
		<?php echo $form->error($model,'lat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lng'); ?>
		<?php echo $form->textField($model,'lng'); ?>
		<?php echo $form->error($model,'lng'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'website'); ?>
		<?php echo $form->textField($model,'website',array('size'=>60,'maxlength'=>70)); ?>
		<?php echo $form->error($model,'website'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fb_site'); ?>
		<?php echo $form->textField($model,'fb_site',array('size'=>60,'maxlength'=>70)); ?>
		<?php echo $form->error($model,'fb_site'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'create_time'); ?>
		<?php echo $form->textField($model,'create_time'); ?>
		<?php echo $form->error($model,'create_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'update_time'); ?>
		<?php echo $form->textField($model,'update_time'); ?>
		<?php echo $form->error($model,'update_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'avg_rating'); ?>
		<?php echo $form->textField($model,'avg_rating'); ?>
		<?php echo $form->error($model,'avg_rating'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'avg_sub_rating1'); ?>
		<?php echo $form->textField($model,'avg_sub_rating1'); ?>
		<?php echo $form->error($model,'avg_sub_rating1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'avg_sub_rating2'); ?>
		<?php echo $form->textField($model,'avg_sub_rating2'); ?>
		<?php echo $form->error($model,'avg_sub_rating2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'avg_sub_rating3'); ?>
		<?php echo $form->textField($model,'avg_sub_rating3'); ?>
		<?php echo $form->error($model,'avg_sub_rating3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'avg_price_women'); ?>
		<?php echo $form->textField($model,'avg_price_women'); ?>
		<?php echo $form->error($model,'avg_price_women'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'avg_price_men'); ?>
		<?php echo $form->textField($model,'avg_price_men'); ?>
		<?php echo $form->error($model,'avg_price_men'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'account_level'); ?>
		<?php echo $form->textField($model,'account_level'); ?>
		<?php echo $form->error($model,'account_level'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'create_user_id'); ?>
		<?php echo $form->textField($model,'create_user_id'); ?>
		<?php echo $form->error($model,'create_user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'owner_user_id'); ?>
		<?php echo $form->textField($model,'owner_user_id'); ?>
		<?php echo $form->error($model,'owner_user_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->