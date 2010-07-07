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

<h1>View Bizcard #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
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
)); ?>
