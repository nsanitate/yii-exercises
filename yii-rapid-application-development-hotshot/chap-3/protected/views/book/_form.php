<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'book-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

      <div class="row">
                <?php echo $form->labelEx($model,'issue_number'); ?>
                <?php echo $form->textField($model,'issue_number',array('size'=>20,'maxlength'=>10)); ?>
                <?php echo $form->error($model,'issue_number'); ?>
      </div>

        <div class="row">
                <?php echo $form->labelEx($model,'author'); ?>
                <?php if(Yii::app()->user->hasFlash('authorAdded')) { ?>
                        <div class="flash-success">
                                <?php echo Yii::app()->user->getFlash('authorAdded'); ?>
                        </div>
                <?php } else {
                        echo $this->renderPartial('/person/_form', array(
                                        'model' => $author,
                                        'subform' => 1
                                ));
                        if (Yii::app()->controller->action->id != 'create') {
                ?>
                                <div class="row buttons">
                                <input class="add" type="button" 
                                        obj="Person" 
                                        url="<?php
                                        echo Yii::app()->controller->createUrl(
                                                "createAuthor",
                                                array("id"=>$model->id)); ?>"
                                        value="Add"/>
                                </div>
                        <?php }

                      } ?>
                <?php
                        echo "<ul class=\"authors\">";
                        foreach ($model->authors as $auth) {
                                echo $this->renderPartial('//includes/_li', array(
                                                'model' => $model,
                                                'author' => $auth,
                                        ));
                        }
                        echo "</ul>";
                ?>
      </div>

      <div class="row">

		<?php echo $form->labelEx($model,'type_id'); ?>
                <?php echo $form->dropDownList($model, 'type_id', Type::model()->getTypeOptions()); ?>
		<?php echo $form->error($model,'type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'publication_date'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'name' => 'publication_date',
				'attribute' => 'publication_date',
				'model'=>$model,
				'options'=> array(
					'dateFormat' =>'yy-mm-dd',
					'altFormat' =>'yy-mm-dd',
				),
			)); 
		?>
		<?php echo $form->error($model,'publication_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'value'); ?>
		<?php echo $form->textField($model,'value',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'value'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notes'); ?>
		<?php echo $form->textArea($model,'notes',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'notes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'signed'); ?>
                <?php echo $form->checkbox($model, 'signed'); ?>
		<?php echo $form->error($model,'signed'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'grade_id'); ?>
                <?php echo $form->dropDownList($model, 'grade_id', Grade::model()->getGradeOptions()); ?>
		<?php echo $form->error($model,'grade_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bagged'); ?>
		<?php echo $form->checkbox($model, 'bagged'); ?>
		<?php echo $form->error($model,'bagged'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
