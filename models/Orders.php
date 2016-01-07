<?php
namespace Models;
use Lib\Model;
class Orders extends Model {
	
	protected $order_m;
	protected $id;
	
	public function __construct($id=null) {
	
		parent::__construct();
		
		$this->id = $id;
		
			if($id=='noload') {
				
				return $this;
				
			}
			
			/*
			if(!empty($id)){
				
				$result = $this->db->simpleQuery()->from('last_ordered', array('id'))->where('user_id=?',$id)->order('date','desc')->all();
			
			}else {
				
				$result = $this->db->simpleQuery()->from('last_ordered', array('id'))->order('date','desc')->all();
				
			}
		foreach ($result as $tab) {
			
			$this->order_m[] = new Order($tab['id']);
			
		}*/
		
	}
	
	
	public function getUserNumberOfOrders() {
		
		if(!empty($this->id)){
			$result = $this->db->getAll("SELECT COUNT(DISTINCT last_ordered.order_details_id) FROM last_ordered INNER JOIN order_details ON last_ordered.order_details_id=order_details.id  WHERE last_ordered.user_id=\"$this->id\" AND last_ordered.active=\"1\"  AND order_details.display_user=\"1\"");
			//$result = $this->db->getAll("SELECT COUNT(id) FROM last_ordered WHERE user_id=$this->id AND active=1 ");
			return $result[0]["COUNT(DISTINCT last_ordered.order_details_id)"];
			
		}else {
			
			return 0;
			
		}
		
	}
	
	public function getOrders($onpage, $page) {
		
		
		if(!empty($this->id)){
		
			$lim = ' LIMIT '.(($page == 1) ? "" : ($page - 1) * $onpage.', ').$this->db->escape($onpage);
			
			$result = $this->db->getAll("SELECT last_ordered.id FROM last_ordered INNER JOIN order_details ON last_ordered.order_details_id=order_details.id WHERE last_ordered.user_id=\"$this->id\" AND last_ordered.active=\"1\" AND order_details.display_user=\"1\" GROUP BY last_ordered.order_details_id ORDER BY last_ordered.date desc $lim");
			
		
			
			
		}else {
		
			$result = $this->db->simpleQuery()->from('last_ordered', array('id'))->order('date','desc')->all();
		
		}
		foreach ($result as $tab) {
			$this->order_m[] = new Order($tab['id']);
				
		}
		
		return $this->order_m;
		

		
	}
	
	
	
	public function getOrdersByDetailsId($order_details_id) {
		
		$return = array();
		$result = $this->db->simpleQuery()->from('last_ordered', array('id'))->where('order_details_id=?' ,$order_details_id)->order('date','desc')->all();
		
		foreach ($result as $tab) {
		
			$return[] = new Order($tab['id']);
		
		}
		
		return $return;
		
		
	}
	
	
	public function getMaxValueOfOrderId() {
	
		$return= 0;
	
		$result = $this->db->getAll("SELECT id from order_details ORDER BY id DESC LIMIT 1");
		if(!empty($result)) {
				
			$return = $result[0]['id'];
				
		}
	
		return $return;
	}
	
	
	public function checkingNewOrders($id) {
	
		$return = array();
	
		$result = $this->db->getAll("SELECT id FROM order_details WHERE id > '".$id."'");
	
		if(!empty($result)) {
				
			foreach ($result as $tab){
	
				$return[] = new Order_details($tab['id']);
	
			}
				
		}
	
		return $return;
	}
	
	
	
	
}