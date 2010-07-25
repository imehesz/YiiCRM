<?php
$this->breadcrumbs=array(
	'Contacts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Contact', 'url'=>array('index')),
	array('label'=>'Manage Contact', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('contact', 'create contact'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
