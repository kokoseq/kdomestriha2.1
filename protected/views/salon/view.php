<?php
/* @var $this SalonController */
/* @var $model Salon */

$this->breadcrumbs=array(
	'Salons'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Salon', 'url'=>array('index')),
	array('label'=>'Create Salon', 'url'=>array('create')),
	array('label'=>'Update Salon', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Salon', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Salon', 'url'=>array('admin')),
);
?>

<h1>View Salon #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'address',
		'lat',
		'lng',
		'phone',
		'website',
		'fb_site',
		'email',
		'description',
		'create_time',
		'update_time',
		'avg_rating',
		'avg_sub_rating1',
		'avg_sub_rating2',
		'avg_sub_rating3',
		'avg_price_women',
		'avg_price_men',
		'account_level',
		'create_user_id',
		'owner_user_id',
	),
)); ?>
