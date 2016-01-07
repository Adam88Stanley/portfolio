<?php
namespace Lib;
class EmailVal extends A_validator {
	
	private $message;
	 
	public function __construct($message) {
		$this->message = $message;
	}
	
	
	
	public function validate($data) {
		
		if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
			
			$this->error=$this->message;
			
			return false;
		}
		
		return true;
		
	}
	
	
}