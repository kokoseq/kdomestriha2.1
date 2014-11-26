<?php
class InputSanitizer extends CApplicationComponent {
	
	public static function Sanitize($input){
		
		$p = new CHtmlPurifier();

		$input = $p->purify($input); //ocisteni od scriptu atd
		$input = strip_tags($input); //ocisteni od html

		
		return $input;
	}
	
	
	/**
	 * Procisti vsechny zvolene atributy predaneho modelu
	 * 
	 * @param jakykoliv $model
	 * @param array $attributes
	 * @return $model
	 */
	public static function SanitizeModel($model, array $attributes)
	{
		foreach($attributes as $attribute)
			if($model->hasAttribute($attribute))
				$model->$attribute = self::Sanitize($model->$attribute);
		
		return $model;
	}
	
	/**
	 * Procisti vsechny zvolene webove atributy predaneho modelu
	 *
	 * @param jakykoliv $model
	 * @param array $attributes
	 * @return $model
	 */
	public static function SanitizeModelWebsites($model, array $attributes)
	{
		foreach($attributes as $attribute)
			if($model->hasAttribute($attribute))
			{
				$this->$attribute = self::Sanitize($this->$attribute);
				$this->$attribute = str_replace("http://", "", $this->$attribute);
				if(strpos($this->$attribute, 'www') === false)
					$this->$attribute = 'www.'.$this->$attribute;
			}
	
			return $model;
	}
	
}