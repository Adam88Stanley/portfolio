<?php
namespace Models;
use Lib\ORM;
class Category extends ORM {
	
	protected $category_id;
	protected $category_name;
	
	public function __construct($id = null) {
		$this->category_id = $id;
		parent::__construct('categories', $id);
		
	}
	
	public function getCategoryId() {
		
		return $this->category_id;
		
	}
	
	public function getCategoryName() {
		
		return $this->category_name;
		
	}
	
	public function setCategoryName($name) {
		
		$this->category_name = $name;
		
	}
	
	
}