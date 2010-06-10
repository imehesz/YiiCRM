<?php
	/**
	 * 	this is the defaul WebModule which all the other webmodules
	 *  will 
	 */
	class MWebModule extends CWebModule
	{
		/**
		 *
		 */
		public $name;

		/**
		 *
		 */
		public function init()
		{
			if( ! $this->name )
			{
				throw new CHttpException( '', 'Module name is not set properly.' );
			}

			parent::init();
		}

		/**
		 *
		 */
		public function beforeControllerAction( $controller, $action )
		{
			if( parent::beforeControllerAction( $controller, $action ) )
			{
				// var_dump( $controller->domain->modules );
			    if( $controller->domain->hasModule( $this->name ) )	
				{
					return true;
				}
			}

			throw new CHttpException( 500, 'Sorry, this module is not enabled for you.' );
		}
	}
