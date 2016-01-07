<?php
namespace Lib;
class Session {
	
	public function __construct() {
		
		
		
	}
	
	public static function start() {
		
		session_start();
		
		
	}
	
	
	public static function set($key, $value, $mode = 1) {
		switch ($mode) {
			case 1 :
			$_SESSION[$key] = $value;
			break;
			case 2 :
			$_SESSION[$key][] = $value;
		
	}
	}
	
	
	public static function get($key, $defualt = null) {
		
		if(isset($_SESSION[$key])) {
			
			return $_SESSION[$key];
			
		}
		
		return $defualt;
		
	}
	
	
	
	public static function delete($key) {
		
		if(isset($_SESSION[$key])) {
				
			unset($_SESSION[$key]);
				
		}
		
		
	}
	
	
	
	public static function deleteAll() {
		
		session_destroy();
		self::start();
		$_SESSION = array();
		
	}
	
	
	
}