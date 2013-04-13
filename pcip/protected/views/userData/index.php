<?php
/* @var $this UserDataController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Data',
);

$this->menu=array(
	array('label'=>'Create UserData', 'url'=>array('create')),
	array('label'=>'Manage UserData', 'url'=>array('admin')),
);
?>

<h1>User Data</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
