<?php

/**
 *
 *
 */
class MController extends CController
{
	/**
	 *
	 */
	public $breadcrumbs;
	
	/**
	 *
	 */
	public $domain;

	/**
	 *
	 */
	public function init()
	{
		// if the current domain name is localhost
		// we most likely accessing the stuff from 
		// the command line (PHP CLI) so we just
		// simply return
		if( $_SERVER['SERVER_NAME'] == 'localhost' )
		{
			return;
		}

		// let's check if the current domain is OK
		$domain = Domain::model()->loadDomain( $_SERVER['SERVER_NAME'] );

		if( ! $domain )
		{
			throw new CHttpException( 500, 'This domain is not set properly: ' . $_SERVER['SERVER_NAME'] );
		}

		// if we have the domain, we can load the default settings
		$domain->loadSettings();

		$this->domain = $domain;
		// Yii::app()->config->load(); //it loads all data stored in DB, look dbparam for doc
        // Yii::app()->theme = 'aaa';//Yii::app()->config->theme; // overwrite default "theme" value, stored in config/main.php
        // Yii::app()->name = Yii::app()->config->name;		
	}
}
