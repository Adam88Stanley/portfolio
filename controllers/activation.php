<?php
namespace controllers;

use Lib\Controller;
use Lib\Http;
use Lib\Location;
use Models\Users;

class Activation extends Controller {
	
	public function __construct($action, $args){
		
		parent::__construct($action, $args);
		
	}
	

	
	public function activate() {
		
		$http = new Http();
		$id = $http->get('id');
		$date = $http->get('register');	
		if(!empty($id) && !empty($date)) {
			
			$activation = new \models\Activation();
			
			if($activation->check($id, $date)){
				
				$user = new Users($id);
				$user->setActive();
				$user->writeData(true);
				Location::To(URL.'success/success/Aktywacja powiodła się możesz teraz się zalogować.');
				
			}else {
				
				Location::To(URL.'error');
				
			}
			
			
		}else {
			
			Location::To(URL.'error');
			
		}
		
		
	}
	
	
	
}