<?php
namespace Lib;
class Model {
	
	protected $db;
	
	
	
	public function __construct() {
		
		$this->db = Register::get('db');
		
	}
	
	
	
	
	
	
	
}