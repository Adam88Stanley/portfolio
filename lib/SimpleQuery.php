<?php
namespace Lib; 
class SimpleQuery {
	
	private $instance;
	private $table;
	private $fields;
	private $where;
	private $limit;
	private $order;
	private $offset;
	private $direction;
	private $join;
	
	
	public function __construct($instance) {

		$this->instance = $instance;
		
	}
	
	public function from($table, $fields = array('*')) {
		
		if(empty($table)) {
			throw new \Exception('Nieprawid�owy argument');
		}
		
		$this->table = $table;
		$this->fields[$table] = $fields;
		
		return $this;
		
	}
	
	// example where('name=?','age=?','Adam','26', AND) -> WHERE name='ADAM' AND age='26'
	public function where() {
		
		$args = func_get_args();
		$num = func_num_args();
		
		if($num < 2){
			throw new \Exception('Nieprawid�owa liczba argumentow');
		}
		
		if($num == 2) {
			$args[0] = $this->instance->escape($args[0]);
			$args[1] = $this->instance->escape($args[1]);
			$this->where = ' WHERE '.explode('=', $args[0])[0].'='.'\''.$args[1].'\'';
			return $this;
		}
		
		if($num > 2 ) {
			$cond = $args[$num-1]; // ostatni argument = warunek np. AND
			array_pop($args);
		}
		else {
			throw new \Exception('Nieprawid�owa liczba argumentow');
		}
		
		$num_of_repeats = (($num-1)/2);
		for($i = 0; $i < $num_of_repeats; $i++){
			
			$first = $this->instance->escape(explode('=', $args[$i])[0]);
			$second = '\''.$this->instance->escape($args[$num_of_repeats + $i]).'\'';
			$conditions[] = $first.' = '.$second; 
			
		}
		
				
		$this->where = ' WHERE '.implode(' '.$cond.' ', $conditions);
		
		
		return $this;
		 
	}
	
	
	public function join($join, $on) {
		
		if(empty($join)){
			throw new \Exception('Nieprawid�owy argument');
		}
		
		if(empty($on)){
			throw new \Exception('Nieprawid�owy argument');
		}
		
		$this->join = ' JOIN '.$this->instance->escape($join).' ON '.
		$this->instance->escape($on);
		return $this;
		
	}
	
	public function limit($limit, $page=1) {
		
		if(!is_numeric($limit)){
			throw new \Exception('Nieprawid�owy argument');
		}
		
		if(!is_numeric($page)){
			throw new \Exception('Nieprawid�owy argument');
		}
		
		$lim = ' LIMIT '.(($page == 1) ? "" : ($page - 1) * $limit.', ').$this->instance->escape($limit);  
		$this->limit = $lim;
		return $this;
		
	}
	
	public function order($order, $direction = 'asc') {
		
		if(empty($order)){
			throw new \Exception('Nieprawid�owy argument');
		}
		
		$or = ' ORDER BY '.$order.' '.$direction;
		$this->order = $this->instance->escape($or);
		return $this;
		
	}
	
	private function createSelect() {
		
		$select = 'SELECT  ';
		$fields = array('*');
		if($this->fields[$this->table][0]!='*'){
			$fields = array();
			foreach ($this->fields[$this->table] as $field => $alias) {
				if(is_numeric($field)){
					$fields[] = $alias;
				}
				else {
					$fields[] = $field.' AS '.$alias;
				}
			}
		}
		$from = ' FROM '.$this->table;
		$select .= implode(', ', $fields).$from;
		
		if(!empty($this->join)) {
			$select .= $this->join; 
		}
		if(!empty($this->where)){
			$select .= $this->where;
		}
		if(!empty($this->order)){
			$select .= $this->order;
		}
		if(!empty($this->limit)){
			$select .= $this->limit;
		}
		return $select;
		
	} 
	// name=>adam
	private function createInsert($data) {
		
		$insert = 'INSERT INTO '.$this->table;
		$f = array();
		$v = array();
		
		foreach ($data as $field => $value){
			$f[] = $field;
			$v[] = is_numeric($value) ? $value : '\''.$this->instance->escape($value).'\'';
		}
		
		$fields = implode(', ', $f);
		$values = implode(', ', $v);
		
		return $insert .= ' ('.$fields.') VALUES('.$values.')';
		
	}
	
	private function createUpdate($data) {
		
		$update = 'UPDATE '.$this->table.' SET ';
		$st = array();
		
		foreach ($data as $field => $value){

			$v = is_numeric($value) ? $value : '\''.$this->instance->escape($value).'\'';
			$st[] = $field.'='.$v;
			
		}
		
		return  $update .= implode(', ', $st).$this->where; 
		
	}
	
	private function createDelete() {
		
		$delete = 'DELETE FROM '.$this->table;
		$delete .= $this->where;
		return  $delete;
		
	}
	
	public function all() {
		
		$query = $this->createSelect();
		$result = $this->instance->query($query);
		
		if($result === false) {
			return false;
		}
		
		$rows = array();
		
		for ($i=0; $i < $result->num_rows; $i++) {
			
			$rows[] = $result->fetch_assoc();
			
		}
		
		return $rows;
		
	}
	
	public function first($offset = 0) {
		$this->limit(1, 1+$offset);
		return $this->all();
	}
	
	
	
	public function delete() {
		
		$sql = $this->createDelete();
		$result = $this->instance->query($sql);
		
		if($result === false) {
			
			throw new \Exception('Wyst�pi� b��d');
			
		}
		
		return $this->instance->getAffectedRows();
				
	}
	
	public function save($data) {
		
		if(!is_array($data)){
			throw new \Exception('Nieprawid�owy argument');
		}
		$insert = empty($this->where) ? 1 : 0;
		if($insert){
			
			$query = $this->createInsert($data);
		
		}else {
			
			$query = $this->createUpdate($data);
			
		}
		
		$result = $this->instance->query($query);
		
		if($result === false) {
			
			throw new \Exception('Wyst�pi� b��d podczas zapisu');
			
		}
		
		if($insert){
				
			return $this->instance->getLastInsertedId();
			
		}
		
		return $result;
		
	}
	
	
}