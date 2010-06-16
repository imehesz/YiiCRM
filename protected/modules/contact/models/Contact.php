<?php

/**
 * This is the model class for table "contacts".
 */
class Contact extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'contacts':
	 * @var integer $id
	 * @var integer $userID
	 * @var integer $domainID
	 * @var integer $public
	 * @var string $firstname
	 * @var string $lastname
	 * @var string $email
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return Contact the static model class
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
		return 'contacts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userID, domainID, public, firstname, lastname, email', 'required'),
			array('userID, domainID, public', 'numerical', 'integerOnly'=>true),
			array('firstname, lastname, email', 'length', 'max'=>240),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, userID, domainID, public, firstname, lastname, email', 'safe', 'on'=>'search'),
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
			'domain' => array(self::BELONGS_TO, 'Domains', 'domainID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'userID' => 'User',
			'domainID' => 'Domain',
			'public' => 'Public',
			'firstname' => 'Firstname',
			'lastname' => 'Lastname',
			'email' => 'Email',
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

		$criteria->compare('userID',$this->userID);

		$criteria->compare('domainID',$this->domainID);

		$criteria->compare('public',$this->public);

		$criteria->compare('firstname',$this->firstname,true);

		$criteria->compare('lastname',$this->lastname,true);

		$criteria->compare('email',$this->email,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}