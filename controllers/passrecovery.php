<?php
namespace controllers;

use Lib\Controller;
use Lib\Http;
use Lib\Location;
use Models\Page;
use Models\PasswordRecovery;
use Models\Users;
class PassRecovery extends Controller {
	
	private $categories_m;
	private $categories;
	private $category_ids;
	private $products_m;
	private $d_product;
	private $errors;

	
	public function __construct($action,$args){
		
		$this->categories_m = new \models\Categories();
		$this->categories = $this->categories_m->getCategories();
		$this->category_ids = $this->categories_m->getCategoriesIds();
		$this->products_m = new \models\Products();
		$this->d_product = $this->products_m->getDayProduct();
		
		parent::__construct($action, $args);
		

	}
	
	
	public function recover() {
		
		$http = new Http();
		if($http->isActive('email')) {
			
			
			$password_recovery = new PasswordRecovery($http->get('email'));
			
			if($password_recovery->userExists()) {
				
				$id = $password_recovery->getUserId();
				$rand = rand(1000000, 9999999);
				$time = date("Y-m-d H:i:s");
				
				$password_recovery->setUserToChange($id, $rand, $time);
				
				$email = new \Lib\Email();
				
				$subject = 'Zmiana hasła.';
				$message = 'W celu zmiany hasła kliknij 
				<a href="'.URL.'passrecovery/complete?id='.$id.'&rand='.$rand.'&email='.$http->get('email').'">
				Tutaj</a>';
				$altmessage = 'W celu zmiany hasła odwiedź podany adres: 
				'.URL.'passrecovery/complete?id='.$id.'&rand='.$rand.'
				';
				
				
				
				
				if($password_recovery && $email->send($http->get('email'), $subject, $message, $altmessage)){

					$this->render('passrecovery', array(
							'categories'=> $this->categories,
							'd_product'=>$this->d_product,
							'success' =>true
					));
					
					
				}else {
					
					Location::To(URL.'error');
					
				}
					
				
			} else {
				
				
				$this->render('passrecovery', array(
						'categories'=> $this->categories,
						'd_product'=>$this->d_product,
						'error' =>'Nie ma takiego użytkownika.'
				));
				
				
			}
			
			
		}else {
		
		
			$this->render('passrecovery', array(
				'categories'=> $this->categories,
				'd_product'=>$this->d_product
				));
		
		}
		
		
		
		
	}
	
	
	
	public function complete() {
		
		$http = new Http();
		
		$id = $http->get('id');
		$rand = $http->get('rand');
		$email = $http->get('email');
		
		if($http->isActive('change')){
			
			$id = $http->post('id');
			$rand = $http->post('rand');
			$email = $http->post('email');

		}
		
		
		if(!empty($id) && !empty($rand) && $email) {
			$pass = new \models\PasswordRecovery($email);
			if($pass->checkUserToChange($id, $rand)) {
				
				if($http->isActive('change')) {
					
					$pass_1 = $http->post('password');
					$pass_2 = $http->post('password_2');
 					
					
					$passVal = new \lib\PassVal("Nieprawidłowe hasło", "Hasła nie są takie same.", 5 , 15);
					$validator = new \lib\Validator(array(
							'password' =>$passVal,
							'password_2' =>$passVal
					));
						
					if($validator->validate($http->post())) {
					
						$user = new Users($id);
						$user->setPassword($pass_1);
						$user->writeData(true);
						$pass->deleteUserToChange($id);
						
						
						$message = 'Twoje hało zostalo zmienione .';
						Location::To(URL.'success/success/'.$message);
					
					
					}else {
						
						$this->errors = $validator->getErrors();
						$this->render('changepassword', array(
								'categories'=> $this->categories,
								'd_product'=>$this->d_product,
								'id' => $id,
								'rand' => $rand,
								'email' => $email,
								'errors' => $this->errors
						));
						
					}
					
					
				}
				
				$this->render('changepassword', array(
						'categories'=> $this->categories,
						'd_product'=>$this->d_product,
						'id' => $id,
						'rand' => $rand,
						'email' => $email
				));
				
			}else {
				
				Location::To(URL.'error');
				
			}
			
		}else {
			
			Location::To(URL.'error');
			
		}
			
	}
	
	
	
	
}