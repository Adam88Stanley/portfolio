<?php
namespace Models;
use Lib\ORM;
class Shippment extends ORM {

	protected $id;
	protected $name;
	protected $cost;
	

	public function __construct($id = null) {
		$this->id = $id;
		parent::__construct('shippment_methods', $id);

	}

	public function getId() {

		return $this->id;

	}

	public function getShippingName() {

		return $this->name;

	}
	
	public function getCost() {
	
		return $this->cost;
	
	}

	
	public function setShippingName($name) {
	
		$this->name = $name;
	
	}
	
	public function setCost($cost) {

		$this->cost = $cost;

	}
	

}