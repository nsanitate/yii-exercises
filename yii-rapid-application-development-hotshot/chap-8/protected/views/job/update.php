<?php
$this->breadcrumbs=array(
	'Registered Jobs'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Job', 'url'=>array('create')),
	array('label'=>'View Job', 'url'=>array('view', 'id'=>$model->id)),
        array('label'=>'List Registered Jobs', 'url'=>array('job/index')),
        array('label'=>'List Scheduled Jobs', 'url'=>array('scheduledJob/index')),
);
?>

<h6>Update Job <?php echo $model->id; ?></h6>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
