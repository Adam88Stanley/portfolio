<?php
namespace Models;
use Lib\ORM;
class Order_details extends ORM {

	protected $id;
	protected $shipping_method_id;
	protected $address;
	protected $order_nr;
	protected $status;
	protected $date;
	protected $display_seller;
	protected $display_user;

	public function __construct($id = null) {
		$this->id = $id;
		parent::__construct('order_details', $id);

	}

	public function getId() {

		return $this->id;

	}
	

	public function getShippingMethodId() {

		return $this->shipping_method_id;

	}
	
	public function getOrderNr() {
	
		return $this->order_nr;
	
	}
	
	public function getAddress() {
		
		return $this->address;
		
	}
	
	public function getDisplayUser(){
	
		return $this->display_user;
	
	}
	
	public function getDisplaySeller(){
	
		return $this->display_seller;
	
	}
	
	
	public function getAllOrderDetails() {
		
		$return = array();
		$result = $this->db->simpleQuery()->from('order_details', array('id'))->order('id','desc')->all();
		
		foreach ($result as $tab) {
		
			$return[] = new Order_details($tab['id']);
		
		}
		
		return $return;
		
		
	}
	
	public function getStatus(){
	
		return $this->status;
	
	}
	public function getDate(){
	
		return $this->date;
	
	}
	
	
	
	public function getNewOrders($onpage, $page) {
	
		$return = array();	
		$result = $this->db->getAll("SELECT id FROM order_details WHERE (status='przyjęto' OR status='złożono') AND display_seller='1' ORDER BY date desc");
		foreach ($result as $tab) {
				
			$return[] = new Order_details($tab['id']);
				
		}
	
		return $return;
	}
	
	public function getCompletedOrders($onpage, $page) {
	
		$return = array();
		$result = $this->db->getAll("SELECT id FROM order_details WHERE status='wysłano'  AND display_seller='1' ORDER BY date desc");
		
		foreach ($result as $tab) {
	
			$return[] = new Order_details($tab['id']);
	
		}
	
		return $return;
	
	
	}
	

	
	public function setShippingMethodId($id) {
	
		$this->shipping_method_id = $id;
	
	}
	
	public function setAddress($address) {

		$this->address = $address;

	}
	
	public function setOrderNr($nr) {
	
		$this->order_nr = $nr;
	
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
	
	public function setDisplayUser($display){
	
		$this->display_user = $display;
	
	}
	
	public function setDisplaySeller($display){
	
		$this->display_seller = $display;
	
	}
	
	
	
	
	public function deleteOrder($id, $user = true) {
			
		$details = new Order_details($id);
		
		if(!empty($details)) {
			
			if($user) {
				
				$details->setDisplayUser(false);
				$details->writeData(true);
				
				
				
			}else {
				
				$details->setDisplaySeller(false);
				$details->writeData(true);
				
			}
			
			if(!$details->getDisplaySeller() && !$details->getDisplayUser()) {
			
				$ord = new Orders();
				$to_delate = $ord->getOrdersByDetailsId($details->getId());
				
				foreach ($to_delate as $d) {
					
					$d->delete();
				}
				
				$details->delete();
				return;
				
			}
			
		}
		
	}
			
	
	


}