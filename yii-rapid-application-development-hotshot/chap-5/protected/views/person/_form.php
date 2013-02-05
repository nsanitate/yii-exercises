<div class="ajax-form">
	<div class="row">
		<?php echo CHtml::activeLabel($model,'fname'); ?>
		<?php echo CHtml::activeTextField($model,'fname',array('size'=>32,'maxlength'=>64)); ?>
		<?php echo CHtml::activeLabel($model,'lname'); ?>
		<?php echo CHtml::activeTextField($model,'lname',array('size'=>32,'maxlength'=>64)); ?>
	</div>
</div><!-- form -->
