<?php
namespace Lib;
class Mysql extends Connector implements i_Dbase {
	
	
	private $host;
	private $username;
	private $password;
	private $database;
	private $connected;
	private $instance;
	
	
	
	public function __construct($host, $username, $password, $database) {
		
		$this->host = $host;
		$this->username = $username;
		$this->password = $password;
		$this->database = $database;
		
	}
	
	
	
	
	private function isConnected(){
		
		$instance = !empty($this->instance);
		
		if($this->connected && $instance){
				
			return true;
			
		} else {
			
			return false;
		}
		
	}
	
	
	
	
	public function connect(){
		
		if(!$this->isConnected()){
			$this->instance = new \MySQLi($this->host, $this->username, $this->password, $this->database);
			$this->instance->set_charset("utf8");
			$this->connected = true;	
		}
		return $this;
	}
	
	
	
	
	public function disconnect() {
		
		if($this->isConnected()){

			$this->instance->close();
			$this->connected = false;
			
		}
		
		return $this;
		
	}
	
	
	
	
	public function simpleQuery() {
		
		if($this->isConnected()){
			
			return new SimpleQuery($this);
			
		}else {
			
			throw new \Exception("Brak po��czenia z baz� danych");
		
		}
		
	}
	
	
	
	public function query($query) {
		
		if($this->isConnected()){
			
			return $this->instance->query($query);
				
		}else {
				
			throw new \Exception("Brak po��czenia z baz� danych");
		
		}
		
	}
	
	
	public function getAll($query) {
	
		$result = $this->query($query);
	
		if($result === false) {
			return false;
		}
	
		$rows = array();
	
		for ($i=0; $i < $result->num_rows; $i++) {
				
			$rows[] = $result->fetch_assoc();
				
		}
	
		return $rows;
	
	}
	
	
	
	public function escape($value) {
		
		if($this->isConnected()){

			return $this->instance->real_escape_string($value);
			
		}else {
				
			throw new \Exception("Brak po��czenia z baz� danych");
		
		}
		
	}
	
	
	
	
	public function getLastInsertedId() {
		
		if($this->isConnected()){
			
			return $this->instance->insert_id;
				
		}else {
				
			throw new \Exception("Brak po��czenia z baz� danych");
		
		}
		
	}
	
	
	
	public function getLastError() {
		
		if($this->isConnected()){

			return $this->instance->error;
			
		}else {
				
			throw new \Exception("Brak po��czenia z baz� danych");
		
		}
		
	}
	
	
	
	
	public function getAffectedRows(){
		
		if($this->isConnected()){
			
			return $this->instance->affected_rows;
				
		}else {
				
			throw new \Exception("Brak po��czenia z baz� danych");
		
		}
	}
	
}