<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('domainID')); ?>:</b>
	<?php echo CHtml::encode($data->domainID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('userID')); ?>:</b>
	<?php echo CHtml::encode($data->userID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contactID')); ?>:</b>
	<?php echo CHtml::encode($data->contactID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bizcard')); ?>:</b>
	<?php echo CHtml::encode($data->bizcard); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bizcard_orig')); ?>:</b>
	<?php echo CHtml::encode($data->bizcard_orig); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />


</div>