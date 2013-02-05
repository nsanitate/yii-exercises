<?php
$this->breadcrumbs=array(
	'Wishes'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Wish', 'url'=>array('index')),
	array('label'=>'Create Wish', 'url'=>array('create')),
	array('label'=>'Update Wish', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Wish', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Wish', 'url'=>array('admin')),
);
?>

<h1>Wish: <?php echo $model->title; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'title',
		'issue_number',
		array(
			'name' => 'type',
			'value' => $model->type->name,
		),
		'publication_date',
		array(
			'name' => 'store link',
			'type' => "raw",
			'value' => "<a href=\"" . $model->store_link 
				. "\" target=\"_blank\">Purchase</a>",
		),
		'notes',
		'got_it',
	),
)); ?>
