<?php
$this->breadcrumbs=array(
	'Grades'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Grade', 'url'=>array('index')),
	array('label'=>'Create Grade', 'url'=>array('create')),
	array('label'=>'View Grade', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Grade', 'url'=>array('admin')),
);
?>

<h1>Update Grade <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>