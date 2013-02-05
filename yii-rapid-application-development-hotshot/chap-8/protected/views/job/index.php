<?php
$this->breadcrumbs=array(
        'Registered Jobs',
);

$this->menu=array(
	array('label'=>'List Scheduled Jobs', 'url'=>array('scheduledJob/index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('job-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Jobs</h1>

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


<div class="right">
<?php 
EQuickDlgs::iframeButton(
    array(
        'controllerRoute' => 'create',
        'dialogTitle' => 'Create item',
        'dialogWidth' => 580,
        'dialogHeight' => 275,
        'openButtonText' => 'Register New Job',
        'closeButtonText' => 'Close',
        'closeOnAction' => true, //important to invoke the close action in the actionCreate
        'refreshGridId' => 'job-grid', //the grid with this id will be refreshed after closing
    )
);
?>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'job-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'name',
		'action',
		array(
			'class'=>'EJuiDlgsColumn',
			'updateDialog'=>array(
				'dialogWidth' => 580,
				'dialogHeight' => 250,
			),
			'viewDialog'=>array(
				'dialogWidth' => 580,
				'dialogHeight' => 250,
			),
		),
	),
)); ?>
