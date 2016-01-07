<?php
namespace controllers;

use Lib\Controller;
use Lib\Location;
use Lib\Http;
use Models\Order;
use Models\Messages;
use Models\Message;
use Models\Order_details;
use Models\Orders;

class User extends Controller {
	
	protected $user_m;
	protected $categories;
	protected $d_product;
	protected $category_ids;
	
	public function __construct($action,$args){
		
		
		$this->categories_m = new \models\Categories();
		$this->categories = $this->categories_m->getCategories();
		$this->category_ids = $this->categories_m->getCategoriesIds();
		$this->products_m = new \models\Products();
		$this->d_product = $this->products_m->getDayProduct();
		
		$id = \lib\Register::get('id');
		if(!empty($id)) {
			
			$this->user_m = new \models\User($id);
			$this->user_m->LoadData($id);
			
			
		} else {
			
			Location::To(URL.'home');
			
		}
		
		
		
		parent::__construct($action, $args);
		
	}
	
	protected function def($arg = null) {
		
		$this->profile();
	}
	
	public function profile() {
		
		$personal = array(
				'firstname'=>$this->user_m->getFirstName(),
				'surname'=>$this->user_m->getSurname(),
				'country'=>$this->user_m->getCountry(),
				'zipcode'=>$this->user_m->getZipCode(),
				'city'=>$this->user_m->getCity(),
				'street'=>$this->user_m->getStreet(),
				'house'=>$this->user_m->getHousNr(),
				'appartment'=>$this->user_m->getAppartmentNr(),
				'phone'=>$this->user_m->getPhonNumber(),
				'email'=>$this->user_m->getEmail(),
				'lastvisit'=>$this->user_m->getLastVisit(),
				'registrationdate'=>$this->user_m->getRegistrationDate()
		);
		
			$this->render('user',array(
					'categories'=> $this->categories,
					'd_product'=>$this->d_product,
					'personal_data' => $personal,
					'ids' => $this->category_ids
			));
			
		
	
	}
	
	public function edition() {
		
		$http = new Http();
		if($http->isActive('save')) {
			
				$this->user_m->setFirstName($http->post('firstname'));
				$this->user_m->setSurname($http->post('surname'));
				$this->user_m->setCountry($http->post('country'));
				$this->user_m->setZipCode($http->post('zipcode'));
				$this->user_m->setCity($http->post('city'));
				$this->user_m->setStreet($http->post('street'));
				$this->user_m->setHousNr($http->post('house'));
				$this->user_m->setAppartmentNr($http->post('appartment'));
				$this->user_m->setPhoneNumber($http->post('phone'));
				$this->user_m->setEmail($http->post('email'));
				$this->user_m->writeData(true);
			
		}
		
		$personal = array(
				'firstname'=>$this->user_m->getFirstName(),
				'surname'=>$this->user_m->getSurname(),
				'country'=>$this->user_m->getCountry(),
				'zipcode'=>$this->user_m->getZipCode(),
				'city'=>$this->user_m->getCity(),
				'street'=>$this->user_m->getStreet(),
				'house'=>$this->user_m->getHousNr(),
				'appartment'=>$this->user_m->getAppartmentNr(),
				'phone'=>$this->user_m->getPhonNumber(),
				'email'=>$this->user_m->getEmail()
		);
		
		$this->render('edition',array(
				'categories'=> $this->categories,
				'd_product'=>$this->d_product,
				'personal_data' => $personal,
				'ids' => $this->category_ids
		));
		
		
	}
	
	
	public function last($arg=null) {
		
		
		$http = new Http();
		
		if($http->isActive('to_delete')) {
			
			$to_delete = $http->post('to_delete');
			foreach ($to_delete as $del){
				$detail = new Order_details();
				$detail->deleteOrder($del); 
			}
			Location::To(URL.'user/last');
		}
		
		
		
		$orders = new \Models\Orders( \lib\Register::get('id'));
		

		$pag = new \lib\Pagination(10, $orders->getUserNumberOfOrders());
		
		$orders_array =  $orders->getOrders(10, $pag->page($arg[0]));
		
		
		
		$next = $pag->next();
		$prev = $pag->prev();
		$num_pages = ($pag->getPages());
		$selected = $pag->getSelected();
		
		
		
		$data = array();
		if(!empty($orders_array)) {
		
			foreach ($orders_array as $key => $or) {
				
				
				$id = $or->getOrderDetailsId();
				
				  $detail = new Order_details($id);
				  				  	
					  $data[$key]['id'] = $id;
					  $data[$key]['state'] = $detail->getStatus();
					  $data[$key]['date'] = $detail->getDate();
					  $data[$key]['nr'] = $detail->getOrderNr();
					  
					  
				  
				}
				
			}
			
			
		
		
	
		
		
		$this->render('last',array(
				'categories'=> $this->categories,
				'd_product'=>$this->d_product,
				'orders' => $data,
				'ids' => $this->category_ids,
				'next' => $next,
				'prev' => $prev,
				'num_pages' =>$num_pages,
				'selected' => $selected,
				
		));
		
		
	}
	
