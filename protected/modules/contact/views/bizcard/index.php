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

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
