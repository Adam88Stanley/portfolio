<?php
namespace controllers;

use Lib\Controller;
use Lib\Register;
use Lib\Http;
use Models\Product;
use Models\Order;
use Lib\Location;
use Lib\LoginVal;
use Models\User;
use Models\Order_details;
use Models\Shippment;
use Models\Shippments;
use Models\Message;
class Cart extends Controller {
	
	protected $http;
	private $products;
	
	
	
	
	public function __construct($action,$args){
		
		$this->http = new Http();
		parent::__construct($action, $args);
		
	}
	
	
	public function mod() {
		
		
		$add = $this->http->isActive('add');
		$sub = $this->http->isActive('sub');
		
		if($add) {
			
			$this->addToCart();
			
		}else if($sub) {
			
			$this->removeFromCart();
			
		}else {
			
			Location::To(URL.'cart/show');
			
		}
		
		
	}
	
	
	
	
	public function addToCart() {
		
		
		
		$product_id = $this->http->get('product_id');
		$product_name = $this->http->get('product_name');
		$product_quantity = $this->http->get('product_quantity');
		$product_price = $this->http->get('product_price');
		
		$product = new Product($product_id);
		
		
		if(!empty($product)) {
			
			$db = Register::get('db');
			$quantity = $product->getQuantity();
			
			if($quantity > 0 && $quantity >= $product_quantity && $product_quantity >=0) {
				
				$product->setQuantity($quantity - $product_quantity);
				
				$product->changeProductSold($product_quantity);
				
				$cart = \Lib\Session::get('cart');
				
				
				if(!empty($cart)){
						
					foreach ($cart as $p){
				
						if($p['product_id'] == $product_id){
								
							$order = new Order($p['order_id']);
							if($order->getQuantity()){
								
								$quantity = $order->getQuantity();
								$order->setQuantity(($quantity + $product_quantity));
								$db->query('START TRANSACTION');
				
								if($product->writeData(true) && $order->writeData(true)){
									
									$order_id = $db->getLastInsertedId();
									$db->query('COMMIT');
									\Lib\Session::set( 'cart', array(
											'order_id' => $order_id,
											'product_id' => $product_id
									), 2);
									
								}else {
									
									$db->query('ROLLBACK');
									
								}
								
								$this->ActNumberOfProducts();
								Location::To(URL.'cart/show');
								
								
							}
							
						}
				
					}
						
				}
				
				
				$order = new Order();
				$order->setDate();
				$order->setActive(false);
				$order->setProductId($product_id);
				$order->setProductName($product_name);
				$order->setQuantity($product_quantity);
				$order->setPrice($product->getPrice());
				$order->setStatus(1);
				
				
				$db->query('START TRANSACTION');
				
				if($product->writeData(true) && $order->writeData()){
					$order_id = $db->getLastInsertedId();
					$db->query('COMMIT');
					\Lib\Session::set( 'cart', array(
							'order_id' => $order_id,
							'product_id' => $product_id
					), 2);
					
				}else {
					
					$db->query('ROLLBACK');
					
				}
				
				$this->ActNumberOfProducts();
				 \Lib\Location::To(URL.'cart/show');
				
			} else {
				
				 \Lib\Location::To(URL.'cart/show');	
				
			}
				
		}
		
	}
	
	
	
	
	public function removeFromCart() {
		
		$cart = \Lib\Session::get('cart');
		
		
		$db = Register::get('db');
		
		$product_id = $this->http->get('product_id');
		$product_quantity = $this->http->get('product_quantity');
		
		if($product_quantity < 1){
			
			Location::To(URL.'cart/show');

		}
			
		$product = new Product($product_id);
		
		
		if(!empty($cart)) {
			
			foreach ($cart as $p) {
				
				if($p['product_id'] == $product_id){
					
					$orders = new Order($p['order_id']);
					$quantity = $orders->getQuantity();
					if($quantity >= $product_quantity) {
						
						$orders->setQuantity($quantity - $product_quantity);
						
						$p_q = $product->getQuantity();
						$product->setQuantity($p_q + $product_quantity);
						
						$product->changeProductSold(-$product_quantity);
						
						$db->query('START TRANSACTION');
						
						if($product->writeData(true) && $orders->writeData(true)){
							
							$db->query('COMMIT');
							
						}else {
							
							$db->query('ROLLBACK');
							
						}
						if($orders->getQuantity()==0){
							
							
							$orders->delete();
							
							
							
						}
						
					}
					
				}
				
			}
			
		}
		
		$this->ActNumberOfProducts();
		Location::To(URL.'cart/show');
		
	}
	
	
	
	
	
	
	public function show() {
		
		$this->categories_m = new \models\Categories();
		$this->categories = $this->categories_m->getCategories();
		$this->category_ids = $this->categories_m->getCategoriesIds();
		$this->products_m = new \models\Products();
		$this->d_product = $this->products_m->getDayProduct();
		
		
		$cart = \Lib\Session::get('cart');
		$cart_data = array();
		$shippments_m = new Shippments();
		$shippments = $shippments_m->getShippmentMethods();
		$ship_array = array();
		
		foreach ($shippments as $k => $m){
			$ship_array[$k]['id'] = $m->getId();
			$ship_array[$k]['cost'] = $m->getCost();
			$ship_array[$k]['shipping_name'] = $m->getShippingName();
		}
		
		if(!empty($cart)){
			
			foreach ($cart as $key => $product){
				$order = new Order($product['order_id']);
				if(!$order->getQuantity()){
					continue;
				}
				$cart_data[$key]['product_id'] = $order->getProductId();
				$cart_data[$key]['product_name'] = $order->getProductName();
				$cart_data[$key]['product_price'] = $order->getQuantity()*$order->getPrice();
				$cart_data[$key]['product_quantity'] = $order->getQuantity();
			}
			
			
		}
		
		
		
		$this->render('cart',array(
				'categories'=> $this->categories,
				'd_product'=>$this->d_product,
				'shipping' => $ship_array,
				'cart_data'=> $cart_data,
				'ids' => $this->category_ids
				
		));
		
		
	}
	
	
	
	
	public function purchuase() {
		
		
		if(LoginVal::isLogged()) {
			
			$this->confirm();
			
			
		}else {
			
			\Lib\Session::set('intended', URL.'cart/purchuase');
			Location::To(URL.'login');
			
			
		}
		
		
	}
	
	
	
