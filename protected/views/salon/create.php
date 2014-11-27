<?php
/* @var $this SalonController */
/* @var $model Salon */

$this->breadcrumbs=array(
	'Salons'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Salon', 'url'=>array('index')),
	array('label'=>'Manage Salon', 'url'=>array('admin')),
);
?>

<h1>Create Salon</h1>

<?php $this->renderPartial('_form', array(
		'model'=>$model,
		'scenario'=>$scenario,
		)); ?>