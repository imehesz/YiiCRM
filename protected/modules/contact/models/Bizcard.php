<?php

/**
 * This is the model class for table "bizcards".
 *
 * The followings are the available columns in table 'bizcards':
 * @property integer $id
 * @property integer $domainID
 * @property integer $userID
 * @property integer $contactID
 * @property string $bizcard
 * @property string $bizcard_orig
 * @property integer $created
 */
class Bizcard extends CActiveRecord
{
	public $image;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Bizcard the static model class
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
		return 'bizcards';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('image', 'file', 'types'=>'jpg, gif, png'),
			array('domainID, userID, contactID', 'required'),
			array('domainID, userID, contactID, created', 'numerical', 'integerOnly'=>true),
			array('bizcard, bizcard_orig', 'length', 'max'=>240),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, domainID, userID, contactID, bizcard, bizcard_orig, created', 'safe', 'on'=>'search'),
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
			'contact' 		=> array(self::BELONGS_TO, 'Contact', 'contactID'),
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
			'userID' => 'User',
			'contactID' => 'Contact',
			'bizcard' => 'Bizcard',
			'bizcard_orig' => 'Bizcard Orig',
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

		$criteria->compare('userID',$this->userID);

		$criteria->compare('contactID',$this->contactID);

		$criteria->compare('bizcard',$this->bizcard,true);

		$criteria->compare('bizcard_orig',$this->bizcard_orig,true);

		$criteria->compare('created',$this->created);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

	public function beforeValidate()
	{
		$this->domainID = Yii::app()->controller->domain->id;
		$this->userID 	= Yii::app()->user->id;
		$this->created 	= time();
		$this->image 	= CUploadedFile::getInstance( $this, 'image' );

		if( $this->image )
		{
			$randhash = 'MX' . md5( time() . rand( 0, time() ) );
			$this->image->saveAs( MEHESZ_FILE_STORAGE . $randhash . '.jpg' );

			$this->bizcard_orig = $randhash . '.jpg';
			$this->bizcard = $this->bizcard_orig;
		}

		return parent::beforeValidate();
	}

	public function afterValidate()
	{
		if( sizeof( $this->errors ) == 0 )
		{
			// take care of the images
		}

		return parent::afterValidate();
	}
}
