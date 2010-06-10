<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.mehesz.*',
	),

	// application components
	'components'=>array(
		
		/*'config'=>array(
			'class' 			=> 'application.extensions.dbparam.XDbParam',
			'connectionID' 		=> 'db',
			'paramsTableName' 	=> 'settings',
    	),*/

		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'viewRenderer'=>array(
  			'class'=>'ext.phamlp.Haml',
  			// delete options below in production
  			'ugly' => false,
  			'style' => 'nested',
  			'debug' => 0,
  			'cache' => false,
		),
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => MEHESZ_DB_CONNECTION_STRING,
			'emulatePrepare' => true,
			'username' => MEHESZ_DB_USER,
			'password' => MEHESZ_DB_PASSWORD,
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
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				array(
					'class'=>'CWebLogRoute',
				),
			),
		),

		// setting the language stuff over here
		'messages' => array(
			'class' => 'CDbMessageSource',
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),

	// TODO find out a better solution, maybe
	// to load the modules from the DB with
	// all the settings and stuff ...
	'modules' => array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'gii123',
			 'ipFilters'=>array('127.0.1.1'),
			// ’newFileMode’=>0666,
			// ’newDirMode’=>0777,
		),

		'default' => array(),
		'profile' => array(),
	),
);
