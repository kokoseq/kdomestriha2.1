<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property integer $id
 * @property string $fb_id
 * @property string $password
 * @property string $email
 * @property string $nickname
 * @property integer $gender
 * @property string $reg_date
 * @property integer $auth_level
 * @property string $resetKey
 *
 * The followings are the available model relations:
 * @property Salon[] $createdSalons
 * @property Salon[] $ownedSalons
 * @property SalonRating[] $salonRatings
 */
class User extends CActiveRecord
{
	const AUTH_LEVEL_ADMIN = 0;
	const AUTH_LEVEL_HAIRDRESSER = 1;
	const AUTH_LEVEL_USER = 2;
	
	const GENDER_MALE = 0;
	const GENDER_FEMALE = 1;
	
	const NICKNAME_MIN_LENGTH = 3;
	const NICKNAME_MAX_LENGTH = 15;
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('nickname', 'length', 'max'=> self::NICKNAME_MAX_LENGTH, 
					'min' => self::NICKNAME_MIN_LENGTH, 
					'tooShort' => 'Špatná přezdívka, délka musí být minimálně ' . self::NICKNAME_MIN_LENGTH . ' znaky', 
					'tooLong' => 'Špatná přezdívka, délka může být maximálně ' . self::NICKNAME_MAX_LENGTH . ' znaků'),
			array('nickname', 'match', 'pattern' => '/^[A-Za-z0-9_ěščřžýáíéůúĚŠČŘŽÝÁÍÉÚŮťŤóÓ]+$/u',
					'message' => 'Povoleny jsou pouze písmena a číslice'),
			array('email', 'length', 'max'=>45, 
					'tooLong' => 'Maximální délka emailu je 45 znaků'),
			array('email', 'email', 'message' => 'Zadaný text není emailová adresa'),
			array('gender, auth_level', 'numerical', 'integerOnly'=>true),
			array('password', 'length', 'max'=>15, 'min' => 4,
					'tooShort' => 'Délka hesla musí být minimálně 4 znaky',
					'tooLong' => 'Délka hesla může být maximálně 15 znaků'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fb_id, password, email, nickname, gender, reg_date, auth_level', 'safe', 'on'=>'search'),
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
			'createdSalons' => array(self::HAS_MANY, 'Salon', 'create_user_id'),
			'ownedSalons' => array(self::HAS_MANY, 'Salon', 'owner_user_id'),
			'salonRatings' => array(self::HAS_MANY, 'SalonRating', 'create_user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fb_id' => 'Fb',
			'password' => 'Heslo',
			'email' => 'Email',
			'nickname' => 'Přezdívka',
			'gender' => 'Gender',
			'reg_date' => 'Reg Date',
			'auth_level' => 'Auth Level',
			'password_repeate' => 'Ověření hesla',
		);
	}
	
	/**
	 * Overuje spravnost hesla
	 * 
	 * @param $password heslo zadane uzivatelem
	 * @return boolean 0 pokud je heslo spatne, 1 pokud spravne
	 */
	
	public function validatePassword($password){
		return $this->password === crypt($password, $this->password);
	}
	
	/**
	 * Hashuje uzivatelem zadane heslo 
	 * 
	 * @param $password heslo zadane uzivatelem
	 * @return string
	 */
	public static function hashPassword($password){
		return crypt($password, self::blowfishSalt());
	}
	
	
	/** Generuje Salt pro hash hesla 
	 * 
	 * @param number $cost
	 * @throws Exception
	 * @return string
	 */
	public function blowfishSalt($cost = 13)
	{
		if (!is_numeric($cost) || $cost < 4 || $cost > 31) {
			throw new Exception("cost parameter must be between 4 and 31");
		}
		$rand = array();
		for ($i = 0; $i < 8; $i += 1) {
			$rand[] = pack('S', mt_rand(0, 0xffff));
		}
		$rand[] = substr(microtime(), 2, 6);
		$rand = sha1(implode('', $rand), true);
		$salt = '$2a$' . str_pad((int) $cost, 2, '0', STR_PAD_RIGHT) . '$';
		$salt .= strtr(substr(base64_encode($rand), 0, 22), array('+' => '.'));
		return $salt;
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('fb_id',$this->fb_id,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('nickname',$this->nickname,true);
		$criteria->compare('gender',$this->gender);
		$criteria->compare('reg_date',$this->reg_date,true);
		$criteria->compare('auth_level',$this->auth_level);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
