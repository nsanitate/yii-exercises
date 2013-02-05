<?php $this->pageTitle=Yii::app()->name; ?>

<h1>Welcome to <i>My <?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<p>My 10 latest comic book purchases: 

</p>

<?php $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'book-grid',
        'dataProvider'=>$model,
        'columns'=>array(
                'id',
                'title',
                'type_id',
                'publication_date',
                'value',
                'price',
                'signed',
                'grade_id',
                'bagged',
        ),
)); ?>

