<?php
$this->breadcrumbs=array(
	'Bizcards'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Bizcard', 'url'=>array('index')),
	array('label'=>'Create Bizcard', 'url'=>array('create')),
	array('label'=>'Update Bizcard', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Bizcard', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Bizcard', 'url'=>array('admin')),
);
?>

<?php /*
	$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'domainID',
		'userID',
		'contactID',
		'bizcard',
		'bizcard_orig',
		'created',
	),
)); */
?>
<div style="text-align:center;color:#fff;font-size:24px;font-weight:bolder;background-color:#999;width:300px;padding:5px;">
	<?php echo $model->contact->firstname . ' ' . $model->contact->lastname; ?>
</div>
<div style="padding:5px;border:2px solid #999;text-align:center;">
	<img src="<?php echo Yii::app()->request->baseUrl; ?>/files/<?php echo $model->bizcard; ?>" width="650"></a>
</div>
