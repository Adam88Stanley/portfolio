<?php
namespace Models;
use Lib\ORM;
class Registration extends ORM {
	
	
	public function __construct($id = null) {
		
		parent::__construct('users', $id);
		
	}
	
	public function register($data) {
		
		$this->email = $data['email'];
		$this->login = $data['login'];
		$this->password = md5($data['password']);
		return $this->writeData();
		
	}
	
	
	
	
}