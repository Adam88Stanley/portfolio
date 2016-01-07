<?php
/* Klasa automatycznie ³aduj¹ca klasy */
class AutoLoader {
	
	public function __construct() {
		
		spl_autoload_register(array($this, 'autoload'));
		
	}
	
	private function autoload($class){
		
		$includePathArray = explode(PATH_SEPARATOR, get_include_path());
		$filePath = strtolower(str_replace("\\", DIRECTORY_SEPARATOR, trim($class, "\\"))).'.php';         
		
		foreach($includePathArray as $path){
			
			$classPath = $path.DIRECTORY_SEPARATOR.$filePath;
			
			if(file_exists($classPath)){
				
				require_once($classPath);
				return ;
				
			}
			
		}
	
	}
	
}