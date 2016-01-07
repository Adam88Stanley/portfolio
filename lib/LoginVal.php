<?php
namespace Lib;
class LoginVal extends A_validator {
	
	private $db;
	private $message_one;
	private $message_two;
	private $minlength;
	private $maxlength;
	
	public function __construct($message_one, $message_two, $minlength, $maxlength) {
		
		$this->message_one = $message_one;
		$this->message_two = $message_two;
		$this->minlength = $minlength;
		$this->maxlength = $maxlength;
		$this->db = Register::get('db');
		
	}
	
	
	public function validate($data) {
		
		if(is_string($data)){
			
			if(strlen($data)< $this->minlength || strlen($data) > $this->maxlength) {
				
				$this->error = $this->message_two;
				return false;
				
			}
			
		}
		else {
			
			$this->error = $this->message_two;
			return false;
			
		}
		
		$result = $this->db->simpleQuery()->from('users',array('login'))->where('login=?', $data)->first();
		if(count($result)){
			$this->error = $this->message_one;
			return false;
		}
		return true;
	}
	
	public static function isLogged() {
		
		$id = Session::get('id',null);
		$login = Session::get('login',null);
		
		if(!empty($id) && !empty($login)) {
			
			return true;
			
		}else {
			
			return false;
			
		}
		
	}
	
}