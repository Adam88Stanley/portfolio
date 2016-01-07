<?php
namespace Models;
use Lib\ORM;
class Order extends ORM {
	
	protected $idd;
	protected $user_id;
	protected $product_id;
	protected $price;
	protected $product_name;
	protected $quantity;
	protected $active;
	protected $status;
	protected $date;
	protected $order;
	protected $order_details_id;
	
	
	
	public function __construct($id = null) {
		$this->idd = $id;
		parent::__construct('last_ordered', $id);
		
	}
	
	public function getId() {
		
		return $this->idd;
		
	}
	
	
	public function getPrice(){
		
		return $this->price;
		
	}
	
	public function getProductName(){
	
		return $this->product_name;
	
	}
	public function getQuantity(){
	
		return $this->quantity;
	
	}
	public function getActive(){
	
		return $this->active;
	
	}
	public function getStatus(){
	
		return $this->status;
	
	}
	public function getDate(){
	
		return $this->date;
	
	}
	
	public function getProductId() {
		
		return $this->product_id;
		
	}
	
	
	
	public function getOrderDetailsId(){
		
		return $this->order_details_id;
		
	}
	
	public function setUserId($user_id) {
		
		$this->user_id = $user_id;
		
	}
	
	public function setActive($active) {
		
		$this->active= $active;
		
	}
	
	
	public function setQuantity($quantity) {
		
		$this->quantity = $quantity;
		
	}
	
	public function setPrice($price) {
		
		$this->price = $price;
		
	}
	
	public function setProductName($product_name) {
		
		$this->product_name = $product_name;
		
	}
	
	public function setStatus($status) {
		
		$this->status = $status;
		
	}
	
	public function setDate() {
		
		$date = date("Y-m-d H:i:s");
		$this->date = $date;
		
	}
	
	public function setProductId($product_id) {
		
		$this->product_id = $product_id;
	}
	
	
	
	
	public function setOrderDetailsId($id){
		
		$this->order_details_id = $id;
		
	}
	
	
}