<?php
namespace controllers;

use Lib\Controller;
class Error extends Controller {
	
	public function __construct(){
		
		parent::__construct();
		
	}
	
	protected function def($arg=null){
		
		$this->render('error');
		
	}
	
	
}