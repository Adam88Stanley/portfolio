<?php
namespace Lib;
class View {
	
	protected $args;
	protected $contName;
	protected static $header;
	protected static $footer;

	
	public function __construct($name) {
		$this->contName = $name;
	}
	
	public function render($name, $args = null) {
		
		$this->args = $args;
		require_once(VIEW_PATH.$name.DIRECTORY_SEPARATOR.'index.php');
		
	}
	
	public static function header($html = false, $title = false){
		
		return require_once(VIEW_PATH.'header.php');
	}
	
	public static function footer(){
		
		return require_once(VIEW_PATH.'footer.php');
	}
	
	public static function commonPath($path) {
		
			return VIEW_PATH.'public/common/'.$path;

	}
	
	public function getViewPath(){
		
		$name = explode('\\',$this->contName);
		$path = URL.'views/'.end($name).'/';
		return $path;
		
	}
	
	static function setHeader($key, $value) {
		
		self::$header[$key] = $value;
		
	}
	
	static function setFooter($key, $value) {
	
		self::$footer[$key] = $value;
	
	}
	
	
}