<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Comic Book DB',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
                'application.modules.srbac.controllers.SBaseController',
		'application.modules.auditTrail.models.AuditTrail',
		'ext.quickdlgs.*',
		'ext.timepicker.*',
		'ext.EFlot.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'yiibook',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
                'srbac' => array(
                        'userclass'=>'User', //default: User
                        'userid'=>'id', //default: userid
                        'username'=>'username', //default:username
                        'delimeter'=>'@', //default:-
                        //'debug'=>true, //default :false
                        'pageSize'=>10, // default : 15
                        'superUser' =>'Authority', //default: Authorizer
                        'css'=>'srbac.css', //default: srbac.css
                        'layout'=>
                        'application.views.layouts.main', 
                        'notAuthorizedView'=> 'application.views.srbac.access_denied', 
                        'alwaysAllowed'=>array( 'SiteLogin','SiteLogout','SiteIndex', 'SiteError'),
                        'userActions'=>array('Show','View','List'), 
                        'listBoxNumberOfLines' => 15, //default : 10
                        'imagesPath' => 'srbac.images', // default: srbac.images
                        'imagesPack'=>'noia', //default: noia
                        'iconText'=>true, // default : false
                        'header'=>'srbac.views.authitem.header', 
                        'footer'=>'srbac.views.authitem.footer', 
                        'showHeader'=>true, // default: false
                        'showFooter'=>true, // default: false
                        'alwaysAllowedPath'=>'srbac.components', 
                ),
        	'auditTrail'=>array(),
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'authManager' => array(
                        'class' => 'application.modules.srbac.components.SDbAuthManager',
                        'connectionID' => 'db',
                        'assignmentTable' => 'auth_assignment',
                        'itemTable' => 'auth_item',
                        'itemChildTable' => 'auth_item_child',
		),
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),

                /*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
                 */		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=cbdb',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					//'levels'=>'trace, error, warning',
					'levels'=>'error, warning',
				),
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'info, error, warning', 
					'logFile'=>'job.log',
					'categories'=>'jobprocessor',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);
