<?php
/* @var $this SalonController */
/* @var $model Salon */

$this->breadcrumbs=array(
	'Salons'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Salon', 'url'=>array('index')),
	array('label'=>'Create Salon', 'url'=>array('create')),
	array('label'=>'View Salon', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Salon', 'url'=>array('admin')),
);
?>

<h1>Update Salon <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>