<?php
$this->breadcrumbs=array(
	'Message'=>array('message/index'),
	'HelloWorld',
);?>
<h1>Hello, World!</h1>
<h3><?php echo $time; ?></h3>
<p><?php echo CHtml::link("Goodbye",array('message/goodbye')); ?></p>     
