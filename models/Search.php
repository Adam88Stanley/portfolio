<?php
namespace Models;
use Lib\Model;

class Search extends Model {
	
	protected $product_m;
	protected $search;
	
	public function __construct($search) {
	
		parent::__construct();
		$this->search = $search;
		
		
	}
	
	public function getNumberoOfMached() {
		
		$result = $this->db->getAll("SELECT COUNT(product_id) FROM products WHERE  product_name LIKE '%" . $this->search . "%' OR product_description LIKE '%" . $this->search  ."%' ");
	
		return $result[0]["COUNT(product_id)"];
		
	}
	public function getProducts($limit, $page=1) {
		$this->getNumberoOfMached();
		$lim = ' LIMIT '.(($page == 1) ? "" : ($page - 1) * $limit.', '). $this->db->escape($limit);
		
		$result = $this->db->query("SELECT product_id FROM products WHERE  product_name LIKE '%" . $this->search . "%' OR product_description LIKE '%" . $this->search  ."%' $lim");
		
		foreach ($result as $tab) {
				
			$this->product_m[] = new \models\Product($tab['product_id']);
				
		}
		
		return $this->product_m;
		
	}
	
	
}
