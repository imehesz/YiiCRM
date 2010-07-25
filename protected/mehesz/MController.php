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

		// so by default, at this point we will check if there is a CSS or JS
		// file, that named as the domain so we can add it to the page

		if( isset( $this->module ) )
		{
				$module_path = Yii::getPathOfAlias( 'application.modules.' . $this->module->name );

				$cssfile 	= $module_path . '/css/' . $this->module->name . '.css';
				$jsfile 	= $module_path . '/js/' . $this->module->name . '.js'; 

				if( file_exists( $cssfile ) )
				{
					$asset_css = Yii::app()->getAssetManager()->publish($cssfile);
					$cs = Yii::app()->getClientScript();
					$cs->registerCssFile( $asset_css );
				}

				if( file_exists( $jsfile ) )
				{
					$asset_js = Yii::app()->getAssetManager()->publish( $jsfile );
					if( ! isset( $cs ) )
					{
						$cs = Yii::app()->getClientScript();
					}
					$cs->registerScriptFile( $asset_js );
				}
		}
	}
}
