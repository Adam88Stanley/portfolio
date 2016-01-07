<?php
namespace Models;
use Lib\Model;
class CategoryPage extends Model {
	
	protected $page_m;
	protected $id;
	
	public function __construct($id = null) {
		parent::__construct();
		if(!empty($id)){
			$this->id = $id;	
			
			$result = $this->db->simpleQuery()->from('page_id_category_id', array('page_id'))->where('category_id=?', $id)->all();
			
			foreach ($result as $tab) {
				
				$this->page_m[] = new Page($tab['page_id']);
			
				
			}
		}
		
	}
	
	public function includePage($category_id, $page_id){
		
		$this->db->simpleQuery()->from('page_id_category_id')->save(array('category_id'=>$category_id, 'page_id'=>$page_id));
		
	}
	
	
	public function excludePage($page_id){
	
		$this->db->simpleQuery()->from('page_id_category_id')->where('page_id=?', $page_id)->delete();
	
	}
	
	
	
	public function getMembershipId($page_id) {
		
		$result = $this->db->simpleQuery()->from('page_id_category_id', array('category_id'))->where('page_id=?', $page_id)->first();
		return $result[0]['category_id'];
		
	}
	
	
	public function getPages() {
		
		return $this->page_m;
		
	}
	
	public function getAllPages() {
		$pages = array();
		$result = $this->db->simpleQuery()->from('pages', array('id'))->all();
		
		foreach ($result as $tab) {
		
			$pages[] = new Page($tab['id']);
				
		
		}
		
		return $pages;
	
	}
	
	public function getCategoryPageName() {
		$result = $this->db->simpleQuery()->from('category_page', array('category_name'))->where('id=?', $this->id)->first();
		return $result[0]['category_name'];
		
	}
	
	
	
	
	public function getCategoryPageNames() {
		
		
		$result = $this->db->simpleQuery()->from('category_page', array('id'))->all();
		$cats = array();
		if(!empty($result)) {
		
			foreach ($result as $tab) {
			
				$cats[] = new CategoryPageNames($tab['id']);
					
			
			}
			
			
		}
		
		return $cats;
		
		
	}


	
}