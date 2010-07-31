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

	public $addbizcard;

	public $additional_questions;

	/**
	 * Returns the static model of the specified AR class.
	 * @return Contact the static model class
	 */
	public static function model($className=__CLASS__)
	{
		if( Yii::app()->controller->domain->hasModule( 'bizcard' ) )
		{
			Yii::app()->getModule('bizcard');
		}

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
		$retarr = array(
			array('userID, domainID, public, firstname, lastname, email', 'required'),
			array('addbizcard,userID, domainID, public', 'numerical', 'integerOnly'=>true),
			array('firstname, lastname, email', 'length', 'max'=>240),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('firstname, lastname, email, created', 'safe', 'on'=>'search'),
		);

/*		if( Yii::app()->controller->domain->hasModule( 'bizcard' ) )
		{
			$retarr[] = array('bizcard', 'file', 'types'=>'jpg, gif, png');
		} */

		return $retarr;
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		$retarr = array(
			'domain' 	=> array(self::BELONGS_TO, 'Domains', 'domainID'),
			'user' 		=> array(self::BELONGS_TO, 'YumUser', 'userID'),
			'answers' 	=> array(self::HAS_MANY, 'ContactAnswer', 'contactID' )
		);

		if( Yii::app()->controller->domain->hasModule( 'bizcard' ) )
		{
			$retarr['bizcards'] = array( self::HAS_MANY, 'Bizcard', 'contactID' );
		}

		return $retarr;
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
			'public' => Yii::t( 'contact', 'public' ),
			'firstname' => Yii::t( 'contact', 'first name' ),
			'lastname' => Yii::t( 'contact', 'last name' ),
			'email' => Yii::t( 'contact', 'email address' ),
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

		// $criteria->compare('id',$this->id);

		$criteria->compare('userID',$this->userID);

		$criteria->compare('domainID',$this->domainID);

		// $criteria->compare('public',$this->public);

		$criteria->compare('firstname',$this->firstname,true);

		$criteria->compare('lastname',$this->lastname,true);

		$criteria->compare('email',$this->email,true);

		$criteria->compare('domainID', Yii::app()->controller->domain->id);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

	/**
	 *
	 *
	 */
	public function idsWithNames()
	{
		$retval = array();

		foreach( $this->findAll() as $contact  )
		{
			$retval[ $contact->id ] = $contact->lastname . ', ' . $contact->firstname;
		}

		return $retval;
	}

	public function beforeValidate()
	{
		$this->domainID = Yii::app()->controller->domain->id;
		$this->userID 	= Yii::app()->user->id;

		$now = time();
		if( $this->isNewRecord )
		{
			$this->created = $now;
		}

		$this->updated = $now;
		return parent::beforeValidate();
	}

	public function afterSave()
	{
		// we have to take care of the additional 
		// fields
		if( is_array( $_POST['additional_questions'] ) )
		{
			$questions = $_POST[ 'additional_questions' ];
			foreach( $questions as $questionID => $answer )
			{
				// let's see if we have this answer already
				$contact_answer = ContactAnswer::model()->find( 'questionID=' . $questionID . ' AND contactID=' . $this->primaryKey );
				// if so, we only update ...
				if( $contact_answer )
				{
					$contact_answer->answer = $answer;
				}
				else
				{
					$contact_answer = new ContactAnswer();
					$contact_answer->setAttributes( 
						array(
							'domainID' 		=> Yii::app()->controller->domain->id,
							'contactID' 	=> $this->primaryKey,
							'questionID' 	=> $questionID,
							'answer' 		=> strip_tags( $answer ),
						)
					);
				}

				$contact_answer->save();
			}
		}

		return parent::afterSave();
	}

	public function getAnswer( $questionID )
	{
		if( $this->isNewRecord )
		{
			return null;
		}

		$answer = ContactAnswer::model()->find( 'questionID=' . $questionID . ' AND contactID=' . $this->id );

		return isset( $answer ) ? $answer->answer : null;
	}
}
