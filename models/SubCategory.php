<?php
namespace Models;
use Lib\ORM;
class SubCategory extends ORM {
	
	protected $category_id;
	protected $category_name;
	
	public function __construct($id = null) {
		$this->category_id = $id;
		parent::__construct('sub_categories', $id);
		
	}
	
	public function getSubCategoryId() {
		
		return $this->category_id;
		
	}
	
	public function getSubCategoryName() {
		
		return $this->category_name;
		
	}
	
	public function setSubCategoryName($name) {
		
		$this->category_name = $name;
		
	}
	
	
}
