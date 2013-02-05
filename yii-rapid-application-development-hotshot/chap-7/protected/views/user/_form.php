 <div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($user); ?>
	<?php echo $form->errorSummary($person); ?>

        <div class="row">
                <?php echo $form->labelEx($person,'fname'); ?>
                <?php echo $form->textField($person,'fname',array('size'=>20,'maxlength'=>20)); ?>
                <?php echo $form->error($person,'fname'); ?>
        </div>

        <div class="row">
                <?php echo $form->labelEx($person,'lname'); ?>
                <?php echo $form->textField($person,'lname',array('size'=>20,'maxlength'=>20)); ?>
                <?php echo $form->error($person,'lname'); ?>
        </div>

	<div class="row">
		<?php echo $form->labelEx($user,'username'); ?>
		<?php echo $form->textField($user,'username',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($user,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($user,'email'); ?>
		<?php echo $form->textField($user,'email',array('size'=>20,'maxlength'=>128)); ?>
		<?php echo $form->error($user,'email'); ?>
	</div>

	<?php if ($isAdmin) { ?>
        <div class="row">
                <b>Assignments</b><br/>
		<ul class="roles">
		<?php foreach($user->assignments as $a) {
			echo $this->renderPartial('//includes/role_li', 
				array(
					'user' => $user,
					'assignment' => $a,
				));
		} ?>
		</ul>

                <?php echo $this->renderPartial('//includes/role_select',
                        array(
                                'user' => $user,
                        ));
                ?>
	</div>
	<?php } ?>

        <div class="row">
                <?php echo $form->labelEx($user,'password'); ?>
                <?php echo $form->passwordField($user,'password',array('size'=>20,'maxlength'=>64)); ?>
                <?php echo $form->error($user,'password'); ?>
        </div>

        <div class="row">
                <?php echo $form->labelEx($user,'password_repeat'); ?>
                <?php echo $form->passwordField($user,'password_repeat',array('size'=>20,'maxlength'=>64)); ?>
                <?php echo $form->error($user,'password_repeat'); ?>
        </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($user->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
