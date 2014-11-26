<?php
abstract class ExtendedActiveRecord extends CActiveRecord 
{
	private $createAttr = 'create_time';
	private $updateAttr = 'update_time';
	
	
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