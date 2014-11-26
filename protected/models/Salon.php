<?php

/**
 * This is the model class for table "{{salon}}".
 *
 * The followings are the available columns in table '{{salon}}':
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property double $lat
 * @property double $lng
 * @property string $phone
 * @property string $website
 * @property string $fb_site
 * @property string $email
 * @property string $description
 * @property string $create_time
 * @property string $update_time
 * @property double $avg_rating
 * @property double $avg_sub_rating1
 * @property double $avg_sub_rating2
 * @property double $avg_sub_rating3
 * @property integer $avg_price_women
 * @property integer $avg_price_men
 * @property integer $account_level
 * @property integer $create_user_id
 * @property integer $owner_user_id
 *
 * The followings are the available model relations:
 * @property OpeningHours[] $openingHours
 * @property User $createUser
 * @property User $ownerUser
 * @property SalonPhoto[] $salonPhotos
 * @property SalonRating[] $salonRatings
 */
class Salon extends ExtendedActiveRecord
{
	const DESC_LENGTH = 300;
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{salon}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('name, address', 'required', 'message' => 'Toto pole je povinné'),
			array('name', 'length', 'max'=>40, 'tooLong'=>'Maximální délka názvu je 30 znaků'),
			array('phone, website, fb_site, email', 'length', 'max'=>45, 'tooLong'=>'Maximální délka je 45 znaků'),
			array('address', 'length', 'max'=>70, 'min'=>8,
					'tooLong'=>'Maximální délka adresy je 70 znaků',
					'tooShort'=>'Minimální délka adresy je 8 znaků'),
			array('email', 'email', 'message' => 'Zadaný text není emailová adresa'),
			array('description', 'length', 'max'=>self::DESC_LENGTH, 'tooLong'=>'Maximální délka popisu je '. self::DESC_LENGTH .' znaků'),
			array('lat', 'safe'),
			array('lng', 'safe'),
			array('avg_price_women, avg_price_men, account_level, create_user_id, owner_user_id', 'numerical', 'integerOnly'=>true),
			array('lat, lng, avg_rating, avg_sub_rating1, avg_sub_rating2, avg_sub_rating3', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, address, lat, lng, phone, website, fb_site, email, description, create_time, update_time, avg_rating, avg_sub_rating1, avg_sub_rating2, avg_sub_rating3, avg_price_women, avg_price_men, account_level, create_user_id, owner_user_id', 'safe', 'on'=>'search'),
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
			'openingHours' => array(self::HAS_MANY, 'OpeningHours', 'salon_id'),
			'createUser' => array(self::BELONGS_TO, 'User', 'create_user_id'),
			'ownerUser' => array(self::BELONGS_TO, 'User', 'owner_user_id'),
			'salonPhotos' => array(self::HAS_MANY, 'SalonPhoto', 'salon_id'),
			'salonRatings' => array(self::HAS_MANY, 'SalonRating', 'salon_id'),
		);
	}
	

	protected function beforeValidate(){
		$toSanitize = array('name', 'address', 'description');
		$toSanitizeWeb =  array('website', 'fb_site');
		
		$this->attributes = InputSanitizer::SanitizeModel($this, $toSanitize);
		$this->attributes = InputSanitizer::SanitizeModelWebsites($this, $toSanitizeWeb);
	
		return parent::beforeValidate();
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Název',
			'address' => 'Adresa',
			'lat' => 'Lat',
			'lng' => 'Lng',
			'phone' => 'Telefon',
			'website' => 'Web',
			'fb_site' => 'Facebook',
			'email' => 'Email',
			'description' => 'Popis',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
			'avg_rating' => 'Avg Rating',
			'avg_sub_rating1' => 'Avg Sub Rating1',
			'avg_sub_rating2' => 'Avg Sub Rating2',
			'avg_sub_rating3' => 'Avg Sub Rating3',
			'avg_price_women' => 'Avg Price Women',
			'avg_price_men' => 'Avg Price Men',
			'account_level' => 'Account Level',
			'create_user_id' => 'Create User',
			'owner_user_id' => 'Owner User',
		);
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('lat',$this->lat);
		$criteria->compare('lng',$this->lng);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('website',$this->website,true);
		$criteria->compare('fb_site',$this->fb_site,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('avg_rating',$this->avg_rating);
		$criteria->compare('avg_sub_rating1',$this->avg_sub_rating1);
		$criteria->compare('avg_sub_rating2',$this->avg_sub_rating2);
		$criteria->compare('avg_sub_rating3',$this->avg_sub_rating3);
		$criteria->compare('avg_price_women',$this->avg_price_women);
		$criteria->compare('avg_price_men',$this->avg_price_men);
		$criteria->compare('account_level',$this->account_level);
		$criteria->compare('create_user_id',$this->create_user_id);
		$criteria->compare('owner_user_id',$this->owner_user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Salon the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
