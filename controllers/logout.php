<?php
namespace controllers;

use Lib\Controller;
use Lib\Register;
use Models\User;
use Lib\Location;
class logout extends Controller {

	public function __construct(){

		parent::__construct();
		$id = Register::get('id');
		if(!empty($id)) {
			
			$user = new User($id);
			$user->setLastVisit();
			$user->writeData(true);
			$this->logout();
			
		}
		$this->logout();

	}
	
	
	private function logout() {
		
		\Lib\Session::deleteAll();
		Location::To(URL.'home');
		
		
	}


}