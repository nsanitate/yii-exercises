<?php
$this->breadcrumbs=array(
	'Scheduled Jobs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ScheduledJob', 'url'=>array('index')),
	array('label'=>'Create ScheduledJob', 'url'=>array('create')),
	array('label'=>'View ScheduledJob', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Update ScheduledJob <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
