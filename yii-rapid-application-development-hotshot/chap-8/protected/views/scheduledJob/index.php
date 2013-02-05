<?php
$this->breadcrumbs=array(
	'Scheduled Jobs'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Schedule Job', 'url'=>array('create')),
	array('label'=>'List Registered Jobs', 'url'=>array('job/index')),
	array('label'=>'Register Job', 'url'=>array('job/create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('scheduled-job-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Scheduled Jobs</h1>

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
	'id'=>'scheduled-job-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array (
			'name' => 'job_name',
			'header' => 'Job', 
			'value' => '$data->job->name',
		),
		'scheduled_time',
		'started',
		'completed',
		array (
			'class'=>'CCheckBoxColumn',
			'id' => 'active',
			'header' => 'Active', 
			'checked' => '$data->active',
			'selectableRows' => 0,
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
