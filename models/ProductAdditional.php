<?php
namespace Models;

use Lib\Model;
class ProductAdditional extends Model {
	
	
	protected $values;
	
	
	public function __construct($id=null, $noLoad = false) {
		
		parent::__construct();
		
		$this->id = $id;
		if($noLoad) {
				
			return $this;
				
		}
		
		if(!empty($id)){
		
		$this->values = $this->db->simpleQuery()->from('product_additional_info', array('id', 'product_id','name','value'))->where('product_id=?', $this->id)->all();
		}
	
	}
	
	public function getAdditional() {
		
		return $this->values;
		
	}
	
	public function setAdditionalFields($id, $name, $value ) {
	
	
		$this->db->simpleQuery()->from('product_additional_info')->save(array(
				'product_id'=>$id, 'name' =>$name, 'value'=>$value
		));
	
	
	}
	
	
	public function deleteAdditionalFields($id) {
		
	
		$this->db->simpleQuery()->from('product_additional_info')->where("id=?", $id)->delete();
	
	}
	
	
	public function changeAdditionalFields($id, $name, $value) {
	
	
		$this->db->simpleQuery()->from('product_additional_info')->where("id=?", $id)->save(array(
				'name' =>$name, 'value'=>$value
		));
	
	}
	
	public function deleteAllFields() {
		
		$this->db->simpleQuery()->from('product_additional_info')->where('product_id=?',$this->id)->delete();
		
	}
	

	
}