<?php
namespace Models;
use Lib\Model;
class Products extends Model {
	
	protected $product_m;
	protected $number;
	
	public function __construct($load = null) {
	
		parent::__construct();
		
	}
	
	
	public function getProducts() {
		
		$result = $this->db->simpleQuery()->from('products', array('product_id'))->all();
		foreach ($result as $tab) {
				
			$this->product_m[] = new Product($tab['product_id']);
				
		}
		return $this->product_m;
		
	}
	
	
	public function getDayProduct() {
		
		$result = $this->db->simpleQuery()->from('d_product', array('product_id'))->first();
		$product = new Product($result[0]['product_id']);
		return $product;
		
	}
	
	
	public function getSliderProducts() {
		
		$result = $this->db->simpleQuery()->from('slider', array('product_id'))->all();
		$products;
		if(!empty($result)) {
			
			foreach ($result as $tab) {
					
				$products[] = new Product($tab['product_id']);
					
			}
			
		}
		return $products;
		
	}
	
	public function getNumberOfProductsInPromo() {
		
		$result = $this->db->query("SELECT product_id FROM promotions");
		return $result->num_rows;

	}
	
	public function getPromotions($onPage=6, $page=1) {
		
		$result = $this->db->simpleQuery()->from('promotions', array('product_id'))->limit($onPage,$page)->all();
		$products;
		if(!empty($result)) {
				
				foreach ($result as $tab) {
						
					$products[] = new Product($tab['product_id']);
						
				}
				
		}
		
		return $products;
		
	}
	
	
	
	
	public function deleteProductFromSlider($id) {
		
		$result = $this->db->simpleQuery()->from('slider')->where('product_id=?', $id)->delete();
		
		
	}
	
	
	
	public function getNews($onPage=6, $page=1) {
		
		$result = $this->db->simpleQuery()->from('products',array('product_id'))->order('product_added','desc')->limit($onPage,$page)->all();
		products;
		if(!empty($result)) {
		
			foreach ($result as $tab) {
		
				$products[] = new Product($tab['product_id']);
		
			}
		
		}
		
		return $products;
		
		
	}
	
	
	
	public function getNumberOfPopularPro() {
	
		$result = $this->db->query("SELECT product_id FROM products");
		return $result->num_rows;
	
	}
	
	
	public function getPopular($onPage=6, $page=1) {
	
		$result = $this->db->simpleQuery()->from('products',array('product_id'))->order('product_sold','desc')->limit($onPage,$page)->all();
		products;
		if(!empty($result)) {
	
			foreach ($result as $tab) {
	
				$products[] = new Product($tab['product_id']);
	
			}
	
		}
	
		return $products;
	
	}
	
	
	
	
	public function getProductsByCategory($category_id, $onPage=6, $page=1){
		
		$result = $this->db->simpleQuery()->from('products',array('product_id'))->where('product_category_id=?', $category_id)->limit($onPage, $page)->all();
		products;
		if(!empty($result)) {
		
			foreach ($result as $tab) {
		
				$products[] = new Product($tab['product_id']);
		
			}
		
		}
		
		return $products;
		
		
	}
	
	public function getNumberOfProductsBySubCategory($category_id, $sub_category = null){
		if(is_numeric($sub_category)){
			
			$result = $this->db->query("SELECT product_id FROM products WHERE product_category_id = $category_id AND product_sub_category_id = $sub_category");
			return $result->num_rows;
			
		}
		$result = $this->db->query("SELECT product_id FROM products WHERE product_category_id = $category_id");
		return $result->num_rows;
	
	}
	
	public function getProductsBySubCategory($category_id, $onPage=6, $page=1, $sub_category_id=null, $order = 'product_price', $mode='desc'){
		
		
		
		if(empty($sub_category_id)) {
			
			
				$result = $this->db->simpleQuery()->from('products',array('product_id'))->where('product_category_id=?', $category_id)->limit($onPage, $page)->all();
			
			
		}else {
			
			if( $sub_category_id == 'all'){
				
				$result = $this->db->simpleQuery()->from('products',array('product_id'))->where('product_category_id=?', $category_id)->order($order, $mode)->limit($onPage, $page)->all();
				
			}else {
			
				$result = $this->db->simpleQuery()->from('products',array('product_id'))->where('product_category_id=?','product_sub_category_id=?', $category_id, $sub_category_id, 'AND')->order($order, $mode)->limit($onPage, $page)->all();
		
			}
		}
		products;
		if(!empty($result)) {
	
			foreach ($result as $tab) {
	
				$products[] = new Product($tab['product_id']);
	
			}
	
		}
	
		return $products;
	
	
	
	}
	
	
	
	public function setDayProduct($id) {
		$result = $this->db->simpleQuery()->from('d_product')->delete();
		$result = $this->db->simpleQuery()->from('d_product')->save(array('product_id'=> $id));

		return $result;
	
	}

	
}