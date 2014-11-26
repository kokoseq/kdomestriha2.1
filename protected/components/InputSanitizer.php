<?php
class InputSanitizer extends CApplicationComponent {
	
	public static function Sanitize($input){
		
		$p = new CHtmlPurifier();

		$input = $p->purify($input); //ocisteni od scriptu atd
		$input = strip_tags($input); //ocisteni od html

		
		return $input;
	}
	
}