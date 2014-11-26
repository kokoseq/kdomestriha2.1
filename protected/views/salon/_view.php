<?php
/* @var $this SalonController */
/* @var $data Salon */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lat')); ?>:</b>
	<?php echo CHtml::encode($data->lat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lng')); ?>:</b>
	<?php echo CHtml::encode($data->lng); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>
	<?php echo CHtml::encode($data->phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('website')); ?>:</b>
	<?php echo CHtml::encode($data->website); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fb_site')); ?>:</b>
	<?php echo CHtml::encode($data->fb_site); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_time')); ?>:</b>
	<?php echo CHtml::encode($data->update_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('avg_rating')); ?>:</b>
	<?php echo CHtml::encode($data->avg_rating); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('avg_sub_rating1')); ?>:</b>
	<?php echo CHtml::encode($data->avg_sub_rating1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('avg_sub_rating2')); ?>:</b>
	<?php echo CHtml::encode($data->avg_sub_rating2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('avg_sub_rating3')); ?>:</b>
	<?php echo CHtml::encode($data->avg_sub_rating3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('avg_price_women')); ?>:</b>
	<?php echo CHtml::encode($data->avg_price_women); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('avg_price_men')); ?>:</b>
	<?php echo CHtml::encode($data->avg_price_men); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('account_level')); ?>:</b>
	<?php echo CHtml::encode($data->account_level); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->create_user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('owner_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->owner_user_id); ?>
	<br />

	*/ ?>

</div>