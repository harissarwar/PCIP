<?php
/* @var $this LayerController */
/* @var $model Layer */

$this->breadcrumbs=array(
	'Layers'=>array('index'),
	'Add Tag',
);

$this->menu=array(
	array('label'=>'List Layer', 'url'=>array('index')),
	array('label'=>'Manage Layer', 'url'=>array('admin')),
);
?>

<h1>Add Tag</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'layers'=>$layers)); ?>