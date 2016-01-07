<?php
namespace Models;
use Lib\ORM;
class Message extends ORM {

	
	protected $idd;
	protected $user_id;
	protected $readed;
	protected $message;
	protected $date;
	protected $seller;
	protected $display_user;
	protected $display_seller;
	

	public function __construct($id = null) {

		$this->idd = $id;
		parent::__construct('messages', $id);

	}

	public function getId(){
		
		return $this->idd;
		
	}
	
	public function getUserId(){
	
		return $this->user_id;
		
	}
	
	public function getReaded(){
	
		return $this->readed;
		
	}
	
	public function getMessage(){
	
		return $this->message;
		
	}
	
	public function getDate(){
	
		return $this->date;
		
	}
	
	public function getSeller(){
	
		return $this->seller;
	
	}
	

	public function getDisplayUser(){
	
		return $this->display_user;
	
	}
	
	public function getDisplaySeller(){
	
		return $this->display_seller;
	
	}
	
	
	public function setUserId($user_id){
	
		$this->user_id=$user_id;
	
	}
	
	public function setReaded($readed){
	
		$this->readed = $readed;
	
	}
	
	public function setMessage($message){
	
		$this->message=$message;
	
	}
	
	public function setDate(){
		
		$date = date("Y-m-d H:i:s");
		$this->date=$date;
	
	}
	
	public function setSeller($seller){
	
		$this->seller=$seller;
	
	}
	
	
	public function setDisplayUser($display){
	
		$this->display_user = $display;
	
	}
	
	public function setDisplaySeller($display){
	
		$this->display_seller = $display;
	
	} 
}