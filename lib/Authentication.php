<?php
namespace Lib;
class Authentication {
	
	private $requiredAuthentication;
	private $id;
	private $login;
	private $isLogged;
	
	public function __construct($requiredAuthentication) {
		
		$this->requiredAuthentication = $requiredAuthentication;
		$this->id = Session::get('id');
		$this->login = Session::get('login');
		
		if(!empty($this->login) && !empty($this->id)) {
			
			$this->isLogged = true;
			Register::set('id', $this->id);
			Register::set('login', $this->login);			
			
		} else {
			
			$this->isLogged = false;
			
		}
		
	}
	
	public function canShow($name) {
		
		if(in_array($name, $this->requiredAuthentication)){
			
			if($this->isLogged) {
				
				return true;
				
			} else {
				
				return false;
				
			}
			
		}
		
		return true;
		
	}
	
	
	private function isLogged() {
		
		return $this->isLogged;
		
	}
	
	
}