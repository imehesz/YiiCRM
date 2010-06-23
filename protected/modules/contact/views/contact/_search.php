<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
	<?php /*
	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>*/ ?>

	<div class="row">
		<?php echo $form->label($model,'userID'); ?>
		<?php echo $form->textField($model,'userID'); ?>
	</div>
	<?php /*
	<div class="row">
		<?php echo $form->label($model,'domainID'); ?>
		<?php echo $form->textField($model,'domainID'); ?>
	</div>*/ ?>

	<?php /*
	<div class="row">
		<?php echo $form->label($model,'public'); ?>
		<?php echo $form->textField($model,'public'); ?>
	</div>*/ ?>

	<div class="row">
		<?php echo $form->label($model,'firstname'); ?>
		<?php echo $form->textField($model,'firstname',array('size'=>60,'maxlength'=>240)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lastname'); ?>
		<?php echo $form->textField($model,'lastname',array('size'=>60,'maxlength'=>240)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>240)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
