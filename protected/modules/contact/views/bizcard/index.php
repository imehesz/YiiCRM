<?php
$this->breadcrumbs=array(
	'Bizcards',
);

$this->menu=array(
	array('label'=>'Create Bizcard', 'url'=>array('create')),
	array('label'=>'Manage Bizcard', 'url'=>array('admin')),
);
?>

<h1>Bizcards</h1>

<?php foreach( $bizcards as $bizcard ): ?>
	<?php 
		$bizthumb = str_replace( '/index.php', '', Yii::app()->image->createUrl( 'bizthumb', MEHESZ_FILE_STORAGE . $bizcard->bizcard ) );
		$bizpopup = str_replace( '/index.php', '', Yii::app()->image->createUrl( 'bizpopup', MEHESZ_FILE_STORAGE . $bizcard->bizcard ) );
	?>
	<div class="" rel="#popup_<?php echo $bizcard->id;?>" style="text-align:center;width:120px;min-height:90px;float:left;">
		<a href="#"><img src="<?php echo $bizthumb; ?>" /></a>
		<div style="font-size:10px;text-align:center;"><?php echo $bizcard->contact->firstname . ' <strong>' . $bizcard->contact->lastname; ?></strong></div>
	</div>

	<div class="simple_overlay" id="popup_<?php echo $bizcard->id; ?>">
		<!-- large image -->
		<img src="<?php echo $bizpopup; ?>" />
		<!-- image details -->
		<div class="details">
			<h2 style="color:#fff;"><?php echo $bizcard->contact->firstname; ?> <strong><?php echo $bizcard->contact->lastname; ?></strong></h2>
			<div>
				<p><strong>email:</strong> <?php echo $bizcard->contact->email; ?></p>
				<?php foreach( $bizcard->contact->answers as $answer ) : ?>
					<strong><?php echo $answer->question->question; ?></strong>	<?php echo $answer->answer; ?>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
<?php endforeach; ?>

<?php 
	Yii::app()->clientScript->registerCoreScript('jquery');
	$cs = Yii::app()->getClientScript();
	$cs->registerCssFile('/css/jtools.css');
	$cs->registerScriptFile('/js/jtools/jtools.min.js');
?>

<script>
	$("div[rel]").overlay();
</script>
<?php
	/*
	$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 
	*/
	?>
