<?php
$this->breadcrumbs=array(
	'Grades',
);

$this->menu=array(
	array('label'=>'Create Grade', 'url'=>array('create')),
	array('label'=>'Manage Grade', 'url'=>array('admin')),
);
?>

<h1>Grades</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
