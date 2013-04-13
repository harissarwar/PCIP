<?php
/* @var $this UserDataController */
/* @var $model UserData */

$this->breadcrumbs=array(
	'User Datas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserData', 'url'=>array('index')),
	array('label'=>'Create UserData', 'url'=>array('create')),
	array('label'=>'Update UserData', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserData', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserData', 'url'=>array('admin')),
);
?>

<h1>View UserData #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'seat',
		'layer',
		'tag',
		'value',
	),
)); ?>
