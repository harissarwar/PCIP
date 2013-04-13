<?php
/* @var $this LayerController */
/* @var $model Layer */

$this->breadcrumbs=array(
	'Layers'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Layer', 'url'=>array('index')),
	array('label'=>'Create Layer', 'url'=>array('create')),
	array('label'=>'Update Layer', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Layer', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Layer', 'url'=>array('admin')),
);
?>

<h1>View Layer #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'tag',
		'desc',
	),
)); ?>