	public function details($arg = null) {
		
		$data = array();
		if(!empty($arg[0])){
			
			$order = new Orders();
			$orders = $order->getOrdersByDetailsId($arg[0]);
				
			foreach ($orders as $key => $o) {
				
				$data[$key]['name'] = $o->getProductName();
				$data[$key]['quantity'] = $o->getQuantity();
				$data[$key]['price'] = $o->getPrice();
				$data[$key]['product_id'] = $o->getProductId();
				
			}
			
		}
		
		
		$this->render('order_details',array(
				'categories'=> $this->categories,
				'd_product'=>$this->d_product,
				'orders' => $data,
				'ids' => $this->category_ids
		));
		
		
	}
	
	
	
	public function message($arg=null) {
		
		$http = new Http();
		
		if($http->isActive('del')){
			$message_m = new \Models\Messages(\lib\Register::get('id'));
			
			$to_delete = $http->post('delete');
		
			if(!empty($to_delete) && is_array($to_delete)){
				
				foreach ($to_delete as $nr) {
					
					$message_m->deleteMessages($nr);
					
				}
				
			}
			
			Location::To(URL.'user/message');
		
		}
		
		
		
		if($http->isActive('send')){
				
			$mesage = new Message();
			$mesage->setUserId(\lib\Register::get('id'));
			$mesage->setReaded(false);
			$mesage->setSeller(false);
			$mesage->setMessage($http->post('message'));
			$mesage->setDate();
			$mesage->setDisplayUser(true);
			$mesage->setDisplaySeller(true);
			$mesage->writeData();
			Location::To(URL.'user/message');
			
		
		}
		
		
		
		$message_m = new \Models\Messages(\lib\Register::get('id'));
		$pag = new \lib\Pagination(10, $message_m->getNumberOfMessages());
		$messages = $message_m->getMessages(10, $pag->page($arg[0]));
		
		$messages_array = array();
		
				
		$next = $pag->next();
		$prev = $pag->prev();
		$num_pages = ($pag->getPages());
		$selected = $pag->getSelected();
		
		
		
		if(!empty($messages)) {
		
			foreach ($messages as $key => $m) {
				if($m->getDisplayUser()){
					
					$messages_array[$key]['message'] = $m->getMessage();
					$messages_array[$key]['date']= $m->getDate();
					$messages_array[$key]['seller']= $m->getSeller();
					$messages_array[$key]['readed']= $m->getReaded();
					$messages_array[$key]['id']= $m->getId();
					
				}
			}
		
		}
		
		$this->render('message',array(
				'categories'=> $this->categories,
				'd_product'=>$this->d_product,
				'messages' => $messages_array,
				'login' => \lib\Register::get('login'),
				'ids' => $this->category_ids,
				'next' => $next,
				'prev' => $prev,
				'num_pages' =>$num_pages,
				'selected' => $selected,
		));
		
	
	
	}
	
	public function delete() {
		
		$http = new Http();
		
		
		if($http->isActive('yes')) {
			
			$this->eraseUser();
			
		}
		
		if($http->isActive('no')) {
			
			Location::To(URL.'user/profile');
			
		}
		$this->render('delete',array(
				'categories'=> $this->categories,
				'd_product'=>$this->d_product,
				'ids' => $this->category_ids
				
		));	
		
		
		
		
	}
	
	private function eraseUser() {
		
		$message_m = new \Models\Messages(\lib\Register::get('id'));
		$messages = $message_m->getMessages();
		
		if(!empty($messages)){
			
			foreach ($messages as $message) {
					
				$message_m->deleteMessages($message->getId());
		 
			}
			
		}
		
		$user_e = new \models\User(\lib\Register::get('id'));
		$user_e->delete();
		$user = new \models\Users(\lib\Register::get('id'));
		$user->delete();
		Location::To(URL.'logout');
		
		
	}
	
	
	
}