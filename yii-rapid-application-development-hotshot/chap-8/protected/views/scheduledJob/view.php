<?php
$this->breadcrumbs=array(
	'Scheduled Jobs'=>array('index'),
	$model->job->name,
);

$this->menu=array(
	array('label'=>'List ScheduledJob', 'url'=>array('index')),
	array('label'=>'Create ScheduledJob', 'url'=>array('create')),
	array('label'=>'Update ScheduledJob', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ScheduledJob', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Scheduled Job <?php echo $model->job->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
                array (
                        'name' => 'job_name',
                        'header' => 'Job',
                        'value' => $model->job->name,
                ),
		'params',
		'output',
		'scheduled_time',
		'started',
		'completed',
                array (
                        'name' => 'active',
                        'header' => 'Active',
                        'value' => $model->active ? 'true' : 'false',
                ),
	),
)); ?>

<?php 
if ($model->output != null) {
$this->widget('application.extensions.EFlot.EFlotGraphWidget', 
	json_decode($model->output, true)
);
}
?>
