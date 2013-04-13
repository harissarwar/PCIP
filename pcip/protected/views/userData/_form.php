<?php
/* @var $this UserDataController */
/* @var $model UserData */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-data-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model);?>
	<!--
	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>
	-->
	<div class="row">
		<?php echo $form->labelEx($model,'seat'); ?>
		<?php echo $form->dropDownList($model, 'seat', CHtml::listData($seats, 'seat', 'seat')); ?>			  
		<?php echo $form->error($model,'seat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'layer'); ?>
		<?php echo $form->dropDownList($model, 'layer', 
			CHtml::listData($layers, 'name', 'name'), 
				array(
					'ajax'=>array(
						'type'=>'POST',
						'url'=>CController::createUrl('layer/tagshtml'),
						'data'=>'js:{layer:this.value}', 
						'update'=>'#UserData_tag'
					)
				)
			); 
		?>
		<?php echo $form->error($model,'layer'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tag'); ?>
		<?php echo $form->dropDownList($model, 'tag', CHtml::listData($tags, 'tag', 'tag')); ?>
		<?php echo $form->error($model,'tag'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'value'); ?>
		<?php echo $form->textField($model,'value',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'value'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->