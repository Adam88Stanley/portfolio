<?php
namespace Models;
use Lib\Model;
class Login extends Model {
	
	protected $id;
	protected $login;
	
	public function __construct() {
		
		parent::__construct();
		
	}
	
	public function login($login, $password) {
		
		$result = $this->db->simpleQuery()->from('users', array('id', 'login'))->where('login=?','password=?', $login, md5($password), 'AND')->first();    
		
		if(count($result) == 0){
			
			return false;
			
		} 
		else {
			
			$this->id = $result[0]['id'];
			$this->login = $result[0]['login'];
			return true;
			
		}       
		
	}
	
	
	public function isActivated ($login) {
		
		$result = $this->db->simpleQuery()->from('users', array('activated'))->where('login=?', $login )->first();
		if($result[0]['activated']){
			
			return true;
			
		}else {
			
			return false;
			
		}
		
	}
	
	
	public function getId() {
		
		return $this->id;
		
	}
	
	
	public function getLogin() {
		
		return $this->login;
		
	}
	
	
	
}