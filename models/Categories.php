<?php
namespace Models;
use Lib\Model;
class Categories extends Model {
	
	protected $category_m;
	
	public function __construct() {
	
		parent::__construct();
		
		$result = $this->db->simpleQuery()->from('categories', array('category_id'))->all();
		foreach ($result as $tab) {
			
			$this->category_m[] = new Category($tab['category_id']);
			
		}
		
	}
	
	public function getCategories() {
		
		return $this->category_m;
		
	}

	
	public function getCategoriesIds() {
	
		$cats = $this->getCategories();
		$ids;
		
		if(!empty($cats)){
			
			foreach ($cats as $cat) {
				
				$ids[] = $cat->getCategoryId();
				
			}
			
		}
		
		return $ids;
	
	}
	
	
	
	
}