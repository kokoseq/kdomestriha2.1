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
		
		if ($this->hasAttribute($createAttr)) 
			$behavior['CTimestampBehavior']['createAttribute'] = $createAttr;
		
		if ($this->hasAttribute($updateAttr))
		{
			$behavior['CTimestampBehavior']['updateAttribute'] = $updateAttr;
			$behavior['CTimestampBehavior']['setUpdateOnCreate'] = true;
		}
		
		return $behavior;
	}
	
}