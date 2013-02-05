<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
	<?php 
		$this->widget('application.components.YiiSmartMenu',array(
			'activeCssClass' => 'active',
			'activateParents' => true,
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index'), 'visible' => true),
				array(
					'label'=>'Comic Books', 
					'url'=>array('/book/index'),
					'items' => array(
						array('label'=>'Publishers', 'url'=>array('/publisher/index')),
						array('label'=>'WishList', 'url'=>array('/wish/index')),
						array('label'=>'Library', 'url'=>array('/library/index')),
					),
					'authItemName' => 'WishlistAccess',
				),
                                array(
                                        'label'=>'Admin',  
                                        'url' => '', 
                                        'items' => array(
                                                array('label'=>'Srbac', 'url'=>array('/srbac'), 'authItemName' => 'Authority'),
                                                array('label'=>'AuditTrail', 'url'=>array('/auditTrail/admin'), 'authItemName' => 'Authority'),
                                                array('label'=>'Users', 'url'=>array('/user/index')),
						array('label'=>'Jobs', 'url'=>array('/scheduledJob/index'), 'authItemName' => 'Authority'),
                                            	array('label'=>'Reports', 'url'=>array('/report/index')), 

                                        ),
					'visible' => Yii::app()->user->checkAccess('UserIndex') || Yii::app()->user->checkAccess('Authority') || Yii::app()->user->checkAccess('ReportIndex') || Yii::app()->user->checkAccess('JobIndex') ,
                                ),   
				array(
					'label'=>'Edit Profile', 
					'url'=>$this->createUrl('/user/update', 
						array('id'=>Yii::app()->user->getId())), 
					'authItemName' => 'UpdateOwnUser',
					'authParams' => 
						array('id'=>Yii::app()->user->getId()), 
				),
                		array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
			),
		));                     
	?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
