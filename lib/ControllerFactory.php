<?php
namespace Lib;
class ControllerFactory {
	
	private $path = 'controllers';
	private $errorController = 'error';
	private $homePage = 'home';
	
	public function __construct() {
		
	}
	
	public function getController($controllerName = null, $action = null, $args=null){
		if(!empty($controllerName)){
			if(file_exists($this->path.DIRECTORY_SEPARATOR.$controllerName.'.php')){
				$controller = 'controllers\\'.$controllerName;
				return new $controller($action,$args);
			}else {
				$controller = 'controllers\\'.$this->errorController;
				return new $controller();
			}
			
		}else{
			$controller = 'controllers\\'.$this->homePage;
			return new $controller();
		}
		
	}
	
}