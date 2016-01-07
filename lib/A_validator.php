<?php
namespace Lib;
abstract class A_validator {
	
	protected $error;
	
	abstract public function validate($data);
	
	public function getErrMessage() {
		
		return $this->error;
		
	}
	
}