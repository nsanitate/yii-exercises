<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $id
 * @property string $username
 * @property string $email
 * @property string $pwd_hash
 * @property string $person_id
 *
 * The followings are the available model relations:
 * @property Person $person
 * @property Assignments[] $assignments
 */
class User extends CActiveRecord
{
	public $password;
	public $password_repeat;
	public $person_fname;
	public $person_lname;
	public $role;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username', 'required'),
			array('username', 'unique'),
			array('password, password_repeat', 'required', 'on' => 'passwordset'),
			array('username', 'length', 'min' => 3, 'max'=>20),
			array('email', 'length', 'min' => 3, 'max'=>128),
			array('password', 'length', 'min' => 8, 'max'=>32, 'on' => 'passwordset'),
			array('password', 'compare', 'compareAttribute' => 'password_repeat'),
			array('password', 'passwordStrengthOk', 'on' => 'passwordset'),
			array('username, email, password, password_repeat', 'safe'),
			array('username, email, person_fname, person_lname', 'safe', 'on'=>'search'),
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
			'person' => array(self::BELONGS_TO, 'Person', 'person_id'),
			'assignments' => array(self::HAS_MANY, 'Assignments', 'userid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'email' => 'Email Address',
			'password' => 'Password',
			'password_repeat' => 'Password Repeat'
			//'pwd_hash' => 'Pwd Hash',
			//'person_id' => 'Person',
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

		//$criteria->compare('t.id',$this->id,true);
		//$criteria->compare('pwd_hash',$this->pwd_hash,true);
		//$criteria->compare('person_id',$this->person_id,true);
		$criteria->compare('t.username',$this->username,true);
		$criteria->compare('person.fname',$this->person_fname,true);
		$criteria->compare('person.lname',$this->person_lname,true);

		$criteria->with = array('person');

		$sort = new CSort;
		$sort->attributes = array(
			'person_fname' => array(
				'asc' => 'person.fname', 
				'desc' => 'person.fname DESC',
			),
			'person_lname' => array(
				'asc' => 'person.lname', 
				'desc' => 'person.lname DESC',
			),
			'*',
		);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort' => $sort,
		));
	}

	public function hash($value)
 	{
 		return crypt($value);
 	}

	protected function afterValidate()
 	{
 		parent::afterValidate();
 		$this->pwd_hash = $this->hash($this->password);
 	}

	public function check($value)
 	{
		$new_hash = crypt($value, $this->pwd_hash);
		if ($new_hash == $this->pwd_hash) {
			return 1;
		}
		return 0;
 	}

	public function passwordStrengthOk($attribute, $params)
	{
		// default to true
		$valid = true;

		// at least one number
		$valid = $valid && preg_match('/.*[\d].*/', $this->$attribute); 

		// at least one non-word character
		$valid = $valid && preg_match('/.*[\W].*/', $this->$attribute);

		// at least one capital letter
		$valid = $valid && preg_match('/.*[A-Z].*/', $this->$attribute);

		if (!$valid) 
			$this->addError($attribute, "Does not meet password requirements.");

		return $valid;
	}

	public function getUnassignedRoles()
	{
	    return(Helper::getUserNotAssignedRoles($this->id));
	}

	public function behaviors() 
	{ 
		return array( 'LoggableBehavior'=> 'application.modules.auditTrail.behaviors.LoggableBehavior', ); 
	}

        public function scopes()
        {
                return array(
                        'not_admin' => array(
                                'condition' => "username!='admin'",
                        ),
                );
        }
}
