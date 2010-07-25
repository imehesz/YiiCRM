<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo Yii::t( 'form', 'Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary($model); ?>
	<?php /*
	<div class="row">
		<?php echo $form->labelEx($model,'userID'); ?>
		<?php echo $form->textField($model,'userID'); ?>
		<?php echo $form->error($model,'userID'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'domainID'); ?>
		<?php echo $form->textField($model,'domainID'); ?>
		<?php echo $form->error($model,'domainID'); ?>
	</div>
	*/ ?>
	<div class="row">
		<?php echo $form->labelEx($model,'firstname'); ?>
		<?php echo $form->textField($model,'firstname',array('size'=>60,'maxlength'=>240)); ?>
		<?php echo $form->error($model,'firstname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lastname'); ?>
		<?php echo $form->textField($model,'lastname',array('size'=>60,'maxlength'=>240)); ?>
		<?php echo $form->error($model,'lastname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>240)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'public'); ?>
		<?php echo $form->checkBox($model,'public'); ?>
		<?php echo $form->error($model,'public'); ?>
		<div class="description">
			<?php  echo Yii::t( 'contact', 'If you set this contact "public", other members of your community will be able to view his/her information!');?>
		</div>
	</div>
	
	<?php if( $model->isNewRecord ): ?>
		<div class="row">
			<?php echo $form->labelEx( $model, 'addbizcard' ); ?>
			<?php echo $form->checkBox( $model, 'addbizcard' ); ?>
			<div class="description">
				<?php echo Yii::t( 'contact', 'Check, if you also want to upload a business card image.' ); ?>
			</div>
		</div>
	<?php endif; ?>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
