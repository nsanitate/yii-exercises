<?php if(Yii::app()->user->hasFlash('success')) { ?>
<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('success'); ?>
</div>
<?php } ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'book-grid',
        'dataProvider'=>$dataProvider,
        'columns'=>array(
                'title',
                'issue_number',
		array(
			'name' => 'Type', 
			'header' => 'Type', 
			'value' => '$data->type->name',
		),
		array(
			'name' => 'Publisher', 
			'header' => 'Publisher', 
			'value' => '(($data->publisher!=null) ? $data->publisher->name : \'\')',
		),
		array(
			'name' => 'Authors', 
			'header' => 'Authors', 
			'value' => array($dataProvider->model, 'author_list'),
		),
                'publication_date',
		array(
			'name' => 'Status', 
			'header' => 'Status', 
			'value' => array($dataProvider->model, 'get_status'),
		),
		array (
    			'class'=>'CButtonColumn',
        		'template'=>'{request}',
			'buttons' => array(
				'request' => array(
					'label' => 'Request', 
					'imageUrl' => Yii::app()->baseUrl . '/images/request_lozenge.png', 
					'url' => 'Yii::app()->createUrl("library/request", array("id"=>$data->id))',
					'visible' => array($dataProvider->model, 'requested'),
				),
			),
		),
        ),
)); ?>

