<?php
namespace Models;
use Lib\Model;
class PasswordRecovery extends Model {
	
	private $exist;
	private $id;
	
	public function __construct($email) {
		parent::__construct();
		
		$result = $this->db->simpleQuery()->from('users', array('id'))->where('email=?', $email)->first();    		
		
		if(count($result)) {
			$this->id = $result[0]['id'];
			$this->exist = true;
			
		}else {
			
			$this->exist = false;
			
		}
		
	}
	
	public function userExists() {
		
		return $this->exist;
		
	}
	
	public function getUserId() {
		
		return $this->id;
		
	}
	
	public function setUserToChange($id,$rand, $time) {
		
		$result = $this->db->simpleQuery()->from('users_to_change')->save(array('user_id' => $id, 'rand' => $rand, 'date' => $time));
		
		if($result){
			
			return true;
			
		} else {
			
			return false;
			
		}
		
		
	}

	
	public function checkUserToChange($id, $rand) {
	
		$result = $this->db->simpleQuery()->from('users_to_change', array('id'))->where('user_id=?', 'rand=?', $id, $rand,'AND')->first();
		
		if(count($result)) {
			
			return true;
				
		}else {
				
			return false;
				
		}
	
	}
	
	public function deleteUserToChange($id) {
		
		$result = $this->db->simpleQuery()->from('users_to_change')->where('user_id=?', $id)->delete();
		
	
	
	}
	
	
	
	
}