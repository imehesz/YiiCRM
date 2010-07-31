<?php
$this->breadcrumbs=array(
	'Contacts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Contact', 'url'=>array('index')),
	array('label'=>'Create Contact', 'url'=>array('create')),
	array('label'=>'Update Contact', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Contact', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Contact', 'url'=>array('admin')),
);
?>
<?php echo CHtml::link( 'edit', $this->createUrl( '/contact/contact/update', array( 'id' => $model->id ) ) ); ?>
<h1><?php echo $model->firstname . ' <strong>' . $model->lastname . '</strong>'; ?></h1>

<div class="contact-left-panel">
		<div class="contact-row"> 
			<label><?php echo Yii::t( 'contact', 'first name' ); ?></label>
			<?php echo $model->firstname; ?>	
		</div>

		<div class="contact-row">
			<label><?php echo Yii::t( 'contact', 'last name' ); ?></label>
			<?php echo $model->lastname; ?>	
		</div>

		<div class="contact-row">
			<label><?php echo Yii::t( 'contact', 'email address' ); ?></label>
			<?php echo $model->email; ?>	
		</div>

		<?php 
		/*
		$this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				'id',
				'userID',
				'domainID',
				'public',
				'firstname',
				'lastname',
				'email',
			),
		)); 
		*/
		?>

		<?php foreach( $model->answers as $answer): ?>
			<div class="contact-row">
				<label>
					<?php
						echo ContactQuestion::model()->findByPk( $answer->questionID )->question;
					?>
				</label>
			<?php echo $answer->answer; ?>
			</div>
		<?php endforeach; ?>
</div>

<div style="margin-top:10px;">
<?php foreach( $model->bizcards as $bizcard ) : ?>
	<?php 
		$bizthumb = str_replace( '/index.php', '', Yii::app()->image->createUrl( 'bizthumb', MEHESZ_FILE_STORAGE . $bizcard->bizcard ) ); 
		$bizpopup = str_replace( '/index.php', '', Yii::app()->image->createUrl( 'bizpopup', MEHESZ_FILE_STORAGE . $bizcard->bizcard ) );
	?>
	<div class="" rel="#popup_<?php echo $bizcard->id;?>" style="text-align:center;width:120px;min-height:90px;float:left;">
		<a href="#"><img src="<?php echo $bizthumb; ?>" /></a>
	</div>

	<div class="simple_overlay" id="popup_<?php echo $bizcard->id; ?>">
		<!-- large image -->
		<img src="<?php echo $bizpopup; ?>" />
		<!-- image details -->
		<div class="details">
			<h2 style="color:#fff;"><?php echo $model->firstname; ?> <strong><?php echo $model->lastname; ?></strong></h2>
			<div>
				<p><strong>email:</strong> <?php echo $bizcard->contact->email; ?></p>
			</div>
		</div>
	</div>
<?php endforeach; ?>
	</div>
</div>

<div style="clear:both;"></div>
<?php 
	Yii::app()->clientScript->registerCoreScript('jquery');
	$cs = Yii::app()->getClientScript();
	$cs->registerCssFile('/css/jtools.css');
	$cs->registerScriptFile('/js/jtools/jtools.min.js');
?>

<script>
	$("div[rel]").overlay();
</script>

