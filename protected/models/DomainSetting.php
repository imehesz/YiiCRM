<?php

class DomainSetting extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'domain_settings':
	 * @var integer $id
	 * @var integer $domainID
	 * @var string $name
	 * @var string $value
	 * @var integer $created
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return DomainSetting the static model class
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
		return 'domain_settings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('domainID, name, value, created', 'required'),
			array('domainID, created', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, domainID, name, value, created', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'domainID' => 'Domain',
			'name' => 'Name',
			'value' => 'Value',
			'created' => 'Created',
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

		$criteria->compare('domainID',$this->domainID);

		$criteria->compare('name',$this->name,true);

		$criteria->compare('value',$this->value,true);

		$criteria->compare('created',$this->created);

		return new CActiveDataProvider('DomainSetting', array(
			'criteria'=>$criteria,
		));
	}
}