<?php
namespace Lib;
class Router {

	private $url;
	private $controller;
	private $action;
	private $args;
		
	public function __construct(){
			
		$this->url = $_GET["url"];

		if(!empty($this->url)){
			$bits = explode('/', $this->url);
			$bits = array_filter($bits, function($arg){
				return !empty($arg) ? true : false; });

				$num_of_bits = count($bits);

				switch ($num_of_bits) {
					case 1:
						$this->controller = $bits[0];
						break;
					case 2:
						$this->controller = $bits[0];
						$this->action = $bits[1];
						break;
					default :
						$this->controller = $bits[0];
						$this->action = $bits[1];
						unset($bits[0], $bits[1]);
						$this->args = array_values($bits);
						break;
				}

		}
			
	}

	public function getControllerName(){
		return !empty($this->controller) ? $this->controller : false;
	}

	public function getAction(){
		return !empty($this->action) ? $this->action : false;
	}

	public function getArgs(){
		return !empty($this->args) ? $this->args : false;
	}

}