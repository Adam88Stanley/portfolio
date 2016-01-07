<?php
namespace Lib;
class Http {
	
	private $get;
	private $post;
	
	public function __construct() {
		
		
		if(isset($_GET)) {
			
			$this->get = $_GET;
			
			
		}else {
			$this->get = null;
		}
		
		if(isset($_POST)) {
			
			$this->post = $_POST;
			
			
		}else {
			$this->post = null;
		}
		
		
	}
	
	
	public function isActive($key) {
		
		if(isset($_GET[$key]) || isset($_POST[$key])){
			
			return true;
			
		}
		
		return false;
		
	}
	
	
	
	private function cleaner($data) {
		
				if(is_array($data)){
					foreach ($data as $d) {
						$values[] = $this->cleaner($d);
					}
					
					return $values;
				}
				$values = trim($data);
				$values = stripslashes($values);
				$values = htmlspecialchars($values);
				
				
		
			return $values;
	
	}
	
	
	public function get($key = null, $default = null) {
		
		if(!empty($key)) {
			
			if(isset($this->get[$key])) {
				return $this->cleaner($this->get[$key]); 
			} else {
				
				return $default;
				
			}
			
		}
		
		return $this->get;
		
	}
	
	public function post($key = null, $default = null) {
		
		if(!empty($key)) {
				
			if(isset($this->post[$key])) {
				return $this->cleaner($this->post[$key]);
			} else {
			
				return $default;
			
			}
				
		}
		
		return $this->post;
		
	}
	

}