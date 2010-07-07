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

<h1>View Contact #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
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
)); ?>

<?php foreach( $model->answers as $answer): ?>
	<?php echo $answer->answer; ?>
<?php endforeach; ?>

<?php foreach( $model->bizcards as $bizcard ) : ?>
	<?php echo $bizcard->bizcard; ?>
<?php endforeach; ?>
