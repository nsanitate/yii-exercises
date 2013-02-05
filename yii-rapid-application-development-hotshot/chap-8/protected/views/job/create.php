<?php
$this->breadcrumbs=array(
	'Registered Jobs'=>array('index'),
	'Create',
);

$this->menu=array(
        array('label'=>'List Registered Jobs', 'url'=>array('job/index')),
        array('label'=>'List Scheduled Jobs', 'url'=>array('scheduledJob/index')),
);
?>

<h6>Register Job</h6>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
