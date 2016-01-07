<?php
namespace Models;
use Lib\Model;
class Promotions extends Model {
	
	protected $promotion_m;
	
	public function __construct($id=null) {
	
		parent::__construct();
		
		if(!empty($id)) {
			$result = $this->db->simpleQuery()->from('promotions', array('id'))->where('product_id=?',$id)->all();
			foreach ($result as $tab) {
				
				$this->promotion_m = new Promotion($tab['id']);
				
			}
		}
		
	}
	
	public function getPromotion() {
		
		return $this->promotion_m;
		
	}
	
	
	public function isPromo($id) {
	
		$result = $this->db->simpleQuery()->from('promotions',array('id'))->where('product_id=?', $id)->all();
		if($result) {
			
			return true;
			
		}
		return false;
	}

	
}
