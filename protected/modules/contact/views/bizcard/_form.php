<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'bizcard-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
		'enctype'=>'multipart/form-data'
	)
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

<?php 
	/*<div class="row">
		<?php echo $form->labelEx($model,'domainID'); ?>
		<?php echo $form->textField($model,'domainID'); ?>
		<?php echo $form->error($model,'domainID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'userID'); ?>
		<?php echo $form->textField($model,'userID'); ?>
		<?php echo $form->error($model,'userID'); ?>
	</div>
	*/?>
	<div class="row">
		<?php echo $form->labelEx($model,'contactID'); ?>
		<?php echo $form->dropDownList( $model, 'contactID', Contact::model()->idsWithNames()); ?>
		<?php echo $form->error($model,'contactID'); ?>
	</div>

	<div class="row">
		<?php echo CHtml::activeFileField($model, 'image'); ?>
	</div>
	<?php /*
	<div class="row">
		<?php echo $form->labelEx($model,'bizcard'); ?>
		<?php echo $form->textField($model,'bizcard',array('size'=>60,'maxlength'=>240)); ?>
		<?php echo $form->error($model,'bizcard'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bizcard_orig'); ?>
		<?php echo $form->textField($model,'bizcard_orig',array('size'=>60,'maxlength'=>240)); ?>
		<?php echo $form->error($model,'bizcard_orig'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
		<?php echo $form->error($model,'created'); ?>
	</div>
	*/ ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
