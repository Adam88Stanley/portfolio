<?php
namespace Models;
use Lib\Model;
class Activation extends Model {
	
	
	
	public function __construct() {
		parent::__construct();
		
		
		
	}
	
	
	

	public function check($id, $date) {
	
		$result = $this->db->simpleQuery()->from('users_extensions', array('user_id'))->where('user_id=?', 'registration_date=?', $id, $date,'AND')->first();
		
		if(count($result)) {
			
			return true;
				
		}else {
				
			return false;
				
		}
	
	}
	

	
	
	
}
