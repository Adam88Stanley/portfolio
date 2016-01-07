<?php
namespace Lib;
class DbaseFactory {
	
	protected $type;
	protected $host;
	protected $username;
	protected $password;
	protected $database;
	
	public function __construct($type, $host, $username, $password, $database ) {
		
		$this->type = $type;
		$this->host = $host;
		$this->username = $username;
		$this->password = $password;
		$this->database = $database;
		 	
	}
	
	public function make() {
		
		switch ($this->type){

			case 'mysql':
				return new Mysql($this->host, $this->username, $this->password, $this->database);
				break;
			default:
				throw new Exception('Typ nieobs³ugiwany.');
				break;
				
		}
		
	}
	
}