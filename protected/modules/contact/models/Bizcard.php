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
			array('image', 'file', 'types'=>'jpg', 'allowEmpty' => true ),
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

	/**
	 *
	 */
	public function updateBizcard()
	{
		// let's make sure we have a valid model
		if( $this->id )
		{
			// let's load the original image, if exists
			$src = MEHESZ_FILE_STORAGE . $this->bizcard_orig;
			if( file_exists( $src ) )
			{
				$img_r = imagecreatefromjpeg($src);

				// getting the width and height of 
				// the original image, so we can calculate
				// the distorsion ...
				$orig_width 	= imagesx( $img_r );
				$orig_height 	= imagesy( $img_r );
				$wanted_width   = 600;
				$wanted_height 	= 450;

				$distort_width	= $orig_width / $wanted_width;
				$distort_height	= $orig_height / $wanted_height;
			
				$quality 		= 70;

				$dst_r = ImageCreateTrueColor( $wanted_width, $wanted_height );

				// so hopefully here we calculate the correct 
				// with and height and resize the image	
				imagecopyresampled( $dst_r,$img_r,0,0,$_POST['x']*$distort_width,$_POST['y']*$distort_height, $wanted_width,$wanted_height,$_POST['w']*$distort_width,$_POST['h']*$distort_height );

				// header('Content-type: image/jpeg');
				// let's write the new image into a file ...

				$randhash = 'MX' . md5( time() . rand( 0, time() ) );
				
				// if everything is all and well, we set the field also
				if( imagejpeg( $dst_r, MEHESZ_FILE_STORAGE . $randhash . '.jpg', $quality ) )
				{
					$this->bizcard = $randhash . '.jpg';
					return true;
				}
			}
		}

		return false;
	}
}
