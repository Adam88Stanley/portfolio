<?php
namespace Lib;
class Location {
	
	private static $intended;
	

	
	public function __construct() {}
	
	public static function To($location) {
		header("Location: $location");
		exit();
	}
	
	public static function intended($default = null) {
		if(\Lib\Session::get('intended')){
			$to = \Lib\Session::get('intended');
			\Lib\Session::delete('intended');
			header("Location: $to");
			exit();
		}
		
		header("Location: $default");
		exit();
	}
	
	
	
	
}