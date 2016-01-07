<?php
namespace Models;
use Lib\ORM;
class Product extends ORM {
	
	protected $product_id;
	protected $product_category_id;
	protected $product_sub_category_id;
	protected $product_name;
	protected $product_description;
	protected $product_image;
	protected $product_quantity;
	protected $product_price;
	protected $product_added;
	protected $additional;
	protected $additional_images;
	protected $product_sold;
	
	
	
	public function __construct($id= null) {
		$this->product_id = $id;
		parent::__construct('products', $id);
		$pro = new ProductAdditional($id);
		$this->additional = $pro->getAdditional();
		$imgs = new ProductAdditionalImages($id);
		$this->additional_images = $imgs->getAdditionalImages();
		
	}
	
	public function getId() {
		
		return $this->product_id;
		
	}
	
	
	public function getCategory() {
	
		return $this->product_category_id;
	
	}
	
	public function getName() {
	
		return $this->product_name;
	
	}
	
	public function getDescription() {
	
		return $this->product_description;
	
	}
	
	public function getImage() {
	
		return $this->product_image;
	
	}
	
	public function getQuantity() {
	
		return $this->product_quantity;
	
	}
	
	public function getPrice() {
	
		return $this->product_price;
	
	}
	
	
	public function getAdditionals(){
		
		return $this->additional;
		
	}
	
	public function getAdditionalImages() {
		
		return $this->additional_images;
		
	}
	
	public function getOldPrice($percent) {
		
		if(1-$percent != 0){
			
			return round($this->product_price/(1-$percent));
			
		}
		return 0;
		
	}
	
	public function getSubCategory() {
		
		return $this->product_sub_category_id;
		
	}
	
	
	
	public function setCategory($category) {
		
		$this->product_category_id = $category;
		
	}
	
	public function setSubCategory($subcategory) {
	
		$this->product_sub_category_id = $subcategory;
	
	}
	
	public function setName($name) {
	
		$this->product_name = $name;
	
	}
	
	public function setDescription($description) {
	
		$this->product_description = $description;
	
	}
	
	public function setImage($image) {
	
		$this->product_image = $image;
	
	}
	
	public function setQuantity($quantity) {
		
		
		$this->product_quantity = $quantity;
		
		
	}
	
	public function setPrice($price) {
	
		$this->product_price = $price;
	
	}
	
	public function setProductAdded() {
		
		$date = date("Y-m-d H:i:s");
		$this->product_added = $date;
		
	}
	
	public function setDate() {
	
		$date = date("Y-m-d H:i:s");
		$this->product_added = $date;
	
	}
	
	public function getProductSold(){
		return $this->product_sold;
	}
	
	public function changeProductSold($value){
		
		$this->product_sold += $value; 
		
	}
	
	
}