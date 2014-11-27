<?php
abstract class ExtendedActiveRecord extends CActiveRecord 
{
	private $createAttr = 'create_time';
	private $updateAttr = 'update_time';
	private $createUserAttr = 'create_user_id';
	
	
	/* Pokud je uzivatel prihlaseny a uklada se novy zaznam, nastavi se
	 * create_user_id
	 * @see CActiveRecord::beforeSave()
	 */
	protected function beforeSave(){
		if(!Yii::app()->user->isGuest && $this->hasAttribute($this->createUserAttr) && $this->isNewRecord)
			$this->setAttribute($this->createUserAttr, Yii::app()->user->id);
		
		return parent::beforeSave();
	}
	
	/* Pokud ma model atribut create_time nebo update_time,
	 * automaticky se budou pred ulozenim nastavovat na aktualni datetime
	 */
	public function behaviors(){
		$behavior = array
		(
				'CTimestampBehavior' => array(
						'class' => 'zii.behaviors.CTimestampBehavior',
					)
		);
		
		if ($this->hasAttribute($this->createAttr)) 
			$behavior['CTimestampBehavior']['createAttribute'] = $this->createAttr;
		
		if ($this->hasAttribute($this->updateAttr))
		{
			$behavior['CTimestampBehavior']['updateAttribute'] = $this->updateAttr;
			$behavior['CTimestampBehavior']['setUpdateOnCreate'] = true;
		}		
		
		return $behavior;
	}
	
}