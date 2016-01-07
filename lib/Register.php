<?php
namespace Lib;
class Register {
	
	private static $values = array();
	
	
	
	private function __construct() {
		
	}
	
	private function __clone() {
		
	}
	
	
	public static function set($key, $value) {
		
		self::$values[$key] = $value;
		
	}
	
	
	public static function get($key, $default = null) {
		
		if(isset(self::$values[$key])) {
			
			return self::$values[$key];
			
		}
		
		return $default;
		
	}
	
	
	public static function delete($key) {
		
		if(isset(self::$values[$key])) {
				
			unset(self::$values[$key]);
				
		}
		
	}
	
	
	
}