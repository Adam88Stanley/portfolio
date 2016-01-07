<?php
namespace Models;
use Lib\ORM;
class Promotion extends ORM {
	
	protected $id;
	protected $product_id;
	protected $percent;
	
	
	
	public function __construct($id = null) {
		
		$this->id = $id;
		parent::__construct('promotions', $id);
		
		
	}
	
	public function getPercent(){
		
		return $this->percent;
		
	}
	
	public function setPercent($percent){
	
		 $this->percent = $percent;
	
	}
	
	public function setProductId($id){
	
		$this->product_id = $id;
	
	}
	
	public function deletePromotionByProductId($id) {
		
		$result = $this->db->simpleQuery()->from('promotions',array('id'))->where('product_id=?', $id)->delete();
		
		
	}
	
	
	
	
	
	
}
