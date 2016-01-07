<?php
namespace Models;
use Lib\Model;
class Messages extends Model {
	
	protected $message_m;
	protected $id;
	
	public function __construct($id = null) {
	
		parent::__construct();
		$this->id = $id;
		
	}
	
	public function getNumberOfMessages() {
		
		
		if(!empty($this->id)){
			$result = $this->db->getAll("SELECT COUNT(id) FROM messages WHERE user_id = $this->id AND display_user=1");
			return $result[0]["COUNT(id)"];
				
		}else {
				
			return 0;
				
		}
		
		
		
	}
	
	
	public function getMessages($onpage=null, $page=null, $nolimit = false) {
		$this->message_m = array();
		if($nolimit && empty($this->id)){
			
			$result = $this->db->getAll("SELECT id FROM messages WHERE readed=0 AND seller=0 AND display_seller=1 ORDER BY date desc");
			//$result = $this->db->simpleQuery()->from('messages', array('id'))->where('user_id=?', $this->id)->order('date','desc')->all();
				
		}else if($nolimit && !empty($this->id)){
			
			$result = $this->db->simpleQuery()->from('messages', array('id'))->where('user_id=?', $this->id)->order('date','desc')->all();
							
			
		}else if(empty($this->id)) {
		
			$result = $this->db->simpleQuery()->from('messages', array('id'))->order('date','desc')->all();
				
		}else {
		
			$result = $this->db->simpleQuery()->from('messages', array('id'))->where('user_id=?', $this->id)->limit($onpage, $page)->order('date','desc')->all();
				
		}
		if(!empty($result)){
			foreach ($result as $tab) {
					
				$this->message_m[] = new Message($tab['id']);
					
			}
		}
		
		return $this->message_m;
		
	}
	
	
	
	public function checkingNewMessages($id) {
		
		$return = array();
		
		$result = $this->db->getAll("SELECT id FROM messages WHERE id > '".$id."'");
		
		if(!empty($result)) {
			
			foreach ($result as $tab){
				
				$return[] = new Message($tab['id']);
				
			}
			
		}
		
		return $return;
	}
	
	
	
	public function getMaxValueOfMessageId() {
	
		$return= 0;
	
		$result = $this->db->getAll("SELECT id from messages ORDER BY id DESC LIMIT 1");
		if(!empty($result)) {
			
			$return = $result[0]['id'];
			
		}
	
		return $return;
	}
	
	
	
	public function getNumberOfUnreaded() {
	
		$return= 0;
	
		$result = $this->db->getAll("SELECT Count(id) from messages WHERE readed = 0 and seller = 0 and display_seller = 1");
		if(!empty($result)) {
				
			$return = $result[0]['Count(id)'];
				
		}
	
		return $return;
	}
	
	
	
	
	
	
	
	
	// delete only if not display user and seller
	public function deleteMessages($id, $user = true) {
		
		if(!empty($this->$id)) {
		
			$result = $this->db->simpleQuery()->from('messages', array('id'))->where('user_id=?', $id)->order('date','desc')->all();
							
		}else {
			
			$result = $this->db->simpleQuery()->from('messages', array('id'))->order('date','desc')->all();
				
		}
		
		if(!empty($result)){
			foreach ($result as $tab) {
					
				$this->message_m[] = new Message($tab['id']);
					
			}
		}
		
		
		if(!empty($this->message_m) && is_array($this->message_m)) {
			
			
			
			foreach ($this->message_m as $message) {
				
				if($id == $message->getId()){
					
					if($user){
					
						$message->setDisplayUser(false);
					
					}else {
					
						$message->setDisplaySeller(false);
					
					}
					
					$message->writeData(true);
				
				}
				
				if(	!$message->getDisplayUser() && 
					!$message->getDisplaySeller() &&
					$id == $message->getId() 
					){
					
					
					
					$message->delete();
					return;
					
				}
				
			}
			
		}
		
	}

	
	
	
	
	
	
}