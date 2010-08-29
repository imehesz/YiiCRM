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

	<div class="row">
		<?php echo $form->labelEx($model,'contactID'); ?>
		<?php echo $form->dropDownList( $model, 'contactID', Contact::model()->idsWithNames()); ?>
		<?php echo $form->error($model,'contactID'); ?>
	</div>

	<div class="row">
		<?php echo CHtml::activeFileField($model, 'image'); ?>
	</div>

	<?php 
		if( ! $model->isNewRecord )
		{
			Yii::app()->clientScript->registerCoreScript('jquery');
			$module_path = Yii::getPathOfAlias( 'application.modules.' . $this->module->name );
			$jsfile 	= $module_path . '/js/jquery.jcrop.min.js'; 
			$cssfile	= $module_path . '/css/jquery.jcrop.css';

			$asset_js 	= Yii::app()->getAssetManager()->publish( $jsfile );
			$asset_css 	= Yii::app()->getAssetManager()->publish( $cssfile );
			$cs = Yii::app()->getClientScript();

			$cs->registerScriptFile( $asset_js );
			$cs->registerCssFile( $asset_css );

			$bizpopup = Yii::app()->image->createUrl( 'bizpopup', MEHESZ_FILE_STORAGE . $model->bizcard_orig );
			// echo '<img id="cropbox" src="' . Yii::app()->request->baseUrl . '/files/' . $model->bizcard_orig . '" />';
			echo '<img id="cropbox" src="' . $bizpopup . '" />';
		}
	?>

			<input type="hidden" id="x" name="x" />
			<input type="hidden" id="y" name="y" />
			<input type="hidden" id="w" name="w" />
			<input type="hidden" id="h" name="h" />

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

		<script language="Javascript">

			$(function(){

				$('#cropbox').Jcrop({
					//aspectRatio: 2,
					onSelect: updateCoords
				});

			});

			function updateCoords(c)
			{
				$('#x').val(c.x);
				$('#y').val(c.y);
				$('#w').val(c.w);
				$('#h').val(c.h);
			};

			function checkCoords()
			{
				if (parseInt($('#w').val())) return true;
				alert('Please select a crop region then press submit.');
				return false;
			};

		</script>

