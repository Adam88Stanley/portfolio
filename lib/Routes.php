<?php
namespace Lib;
class Routes {
	
	private $routes;
	
	public function __construct($routes) {
		
		$this->routes = $routes;
		
	}
	
	public function isValidRoute($route) {
		
		$route = explode('?', $route);
		$valid = in_array($route[0], $this->routes);
		
		return $valid;
		
	}
	
}