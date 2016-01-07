<?php
namespace Models;
use Lib\Model;
class SubCategories extends Model {
	
	protected $category_m;
	
	public function __construct() {
	
		parent::__construct();
		
		$result = $this->db->simpleQuery()->from('sub_categories', array('category_id'))->all();
		foreach ($result as $tab) {
			
			$this->category_m[] = new SubCategory($tab['category_id']);
			
		}
		
	}
	
	public function getSubCategories() {
		
		return $this->category_m;
		
	}

	
	
}