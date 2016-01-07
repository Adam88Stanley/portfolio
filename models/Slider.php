<?php
namespace Models;
use Lib\ORM;
class Slider extends ORM {

	protected $id;
	protected $product_id;
	
	public function __construct($id = null) {
		$this->id = $id;
		parent::__construct('slider', $id);
	
	}
	
	public function setProductId($product_id) {
		
		$this->product_id = $product_id;		
	}
	
	public function getProductId() {
		
		return $this->product_id;
		
	}
	
}