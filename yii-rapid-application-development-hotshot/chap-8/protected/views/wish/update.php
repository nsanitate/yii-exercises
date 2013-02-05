<?php
Yii::app()->clientScript->registerScriptFile(
        Yii::app()->request->baseUrl . '/js/book_form_ajax.js'
);

$this->breadcrumbs=array(
	'Wishes'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Wish', 'url'=>array('index')),
	array('label'=>'Create Wish', 'url'=>array('create')),
	array('label'=>'View Wish', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Wish', 'url'=>array('admin')),
);
?>

<h1>Update Wish <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'author' =>$author)); ?>

