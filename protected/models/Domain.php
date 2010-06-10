<?php

class Domain extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'domains':
	 * @var integer $id
	 * @var string $domain
	 * @var integer $active
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return Domain the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'domains';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('domain, active', 'required'),
			array('active', 'numerical', 'integerOnly'=>true),
			array('domain', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, domain, active', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'modules' => array( self::MANY_MANY, 'Module',
				'domain_modules(domainID,moduleID)',
				'condition' => 'status=1',
			),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'domain' => 'Domain',
			'active' => 'Active',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);

		$criteria->compare('domain',$this->domain,true);

		$criteria->compare('active',$this->active);

		return new CActiveDataProvider('Domain', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 *
	 *
	 */
	public function loadDomain( $domain )
	{
		return $this->find( 'domain="'.$domain.'" AND active="1"' );
	}

	public function loadSettings( $domain = null )
	{
		if( ! $domain )
		{
			$domain = $this;
		}

		Yii::trace( 'loading setting for domain: ' . $domain->domain );
		// first thing first, we assign the domain name and ID
		Yii::app()->params->domain 		= $domain->domain;
		Yii::app()->params->domainid 	= $domain->id;

		$settings = DomainSetting::model()->findAll( 'domainID="' . $domain->id . '"' );
		
		if( sizeof( $settings ) )
		{
			foreach( $settings as $setting )
			{
				$name 	= $setting->name;
				$value 	= $setting->value;

				// so let's assign this setting
				// to Yii master itself
				Yii::app()->params->$name = $value;

				// this is a little redundant, because the
				// way Yii is handeling themes, but we need
				// to set the theme a little differently
				// and the same way the language of the site
				if( $name == 'theme' )
				{
					Yii::app()->theme = $value;
				}

				if( $name == 'language' )
				{
					Yii::app()->language = $value;
				}
			}
		}
	}

	/**
	 * @param $moduleName (string)
	 * 
	 * TODO implement the date frame feature, when a certain
	 * module would be only available in a specific time frame
	 * for the domai ...
	 * 
	 * @return boolean
	 */
	public function hasModule( $moduleName )
	{
		foreach( $this->modules as $module )
		{
			if( $module->name == $moduleName )
			{
				return true;
			}
		}
		
		return false;
	}
}
