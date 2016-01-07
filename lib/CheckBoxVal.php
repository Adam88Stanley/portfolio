<?php
namespace Lib;
class CheckBoxVal extends A_validator {
	
	private $message;
	 
	public function __construct($message) {
		$this->message = $message;
	}
	
	
	
	public function validate($data) {
		
		if (empty($data)) {
			
			$this->error = $this->message;
			return false;
			
		}
		
		return true;
		
	}
	
	
}
