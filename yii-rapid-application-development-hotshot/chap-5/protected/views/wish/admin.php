<?php
$this->breadcrumbs=array(
	'Wishes'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Wish', 'url'=>array('index')),
	array('label'=>'Create Wish', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('wish-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Wishes</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'wish-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'title',
		'issue_number',
		'type_id',
		'publication_date',
		'store_link',
		/*
		'notes',
		'got_it',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
