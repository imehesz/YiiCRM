<?php
$this->breadcrumbs=array(
	'Bizcards'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Bizcard', 'url'=>array('index')),
	array('label'=>'Manage Bizcard', 'url'=>array('admin')),
);
?>

<h1>Create Bizcard</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>