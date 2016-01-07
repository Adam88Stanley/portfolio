<?php
namespace controllers;

use Lib\Controller;
use Lib\Http;
use Lib\Location;
class Login extends Controller {
	
	private $m_login;
	private $http;
	private $errors;
	private $category_ids;

	
	public function __construct(){
		
		parent::__construct();
		
		$this->http = new Http();
		$this->categories_m = new \models\Categories();
		$this->categories = $this->categories_m->getCategories();
		$this->category_ids = $this->categories_m->getCategoriesIds();
		$this->products_m = new \models\Products();
		$this->d_product = $this->products_m->getDayProduct();
		$this->check();
		
		
		

	}
	
	
	
	private function check() {
		
		$admin = \Lib\Session::get('admin');
		$id = \Lib\Session::get('id');
		$login = \Lib\Session::get('login');
		$admin_mode = $this->http->post('admin');
		
		
		if(!$admin) {
				
			if($this->http->isActive('login') && $admin_mode) {
		
				$login = $this->http->post('login');
				$password = $this->http->post('password');
		
				if($login == ADMIN_LOGIN && $password == ADMIN_PASSWORD ) {
						
					\Lib\Session::set('admin', true);
					Location::To(URL.'admin');
						
				}else {
						
					$this->render('Login',array(
							'categories'=> $this->categories,
							'd_product'=>$this->d_product,
							'ids' => $this->category_ids,
							'error' => 'Nieprawidłowa nazwa użytkownika lub hasło.'
					));
						
				}
		
			}
		
				
		}else {
				
			Location::To(URL.'admin');
				
		}
		
		
		
		
		
		if(empty($id) || empty($login)){
		
			if($this->http->isActive('login') && !$admin_mode) {
		
				$this->m_login = new \Models\Login();
		
				if($this->m_login->login($this->http->post('login'), $this->http->post('password'))) {
						
					if($this->m_login->isActivated($this->http->post('login'))) {
						
					\Lib\Session::set('id', $this->m_login->getId());
					\Lib\Session::set('login', $this->m_login->getLogin());
						
					Location::intended(URL.'user');
					
					}else {
						
						$this->render('Login',array(
								'categories'=> $this->categories,
								'd_product'=>$this->d_product,
								'ids' => $this->category_ids,
								'error' => 'Konto jest nieaktywne.'
						));
						
						
					}
					
						
						
				}else {
		
					$this->render('Login',array(
							'categories'=> $this->categories,
							'd_product'=>$this->d_product,
							'ids' => $this->category_ids,
							'error' => 'Nieprawidłowa nazwa użytkownika lub hasło.'
					));
						
				}
		
		
			} else {
					
				$this->render('login',array(
						'categories'=> $this->categories,
						'd_product'=>$this->d_product,
						'ids' => $this->category_ids
				));
		
			}
		
		}else {
				
			Location::To(URL.'user');
				
		}
		
		
	}
	

}