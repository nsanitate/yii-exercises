<?php
$this->breadcrumbs=array(
	'Grades'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Grade', 'url'=>array('index')),
	array('label'=>'Create Grade', 'url'=>array('create')),
	array('label'=>'Update Grade', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Grade', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Grade', 'url'=>array('admin')),
);
?>

<h1>View Grade #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
