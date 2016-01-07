<?php
namespace Models;
use Lib\ORM;
class Comment extends ORM {
	
	protected $id;
	protected $product_id;
	protected $user_id;
	protected $comment;
	protected $date;
	protected $rate;
	
	public function __construct($id = null) {
		$this->id = $id;
		parent::__construct('comments', $id);
		
	}
	
	public function getId() {
		
		return $this->id;
		
	}
	public function getProductId() {
		
		return $this->product_id;
		
	}
	
	public function getUserId() {
		
		return $this->user_id;
		
	}
	
	public function getComment() {
		
		return $this->comment;
		
	}
	
	public function getDate() {
		
		return $this->date;
	}
	
	public function getRate() {
		
		return $this->rate;
		
	}
	
	
	
	
	public function setProductId($product_id) {
	
		$this->product_id = $product_id;
	
	}
	
	public function setUserId($user_id) {
	
		 $this->user_id = $user_id;
	
	}
	
	public function setComment($comment) {
	
		 $this->comment = $comment;
	
	}
	
	public function setDate() {
		
		$date = date("Y-m-d H:i:s");
		$this->date = $date;
	}
	
	public function setRate($rate) {
	
		$this->rate = $rate;
	
	}
	
}