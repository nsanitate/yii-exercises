<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('issue_number')); ?>:</b>
        <?php echo CHtml::encode($data->issue_number); ?>
        <br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type_id')); ?>:</b>
	<?php echo CHtml::encode($data->type->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('publication_date')); ?>:</b>
	<?php echo CHtml::encode($data->publication_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('value')); ?>:</b>
	<?php echo CHtml::encode($data->value); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo CHtml::encode($data->price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notes')); ?>:</b>
	<?php echo CHtml::encode($data->notes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lendable')); ?>:</b>
	<?php echo CHtml::encode($data->lendable ? 'yes' : 'no'); ?>
	<br />

	<?php 
		echo "<b>" . 
			CHtml::encode($data->getAttributeLabel('borrower')) . 
			":</b>"; 
		BookController::set_fullname($data);
		echo CHtml::encode($data->borrower_fullname);
	?>
	<br />

	<?php
		if ($data->requesters && $isAdmin) { 
			echo "<b>Requests</b><br/>\n";
			echo "<ul>\n";
			foreach ($data->requesters as $r) {
				echo "<li>" . CHtml::encode($r->person->fname . 
					' ' . $r->person->lname) . 
					"&nbsp;<a href=\"" . 
					Yii::app()->createUrl("library/lend", 
						array("book_id" => $data->id, 
						"user_id" => $r->id)) . 
					"\">Lend</a>" . 
					"</li>";
			}
			echo "</ul>\n";
		}
	?>

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('signed')); ?>:</b>
	<?php echo CHtml::encode($data->signed); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('grade_id')); ?>:</b>
	<?php echo CHtml::encode($data->grade_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bagged')); ?>:</b>
	<?php echo CHtml::encode($data->bagged); ?>
	<br />

	*/ ?>

</div>
