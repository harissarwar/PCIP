<?php
/* @var $this LayerController */
/* @var $model Layer */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'layer-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
		<div class="row">
			<?php echo $form->labelEx($model,'name'); ?>
			<?php if(isset($layers)) 
			  echo $form->dropDownList($model, 'name', CHtml::listData($layers, 'name', 'name'));
			else
				echo $form->textField($model,'name',array('size'=>32,'maxlength'=>32));
			?>
			<?php echo $form->error($model,'name'); ?>
		</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tag'); ?>
		<?php echo $form->textField($model,'tag',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'tag'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'desc'); ?>
		<?php echo $form->textField($model,'desc',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'desc'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->