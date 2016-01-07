<?php
namespace Models;
use Lib\ORM;
class Logo extends ORM {
	
	protected $id;
	protected $logo;
	
	public function __construct() {
		
		parent::__construct('logo', 1);
		
	}
	
	public function getLogo() {
		
		return $this->logo;
		
	}
	
	
	public function setLogo($logo) {
		
		$this->logo = $logo;
		
	}
	
	
}
