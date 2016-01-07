<?php
namespace Models;
use Lib\ORM;
class CategoryPageNames extends ORM {
	
	protected $id;
	protected $category_name;
	
	public function __construct($id = null) {
		$this->id = $id;
		parent::__construct('category_page', $id);
		
	}
	
	public function getCategoryId() {
		
		return $this->id;
		
	}
	
	public function getCategoryName() {
		
		return $this->category_name;
		
	}
	
	public function setCategoryName($name) {
		
		$this->category_name = $name;
		
	}
	
	
}