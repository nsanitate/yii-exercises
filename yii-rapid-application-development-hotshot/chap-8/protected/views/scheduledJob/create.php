<?php
$this->breadcrumbs=array(
	'Scheduled Jobs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ScheduledJob', 'url'=>array('index')),
);
?>

<h1>Create ScheduledJob</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
