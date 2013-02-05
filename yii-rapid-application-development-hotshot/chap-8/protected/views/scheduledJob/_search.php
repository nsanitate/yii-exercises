<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'params'); ?>
		<?php echo $form->textArea($model,'params',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'output'); ?>
		<?php echo $form->textArea($model,'output',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'job_id'); ?>
		<?php echo $form->textField($model,'job_id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'scheduled_time'); ?>
		<?php echo $form->textField($model,'scheduled_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'started'); ?>
		<?php echo $form->textField($model,'started'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'completed'); ?>
		<?php echo $form->textField($model,'completed'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'active'); ?>
		<?php echo $form->textField($model,'active'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
