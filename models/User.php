<?php
namespace Models;
use Lib\ORM;
class User extends ORM {
	
	protected $user_id;
	protected $firstname;
	protected $surname;
	protected $country;
	protected $city;
	protected $house_nr;
	protected $appart_nr;
	protected $zip_code;
	protected $street;
	protected $phone_nr;
	protected $registration_date;
	protected $last_visit;
	protected $photo;
	protected $email;
	protected $users_m;
	
	protected $history;
	protected $comments;
	protected $interests;
	protected $cart;
	
	
	public function __construct($id=null) {
		
		parent::__construct('users_extensions', $id);
		if(!empty($id)) {
			$this->users_m = new Users();
			$this->users_m->LoadData($id);
			$this->email = $this->users_m->getEmail();
			
			$this->user_id = $id;
		}
	}
	
	
	public function getId() {
		
		return $this->id;
		
	}
	
	public function getFirstName() {
		
		return $this->firstname;
		
	}
	
	public function getSurname() {
		
		return $this->surname;
		
	}
	
	public function getCountry() {
		
		return $this->country;
		
	}
	
	public function getCity() {
		
		return $this->city;
		
	}
	
	public function getHousNr() {
		
		return $this->house_nr;
		
	}
	
	public function getAppartmentNr() {
		
		return $this->appart_nr;
		
	}
	
	public function getRegistrationDate() {
		
		return $this->registration_date;
		
	}
	
	public function getLastVisit() {
		
		return $this->last_visit;
	}
	
	public function getPhoto() {
		
		return $this->photo;

	}
	
	public function getPhonNumber() {
		
		return $this->phone_nr;
		
	}
	
	
	public function getHistory() {
		
		return $this->history;
		
	}
	
	public function getComments() {
		
		return $this->comments;
		
	}
	
	public function getCart() {
		
		return $this->cart;
	}
	
	public function getZipCode() {
		
		return $this->zip_code;
		
	}
	
	public function getStreet() {
		
		return $this->street;
		
	}
	
	public function getEmail() {
		
		return $this->email;
		
	}
	
	public function setFirstName($firstName){
		
		$this->firstname = $firstName;
	
	}
	
	public function setSurName($surName){
	
		$this->surname = $surName;
		
	
	}
	
	
	public function setCountry($country){
	
		$this->country = $country;
		
	}
	
	public function setCity($city){
	
		$this->city = $city;
	
	}
	
	public function setHousNr($house_nr){
	
		$this->house_nr = $house_nr;
	
	}
	
	public function setAppartmentNr($appartment_nr){
	
		$this->appart_nr = $appartment_nr;
	
	}
	
	public function setZipCode($zip_code) {
		
		$this->zip_code = $zip_code;
		
	}
	
	public function setStreet($street) {
		
		$this->street = $street;
		
	}
	
	public function setPhoneNumber($phone_number) {
		
		$this->phone_nr = $phone_number;
		
	}
	
	public function setRegistrationDate() {
		
		$date = date("Y-m-d H:i:s");
		$this->registration_date = $date;
		
	}
	
	public function setLastVisit() {
		
		$date = date("Y-m-d H:i:s");
		$this->last_visit = $date;
		
	}
	
	public function setPhoto($photo) {
		
		$this->photo = $photo;
		
	}
	
	public function setEmail($email) {
		$this->users_m->setEmail($email);
		$this->users_m->writeData(true);
	}
	
	public function deleteUser() {
		
		$register = new Registration($this->user_id);
		$register->delete();
		$this->delete();
		
		/// redirect tologout
		
	}
	
	
	
	
}