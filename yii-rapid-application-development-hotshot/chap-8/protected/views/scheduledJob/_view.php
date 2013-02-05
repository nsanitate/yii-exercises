<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('params')); ?>:</b>
	<?php echo CHtml::encode($data->params); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('output')); ?>:</b>
	<?php echo CHtml::encode($data->output); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('job_id')); ?>:</b>
	<?php echo CHtml::encode($data->job_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('scheduled_time')); ?>:</b>
	<?php echo CHtml::encode($data->scheduled_time); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('started')); ?>:</b>
	<?php echo CHtml::encode($data->started); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('completed')); ?>:</b>
	<?php echo CHtml::encode($data->completed); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
	<?php echo CHtml::encode($data->active); ?>
	<br />

	*/ ?>

</div>
