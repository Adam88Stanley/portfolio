<?php
namespace Lib;
class Validator {
	
	private $data;
	private $conditions;
	private $errors;
	
	public function __construct($conditions) {
		
		$this->conditions = $conditions;
		
		
	}
	
	
	public function validate($data) {
		
		$this->data = $data;
		
		if(is_array($this->conditions)) {
				
			foreach ($this->conditions as $key => $value) {
		
				if(!$value->validate($this->data[$key])) {
					
					$this->errors[$key] = $value->getErrMessage();
					
				}
		
			}
				
		}
		
		if(empty($this->errors)){
			
			return true;
			
		} else {
			
			return false;
			
		}
		
	}
	
	
	public function getErrors() {
		
		return $this->errors;
		
	}
	
	
	
}