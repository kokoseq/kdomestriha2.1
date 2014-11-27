<?php
class InputSanitizer extends CApplicationComponent {
	
	public static function sanitize($input){
		
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
	public static function sanitizeModel($model, array $attributes)
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
	public static function sanitizeModelWebsites($model, array $attributes)
	{
		foreach($attributes as $attribute)
			if($model->hasAttribute($attribute))
			{
				$model->$attribute = self::Sanitize($model->$attribute);
				$model->$attribute = str_replace("http://", "", $model->$attribute);
				if(strpos($model->$attribute, 'www') === false && $model->$attribute != '')
					$model->$attribute = 'www.'.$model->$attribute;
			}
	
			return $model;
	}
	
	public static function sanitizeName($name){
		
		$forbidden = array('kadernik', 'kadernice',
				'kadernictvi', 'kadeřník', 'kadeřnice', 'kadeřnictví',
				'kadeřnické', 'kadernicke', 'kadeřnický', 'kadernicky');
		
		foreach($forbidden as $f){
			$name = str_ireplace($f, '', $name);
		}
		return ucfirst(trim($name));
	}
	
}