<?php

/**
 * This is the model class for table "contact_questions".
 *
 * The followings are the available columns in table 'contact_questions':
 * @property integer $id
 * @property integer $domainID
 * @property string $question
 * @property string $settings
 */
class ContactQuestion extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ContactQuestion the static model class
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
		return 'contact_questions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('domainID, question, settings', 'required'),
			array('domainID', 'numerical', 'integerOnly'=>true),
			array('question', 'length', 'max'=>240),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, domainID, question, settings', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'domainID' => 'Domain',
			'question' => 'Question',
			'settings' => 'Settings',
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

		$criteria->compare('question',$this->question,true);

		$criteria->compare('settings',$this->settings,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}