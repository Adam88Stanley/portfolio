<?php
namespace Lib;
class ORM extends Model {

	
	
	
	
	private $colNames;
	private $key;
	private $values;
	private $id;
	public $table;

	
	
	
	
	public function __construct($table, $id=null) {
		parent::__construct();
		
		$this->table = $table;
		$this->getColNames();
		$this->getPrimaryKey();
		
		if(!empty($id)) {
			
			$this->LoadData($id);
			
			
		}
		
		
		
		
	}

	
	
	
	
	private function getColNames() {
		$result = $this->db->query("SHOW COLUMNS FROM ".$this->table);
		
		while($record = $result->fetch_array()){
			
			$fields[] = $record['0'];
			
		}
		
		foreach ($fields as $value){
			
			$this->colNames[] = $value;
			
		}
	
	}
	
	
	
	
	
	private function getPrimaryKey() {
		
		$result = $this->db->query("SHOW KEYS FROM ".$this->table." WHERE Key_name = 'PRIMARY'");
		$this->key = $result->fetch_array()[4];
		
	}
	
	
	
	
	
	public function writeData($update = false) {
		
		if(!$update) {
			$save = array();
			foreach ($this->colNames as $colName){
				
				$save[$colName] = $this->$colName;
				
			}
			
			 return $this->id = $this->db->simpleQuery()->from($this->table)->save($save);
			 
			
		}else {
			
			$save = array();
			
			foreach ($this->colNames as $colName){
				
				if($colName == $this->key) { 
					
					continue ;
				
				}
				
				$save[$colName] = $this->$colName;
			
			}
				
			 return $this->db->simpleQuery()->from($this->table)->where($this->key.'=?', $this->id)->save($save);
			 
		}
		
	}
	
	
	
	
	
	public function LoadData($key=0) {
		
		if(empty($this->id)) {
			
			$this->id = $key;
			$this->values = $this->db->simpleQuery()->from($this->table)->where($this->key.'=?',$key)->first();
			if(!empty($this->values)) {
				
				foreach ($this->values[0] as $variable => $value){
					$this->$variable = $value;
				}
				
			}
			
		}else {
			
			$this->values = $this->db->simpleQuery()->from($this->table)->where($this->key.'=?',$this->id)->first();
			if(!empty($this->values)) {
				
				foreach ($this->values[0] as $variable => $value){
					
						$this->$variable = $value;
						
				}
				
			}	
		}
		
	}
	
	public function delete(){
		if(!empty($this->id)){
			$this->db->simpleQuery()->from($this->table)->where($this->key.'=?',$this->id)->delete();
		}
	}
	

}