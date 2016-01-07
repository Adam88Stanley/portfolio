<?php
namespace Lib;

class Admin {
	
	
	
	public static function isAdmin() {
		
		$admin = \Lib\Session::get('admin');
		
		if($admin) {
			
			return true;
		
		}else {
			
			return false;
			
		}
		
	}
	
	
	
}