<?php
$this->breadcrumbs=array(
	Yii::t('contact','contacts'),
);

$this->menu=array(
	array('label'=>'Create Contact', 'url'=>array('create')),
	array('label'=>'Manage Contact', 'url'=>array('admin')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('contact-grid', {
		data: $(this).serialize()
	});
	return false;
});
");

?>

<h1><?php echo Yii::t('contact','contacts');?></h1>

<?php echo CHtml::link( Yii::t('contact', 'create contact'), $this->createUrl( 'contact/create' ) ); ?> 
<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'contact-grid',
	'dataProvider'=>$model->search(),
	'filter' => $model,
	'columns' => array( 
		array(
			'name'  => 'firstname',
			'value' => '$data->firstname',
			'type'  => 'raw',
			'header'=> ucwords( Yii::t('contact','first name') ),
		),
		array(
			'name'  => 'lastname',
			'value' => '$data->lastname',
			'type'  => 'raw',
			'header'=> ucwords( Yii::t('contact','last name') ),
		),
		array(
			'name'  => 'email',
			'value' => '$data->email',
			'type'  => 'raw',
			'header'=> ucwords( Yii::t('contact','email address') ),
		),
		array(
			'name' 	=> 'created',
			'value' => 'date("M j, Y", $data->created)',
			'header'=> ucwords( Yii::t('default','created') ),
		),
		array(
			'name' 	=> 'public',
			'value' => '$data->public==0?Yii::t("default","no"):Yii::t("default","yes")',
			'header'=> ucwords( Yii::t('contact','public') ),
		),
		array(
			'class' => 'CButtonColumn',
		),
	)
	// 'itemView'=>'_view',
)); ?>
