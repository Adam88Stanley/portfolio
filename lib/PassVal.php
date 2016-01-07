<?php
namespace Lib;
class PassVal extends A_validator {
	
	private $pass_1;
	private $pass_2;
	private $num;
	private $err_num;
	private $message_one;
	private $message_two;
	private $minlen;
	private $maxlen;
	
	public function __construct($message_1, $message_2, $minlen, $maxlen) {
		
		$this->num = 0;
		$this->err_num = 0;
		$this->message_one = $message_1;
		$this->message_two = $message_2;
		$this->minlen = $minlen;
		$this->maxlen = $maxlen;
		
	}
	
	public function validate($data) {
		
		if($this->num == 0) {
			$this->pass_1 = $data;
			$this->num++;
			
			if(strlen($this->pass_1) < $this->minlen || strlen($this->pass_1) > $this->maxlen){
				$this->error = $this->message_one;
				$this->err_num++;
				return false;
				
			}
			
			return true;
			
		}
		
		if($this->num == 1 && $this->err_num == 0) {
			$this->pass_2 = $data;
			
			if(!$this->compare()){
				
				$this->error = $this->message_two;
				return false;
				
			}
			
			return true;
			
		}
		
		if($this->num == 1 && $this->err_num == 1) {
			
			$this->error = '';
			return false;
			
			
		}
		
		return false;
		
		
	}
	
	private function compare() {
		
		if($this->pass_1 === $this->pass_2) {
	
			return true;
			
		} else {
			
			return false;
			
		}
		
	}
	
}