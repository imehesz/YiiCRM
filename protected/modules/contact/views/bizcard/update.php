<?php
$this->breadcrumbs=array(
	'Bizcards'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Bizcard', 'url'=>array('index')),
	array('label'=>'Create Bizcard', 'url'=>array('create')),
	array('label'=>'View Bizcard', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Bizcard', 'url'=>array('admin')),
);
?>

<h1>Update Bizcard</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
