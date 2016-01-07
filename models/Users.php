<?php
namespace Models;
use Lib\ORM;
class Users extends ORM {
	
	protected $login;
	protected $email;
	protected $id;
	protected $password;
	protected $activated;
	
	
	
	public function __construct($id = null) {
		$this->id = $id;
		parent::__construct('users', $id);
		
	}
	public function getLogin() {
		
		return $this->login;
		
	}
	public function getEmail() {
		
		return $this->email;
		
	}
	public function getId() {
		
		return $this->id;
		
	}
	
	public function setEmail($email) {
		
		$this->email = $email;
		
	}
	
	public function setActive() {
	
		$this->activated = true;
	
	}
	
	public function setPassword($password) {
	
		$this->password = md5($password);
	
	}
	
	public function getAllUsers() {
		$return = array();
		$result = $this->db->simpleQuery()->from('users', array('id'))->all();
		foreach ($result as $tab) {
	
			$return[] = new Users($tab['id']);
	
		}
	
		return $return;
	}
	
	
	
}