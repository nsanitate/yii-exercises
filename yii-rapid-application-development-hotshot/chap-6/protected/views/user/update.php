<?php
Yii::app()->getClientScript()->registerCoreScript( 'jquery.ui' );
Yii::app()->clientScript->registerScriptFile(
        Yii::app()->request->baseUrl . '/js/user_form_ajax.js'
);

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'View User', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<h1>Update User <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array(
	'user'=>$model, 
	'person' => $model->person,
	'isAdmin' => $isAdmin,
)); ?>
