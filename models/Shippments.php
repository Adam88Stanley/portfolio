<?php
namespace Models;
use Lib\Model;
class Shippments extends Model {
	
	protected $shippment_m;
	
	public function __construct() {
	
		parent::__construct();
		
		$result = $this->db->simpleQuery()->from('shippment_methods', array('id'))->all();
		foreach ($result as $tab) {
			
			$this->shippment_m[] = new Shippment($tab['id']);
			
		}
		
	}
	
	public function getShippmentMethods() {
		
		return $this->shippment_m;
		
	}

	
}