	private static function ActNumberOfProducts(){
		$p = 0;
		$cart = \Lib\Session::get('cart');
		if(!empty($cart)){
				
			foreach ($cart as $key => $product){
				
				$order = new Order($product['order_id']);
				if(!$order->getQuantity()){
					continue;
				}
				$p += $cart_data[$key]['product_quantity'] = $order->getQuantity();
			}	
		}
		
		\lib\Session::set('cart_num_of_products', $p);
	}
	
	
	
	public static function getNumberOfProducts(){
		
		$p  = \lib\Session::get('cart_num_of_products');
		
		return $p;
		
	}
	
	
	private function confirm(){
		
		
		if($this->http->isActive('accept')){
			
			if($this->finalize()){
				
				Location::To(URL.'user/last');
				
			}else {
				
				//Location::()
				
			}
			
			
		}
		
		
		
		$user = new User(\Lib\Session::get('id'));
		
		$shippment = array();
		$name = $user->getFirstName();
		$surname = $user->getSurname();
		$country = $user->getCountry();
		$zipcode = $user->getZipCode();
		$city = $user->getCity();
		$street = $user->getStreet();
		$house = $user->getHousNr();
		$appartment = $user->getAppartmentNr();
		
		$shippment = array($name, $surname, $country, $zipcode, $city, $street, $house, $appartment);
		
		foreach ($shippment as $data) {
			
			if(empty($data)) {

				Location::To(URL.'user/edition');
				
			}
			
		}
		
		
		$cart = \Lib\Session::get('cart');
		
		$price = 0;
		$cart_data = array();
		
		if(!empty($cart)) {
			foreach ($cart as $key => $product) {
				$order = new Order($product['order_id']);
				if(!$order->getQuantity()){
					continue;
				}
				$order->setUserId(\Lib\Session::get('id'));
				$price += ($order->getQuantity()*$order->getPrice()); 
				$order->writeData(true);
				$cart_data[$key]['product_name'] = $order->getProductName();
				$cart_data[$key]['product_price'] = $order->getQuantity()*$order->getPrice();
				$cart_data[$key]['product_quantity'] = $order->getQuantity();
			}
		
		
		}
		
		$this->categories_m = new \models\Categories();
		$this->categories = $this->categories_m->getCategories();
		$this->category_ids = $this->categories_m->getCategoriesIds();
		$this->products_m = new \models\Products();
		$this->d_product = $this->products_m->getDayProduct();
		$shipping_method = $this->http->get('shipping_method');
		$shipping = new Shippment($shipping_method);
		$shipping_cost = $shipping->getCost();
		
		if(empty($shipping_cost)){
			
			Location::To(URL.'cart/show');
			
		}
		
		$method = $this->http->get('shipping_method');
		
		$this->render('confirm',array(
				'categories'=> $this->categories,
				'd_product'=>$this->d_product,
				'shippment'=> $shippment,
				'price'=>$price,
				'shipping_cost'=>$shipping_cost,
				'cart_data'=> $cart_data,
				'method' =>$method,
				'ids' => $this->category_ids
		));
		
		
		
	}
	
	
	
	
	private function finalize() {
		
		$user = new User(\Lib\Session::get('id'));
			
		$name = $user->getFirstName();
		$surname = $user->getSurname();
		$country = $user->getCountry();
		$zipcode = $user->getZipCode();
		$city = $user->getCity();
		$street = $user->getStreet();
		$house = $user->getHousNr();
		$appartment = $user->getAppartmentNr();
		
		$order_details = new Order_details();
		$order_details->setAddress(
				'Imie: '.$user->getFirstName().
				' Nazwisko: '.$user->getSurname().
				' Kraj: '.$user->getCountry().
				' Kod-Pocztowy: '.$user->getZipCode().
				' Miasto: '.$user->getCity().
				' Ulica : '.$user->getStreet().
				' Nr domu: '.$user->getHousNr().
				' Nr mieszkania: '.$user->getAppartmentNr()
		);
		
		$time = time();
		$id = \Lib\Session::get('id');
		$rand = rand(1, 100);
		$nr = $id.$time.$rand;
		$order_details->setOrderNr($nr);
		$order_details->setDisplaySeller(true);
		$order_details->setDisplayUser(true);
		$sm = $this->http->get('shipping_method');
		
		if(empty($sm)){
			
			Location::To(URL.'cart/show');
			
		}
		
		$order_details->setShippingMethodId($sm);
		$order_details->setDate();
		$order_details->setStatus(1);
		
		$cart = \Lib\Session::get('cart');
		if(!empty($cart)) {
			
			$db = Register::get('db');
			$db->query('START TRANSACTION');
			
			$id = $order_details->writeData();
			
			foreach ($cart as $product) {
				
				$order = new Order($product['order_id']);
				$order->setActive(1);
				$order->setOrderDetailsId($id);
				$order->writeData(true);
				
				if(!$order->writeData(true)){
					
					$db->query('ROLLBACK');
					
					return false;
					
				}
				
			}
			
			
			
			if($id){
			
				$db->query('COMMIT');
				
			}else {
				
				$db->query('ROLLBACK');
				
				return false;
				
			}
			
			$mess = $this->http->get('message');
			
			if(!empty($mess)) {
				
				$mesage = new Message();
				$mesage->setUserId(\lib\Register::get('id'));
				$mesage->setReaded(false);
				$mesage->setSeller(false);
				$mesage->setMessage($order_details->getOrderNr().': '.$this->http->get('message'));
				$mesage->setDate();
				$mesage->setDisplayUser(true);
				$mesage->setDisplaySeller(true);
				$mesage->writeData();
				
			}
			
			
			\Lib\Session::delete('cart');
			$this->ActNumberOfProducts();
			return true;
			
		}
	}
	
	
}