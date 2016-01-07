<?php
namespace Models;

use Lib\Model;
class ProductAdditionalImages extends Model {
	
	
	protected $values;
	protected $id;
	
	
	public function __construct($id = null, $noLoad=false) {
		parent::__construct();
		
		$this->id = $id;
		if($noLoad) {
			
			return $this;
			
		}
		
		if(!empty($id)){
			$this->values = $this->db->simpleQuery()->from('product_additional_images', array('id', 'product_id','product_image'))->where('product_id=?', $this->id)->all();
		}	
	
	}
	
	public function getAdditionalImages() {
		
		return $this->values;
		
	}
	
	public function setAdditionalImages($id, $src) {
		
	
		
		$this->db->simpleQuery()->from('product_additional_images')->save(array(
			'product_id'=>$id, 'product_image' =>$src
		));	
		
	}
	
	public function getAdditionalImage($id) {
	
	
		$res = $this->db->simpleQuery()->from('product_additional_images', array('product_image'))->where('id=?',$id)->all();
		return $res[0]['product_image'];
	}
	
	public function deleteAdditionalImages($id) {
	
	
		$this->db->simpleQuery()->from('product_additional_images')->where('id=?',$id)->delete();
	
	}
	
	public function deleteAllAdditionalImages() {
		
		$this->db->simpleQuery()->from('product_additional_images')->where('product_id=?',$this->id)->delete();
		
	}
	

	
}