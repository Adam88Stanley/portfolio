<?php
namespace controllers;

use Lib\Controller;
class Success extends Controller {
	
	public function __construct($action, $args){
		
		parent::__construct($action, $args);
		
	}
	

	
	public function success($arg) {
		
		$this->render('success', array('success'=> $arg[0]));
		
		
	}
	
	
}