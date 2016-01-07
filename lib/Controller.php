<?php
namespace Lib;
abstract class Controller {
	
	protected $view;
	protected $action;
	protected $args;
	
	public function __construct($action=null, $args=null) {
		
		$this->action = $action;
		$this->args = $args;
		$this->view = new View(get_class($this));
		
		if(!empty($this->action)) {
		
			if(!empty($this->args)){
					
				$this->$action($args);
					
			}
			else {
					
				$this->$action();
					
			}
		
		} else {
			
			$this->def();
			
		}
		
		
	}
	
	protected function render($name, $args = null) {
		
		$this->view->render($name, $args);
		
	}
	
	protected function def($arg = null) {
		
		
	}
	
	
}