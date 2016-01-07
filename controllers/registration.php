<?php
namespace controllers;

use Lib\Controller;

use Lib\Http;
use Lib\Validator;
use Lib\Location;
use Lib\Email;
class Registration extends Controller {

	private $errors;
	private $category_ids;
	private $id;
	
	
	public function __construct(){
		
		if(\Lib\LoginVal::isLogged()){
				
			Location::To(URL.'user');
			
		}

		parent::__construct();
		
		$http = new Http();
		
		$this->categories_m = new \models\Categories();
		$this->categories = $this->categories_m->getCategories();
		$this->products_m = new \models\Products();
		$this->d_product = $this->products_m->getDayProduct();
		$this->category_ids = $this->categories_m->getCategoriesIds();
		
		
		
		if(!$http->isActive('login')) {
			
			$this->render('register',array(
							'categories'=> $this->categories,
							'd_product'=>$this->d_product,
							'ids' => $this->category_ids
					));
			
			
		}else {
			$passVal = new \lib\PassVal("Nieprawidłowe hasło", "Hasła nie są takie same.", 5 , 15);
			$validator = new Validator(array(
				'login' =>new \lib\LoginVal("Podana nazwa użytkownika jest zajęta.","Nieprawidłowa nazaw użytkownika.", 5, 15 ),
				'email'=>new \lib\EmailVal("Nieprawidłowy email."),
				'password' =>$passVal,
				'password_2' =>$passVal,
				'accept' => new \lib\CheckBoxVal("Nie zaznaczono pola z akceptacją regulaminu.")
				
			));
			
			if($validator->validate($http->post())) {
				
				$this->register($http->post());
				
				$user = new \models\User($this->id);
				$date = $user->getRegistrationDate();
				$subject = 'Aktywacja Konta';
				$message = 'W celu aktywowania Konta kliknij 
						<a href="'.URL.'activation/activate?id='.$this->id.'&register='.$date.'">Tutaj</a>';
				$altmessage = 'W celu aktywacji konta odwiedź podany adres:'.URL.'activation/activate?id='.$id.'&register='.$date;  
				
				$email = new Email();
				
				if($email->send($http->post('email'), $subject, $message, $altmessage)){
				
					Location::To(URL.'success/success/Sprawdź email w celu aktywacji konta.');
				
				}else {
					
					Location::To(URL.'error');
					
				}
				
			}else {
				
				$this->errors = $validator->getErrors();
				$this->render('register', array(
							'categories'=> $this->categories,
							'd_product'=>$this->d_product,
							'ids' => $this->category_ids,
							'errors' => $this->errors
					));
				
				
				
			}
			
		}
	
	}
	
	private function register($data) {
		
		$m_register = new \models\Registration();
		$id = $m_register->register($data);
	    $user_m = new \models\User($id);
		$user_m->setRegistrationDate();
		$user_m->writeData();
		$this->id = $id;
		
	}

	
	

}