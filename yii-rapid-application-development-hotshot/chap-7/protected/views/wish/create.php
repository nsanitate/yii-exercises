<?php
Yii::app()->clientScript->registerScriptFile(
        Yii::app()->request->baseUrl . '/js/book_form_ajax.js'
);

$this->breadcrumbs=array(
	'Wishes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Wish', 'url'=>array('index')),
	array('label'=>'Manage Wish', 'url'=>array('admin')),
);
?>

<h1>Create Wish</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'author'=>$author)); ?>

