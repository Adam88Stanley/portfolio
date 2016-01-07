<?php
namespace controllers;

use Lib\Controller;
use Models\Categories;
use Models\Category;
use Models\SubCategories;
use Models\SubCategory;
use Models\CategoryPage;
use Models\CategoryPageNames;
use Models\Page;
use Lib\Http;
use Models\Messages;
use Models\Message;
use Models\User;
use Models\Users;
use Models\Orders;
use Models\Order_details;
use Models\Order;
use Models\Shippments;
use Models\Shippment;
use Models\Products;
use Models\Product;
use Models\ProductAdditionalImages;
use Models\ProductAdditional;
use Models\Promotion;
use Models\Promotions;
use Models\Logo;
use Models\Slider;
use Models\Comments;


class Admin extends Controller {
	
	public function __construct($action, $args){
		
		parent::__construct($action, $args);
		
	}

	protected function def($arg=null) {
		
		$this->panel();
		
	}
	
	public function panel() {
		$mess_m = new Messages();
		$messages_m = new Orders("noload");
		$return = $messages_m->getMaxValueOfOrderId();
		$this->render('admin', array('maxid'=>$return ,'unreaded' => $mess_m->getNumberOfUnreaded()));
		
	}
	
	/////////////////////////////////////////// CATEGORY
	
	public function category() {
		
		$categories_m = new Categories();
		$cats = $categories_m->getCategories();
		$sub_categories = new SubCategories();
		$sub_cats = $sub_categories->getSubCategories();
		
		$cats_array = array();
		
		if(!empty($cats)) {
			
			foreach ($cats as $key => $c) {
				
				$cats_array[$key]['name'] = $c->getCategoryName();
				$cats_array[$key]['id'] = $c->getCategoryId();
				
			}
		
		}
		
		
		$sub_cats_array = array();
		
		if(!empty($sub_cats)) {
				
			foreach ($sub_cats as $key => $c) {
		
				$sub_cats_array[$key]['name'] = $c->getSubCategoryName();
				$sub_cats_array[$key]['id'] = $c->getSubCategoryId();
		
			}
		
		}
		
		
		echo $this->render('admincategory', array(
				'categories'=>$cats_array,
				'sub_categories' => $sub_cats_array));
		
	
	}
	
	
	
	public function test() {
		
		$v = $_POST['val'];
		$id =  $_POST['id'];
		
		$category = new Category($id);
	   	$old_name = $category->getCategoryName();
	   	$new_name = $v;
	   	if(!empty($new_name) && !empty($old_name)) {
	   		
	   		$category->setCategoryName($new_name);
	   		$category->writeData(true);
	   		echo $new_name;
	   		
	   	}else {
	   		
	   		echo $old_name;
	   		
	   	}
		
	   	
	}
	
	
	public function test2() {
	
		$v = $_POST['val'];
		$id =  $_POST['id'];
		
	
		$category = new SubCategory($id);
		$old_name = $category->getSubCategoryName();
		$new_name = $v;
		if(!empty($new_name) && !empty($old_name)) {
	
			$category->setSubCategoryName($new_name);
			$category->writeData(true);
			echo $new_name;
	
		}else {
	
			echo $old_name;
	
		}
	
	}
	
	
	public function add_delete_cat() {
		
		$id = $_POST['id'];
		if($id) {
			$category = new Category($id);
			$category->delete();
			echo '';
			return true;
		}	
			
		 $v = $_POST['val'];
		 $category = new Category();
		 $category->setCategoryName($v);
		 $id = $category->writeData();
		 $return['id'] = $id;
		 $return['v'] = $v;
		 echo json_encode($return);
		
	}
	
	
	public function add_delete_subcat() {
	
		$id = $_POST['id'];
		if($id) {
			$subcategory = new SubCategory($id);
			$subcategory->delete();
			echo '';
			return true;
		}
			
		$v = $_POST['val'];
		$subcategory = new SubCategory();
		$subcategory->setSubCategoryName($v);
		$id = $subcategory->writeData();
		$return['id'] = $id;
		$return['v'] = $v;
		echo json_encode($return);
	
	}
		
/////////////////////////////////////	PAGE	
	
	
	
	public function page() {
		
		$category_page_m = new CategoryPage();
		$category_page_names = $category_page_m->getCategoryPageNames();
		$pages = $category_page_m->getAllPages();
		
		$category_page_array = array();
		$pages_names_array = array();
		
		if(!empty($category_page_names)) {
			
			foreach ($category_page_names as  $key =>$cat_name) {
				
				$category_page_array[$key]['name'] = $cat_name->getCategoryName();
				$category_page_array[$key]['id'] = $cat_name->getCategoryId();
			}
			
		}
		
		
		if(!empty($pages)) {

			foreach ($pages as $key => $page_name) {
		
				$pages_names_array[$key]['name'] = $page_name->getPageName();
				$pages_names_array[$key]['id'] = $page_name->getId();
		
			}
				
		}
		
		echo $this->render('adminpage',
				array('category_page_names' => $category_page_array,
					  'pages_names' => $pages_names_array
				));
		
		
	}
	
	public function editCategoryPageName() {
		
	
		$v = $_POST['val'];
		$id =  $_POST['id'];
		
		$category = new CategoryPageNames($id);
	   	$old_name = $category->getCategoryName();
	   	$new_name = $v;
	   	if(!empty($new_name) && !empty($old_name)) {
	   		
	   		$category->setCategoryName($new_name);
	   		$category->writeData(true);
	   		echo $new_name;
	   		
	   	}else {
	   		
	   		echo $old_name;
	   		
	   	}
		
		
		
	}
	
	
	public function addNewPage() {
		
		$category =  $_POST['category'];
		$page_name = $_POST['page_name'];
		$title = $_POST['title'];
		$header = $_POST['header'];
		$style = $_POST['style'];
		$content =$_POST['content'];
		
		if(!empty($category) && !empty($page_name)  && !empty($title) && !empty($content)) {
			
			$page = new Page();
			$cat = new CategoryPage();
			$page->setPageName($page_name);
			$page->setTitle($title);
			$page->setHeader($header);
			$page->setStyle($style);
			$page->setContent($content);
			$id = $page->writeData();
			$cat->includePage($category, $id );
			
			echo $id;
			
		}else {
			
			echo false;
			
		}
		
	}
	
	
	public function editPage() {
		
		$return = array();
		
		
		$empty = $_POST['page_to_edid_id'];
		if(!empty($empty)){
			
			$page_id = $_POST['page_to_edid_id'];
			$page = new Page($page_id);
			$cat = new CategoryPage();
			
			$page_name = $_POST['page_name'];
			$title = $_POST['title'];
			$header = $_POST['header'];
			$style = $_POST['style'];
			$content =$_POST['content'];
			
			$page->setPageName($page_name);
			$page->setTitle($title);
			$page->setHeader($header);
			$page->setStyle($style);
			$page->setContent($content);
			$page->writeData(true);
			$cat->excludePage($page_id);
			$cat->includePage($_POST['category'], $page_id);
			echo '';
			return true;
		
		}
		
		
		
		
		$http = new Http();
		
		$id = $http->post('id');
		
		$page = new Page($id);
		$cat = new CategoryPage();
		$return['category'] = $cat->getMembershipId($id);
		$return['page_name'] = $page->getPageName();
		$return['title'] = $page->getTitle();
		$return['header'] = $page->getHeader();
		$return['style'] = $page->getStyle();
		$return['content'] =$page->getContent();
		
		echo json_encode($return);
		
		
	}
	
	
	public function deletePage() {
		
		$http = new Http();
		$id = $http->post('id');
		$page = new Page($id);
		$cat = new CategoryPage();
		$page->delete();
		$cat->excludePage($id);
		
		
	}
	
	
	///////////////////////////////////////message
	
	public function messages() {
		
		$user_m = new Users();
		$users = $user_m->getAllUsers();
		$messages_m = new Messages();
		$messages = $messages_m->getMessages(false,false,true);
		$messages_array = array();
		
		
		foreach($messages as $key => $m) {
			$messages_array[$key]['id'] = $m->getId();
			$messages_array[$key]['isseller'] = $m->getSeller();
			$messages_array[$key]['readed'] = $m->getReaded();
			$messages_array[$key]['message'] = $m->getMessage();
			$messages_array[$key]['date'] = $m->getDate();
			$messages_array[$key]['display'] = $m->getDisplaySeller();
			$author = new Users($m->getUserId());
			$messages_array[$key]['author'] = $author->getLogin();
			
			
		}
		
		
		$users_array = array();
		foreach($users as  $key => $u) {
			
			$users_array[$key]['login'] = $u->getLogin();	
			$users_array[$key]['id'] = $u->getId();
		}
		
		
		
		echo $this->render('adminmessages', array(
				'message_data'=>$messages_array,
				'users' => $users_array
		));
		
		
		
		
	}
	
	
	
	
	public function checkingNewMessages() {
		
		$http = new Http();
		
		if($http->post('max')) {
			$return = array();
			$messages_m = new Messages("noload");
			$return['unreaded'] = $messages_m->getNumberOfUnreaded();
		 	$return['maxid'] = $messages_m->getMaxValueOfMessageId();
		 	echo json_encode($return);
			
			return;
		}
		
		$messages_m = new Messages("noload");
		$messages = $messages_m->checkingNewMessages($http->post('v'));
		
		$return = array();
		foreach ($messages as $key => $m) {
			
			if($m->getReaded()|| $m->getSeller() || !$m->getDisplaySeller()) {continue;}
				$user = new Users($m->getUserId());
				$return[$key]['author'] = $user->getLogin();
				$return[$key]['message'] = $m->getMessage();
				$return[$key]['date'] = $m->getDate();
				$return[$key]['id'] = $m->getId();
				
			
		}
		
		echo json_encode($return);
	}
	
	
	public function message() {
		
		$http = new Http();
		$id = $http->post('id');
		
		if($http->isActive('user_id')) {
			
			$user_id = $http->post('user_id');
			$user = new Users($user_id);
			$messages_m = new Messages($user_id);
		
		}
		else {
			
			$message_m = new Message($id);
			$message_m->setReaded(true);
			$message_m->writeData(true);
			$messages_m = new Messages($message_m->getUserId());
			$user = new Users($message_m->getUserId());
		
		}
		$messages = $messages_m->getMessages(false,false,true);
		$array_messages = array();
		
		if(!empty($messages)){
			foreach ($messages as $key => $m){
				
				if(!$m->getDisplaySeller()){
					
					continue;
					
				}
				
				$array_messages[$key]['id'] = $m->getId();
				$array_messages[$key]['message'] = $m->getMessage();
				$array_messages[$key]['date'] = $m->getDate();
				
			}
		}
		
		
		echo $this->render('adminmessage',
				array('messages' => $array_messages,
				'user' => $user->getLogin(),
				'user_id' => $user->getId()
				));
		
		
		
		
		
	}
	
	
	
	public function sendMessage() {
		
		
		$http = new Http();
		$to_user = $http->post('message_to_user');
		$message = $http->post('message');
		if(!empty($to_user) && !empty($message)) {
			
			$message_m = new Message();
			$message_m->setUserId($to_user);
			$message_m->setSeller(true);
			$message_m->setMessage($message);
			$message_m->setReaded(false);
			$message_m->setDate();
			$message_m->setDisplayUser(true);
			$message_m->setDisplaySeller(true);
			$message_m->writeData();
			
			echo "Wiadomość została wysłana.";
			
		}else {
			
			
			echo "Wiadomość nie została wysłana.";
			
		}
	
	}
	
	public function deleteMessage() {
		
		$http = new Http();
		$items_to_delete = $http->post('to_delate');
		$id_user = $http->post('id_user');
		$messages_m = new Messages($id_user);
		
		
		foreach ($items_to_delete as $item) {
			
			$messages_m->deleteMessages($item, false);
			
			
		}
		
		
		
	}
	
	///////////////////////////////////////////////orders
	
	public function orders() {
		
		$http = new Http();
		
		if($http->isActive('status')){
			
			$id = $http->post('id');
		    $status = $http->post('status');
			$ord_det = new Order_details($id);
			$ord_det->setStatus($status);
			$ord_det->writeData(true);
				
		}
		
		if($http->isActive('to_delete')){
			
			$to_delete = $http->post('to_delete');
			$this->deleteOrder($to_delete);
			
		}
		
		
		
		$orders_array = array();
		$completed_array = array();
		$or_det = new Order_details();
		
		$new_orders = $or_det->getNewOrders(2,1);
		
		$completed_orders = $or_det->getCompletedOrders(2,1);
		
		
		foreach ($new_orders as $key => $o) {
				
					
					$orders_array[$key]['details'] = $o->getId();
					$orders_array[$key]['order_nr'] = $o->getOrderNr();
					$orders_array[$key]['status'] = $o->getStatus();
					$orders_array[$key]['date'] = $o->getDate();
				
				
		}
		
		
		foreach ($completed_orders as $key => $o) {
			
				
					$completed_array[$key]['order_nr'] = $o->getOrderNr();
					$completed_array[$key]['status'] = $o->getStatus();
					$completed_array[$key]['date'] = $o->getDate();
					$completed_array[$key]['id'] = $o->getId();
				
			
		}
		
		echo $this->render('adminorders', array(
				'new_orders' => $orders_array,
				'completed_orders' => $completed_array
		));
		
		
		
		
	}
	
	
	
	
	private function deleteOrder($to_delete) {
		
		foreach ($to_delete as $del) {
			
			$del_m = new Order_details($del);
			$del_m->deleteOrder($del,false);
			
			
		}
		
		return;
		
	}
	
	
	
	public function orderDetails() {
		
		$http = new Http();
		$id = $http->post('id');
		$orders_m = new Orders();
		$orders = $orders_m->getOrdersByDetailsId($id);
		
		$order_det = new Order_details($id);
		
		
		
		
		$order_data = array();
		$order_details = array();
		
		
		
		$shippment = new Shippment($order_det->getShippingMethodId());
		$order_details['shipping_method'] = $shippment->getShippingName();
		$order_details['address'] = $order_det->getAddress();
		
		if(!empty($orders)){
		
			foreach ($orders as $key => $o) {
				
				$order_data[$key]['product_name'] = $o->getProductName();
				$order_data[$key]['product_quantity'] = $o->getQuantity();
				$order_data[$key]['product_price'] = $o->getPrice();
				$order_data[$key]['product_id'] = $o->getProductId();
				
				
			}
			
		}
		
		
		echo $this->render('adminorder', array(
				'order_data' => $order_data,
				'order_details' => $order_details,
				'order_nr' => $order_det->getOrderNr()
				
		));
		
		
	}
	
	
	
	
	
	public function checkingNewOrders() {
		
		$http = new Http();
		
		if($http->post('max')) {
			$return = array();
			$messages_m = new Orders("noload");
			$return['maxid'] = $messages_m->getMaxValueOfOrderId();
			echo json_encode($return);
			return;
		}
		
		$messages_m = new Orders("noload");
		$messages = $messages_m->checkingNewOrders($http->post('v'));
		
		$return = array();
		foreach ($messages as $key => $m) {
				
			$return[$key]['id'] = $m->getId();
			$return[$key]['date'] = $m->getDate();
			$return[$key]['nr'] = $m->getOrderNr();
			$return[$key]['status'] = $m->getStatus();
		
				
		}
		
		echo json_encode($return);
			
		
	}
	
	
	////////////////////////////////////////////////product
	
	public function products() {
		
		$products_m  = new Products();
		$product = $products_m->getProducts();
		$product_data = array();
		
		
		
		
		$d_product = $products_m->getDayProduct();
		$d_product_data = array();
		$d_product_data['id'] = $d_product->getId();
		$d_product_data['name'] = $d_product->getName();
		$d_product_data['img'] = $d_product->getImage();
		$d_product_data['price'] = $d_product->getPrice();
		
		
		$s_products = $products_m->getSliderProducts();
		$s_products_data = array();
		if(!empty($s_products)) {
			
			foreach ($s_products as $key => $p){
				
				$s_product_data[$key]['id'] = $p->getId();
				$s_product_data[$key]['name'] = $p->getName();
				$s_product_data[$key]['img'] = $p->getImage();
				$s_product_data[$key]['price'] = $p->getPrice();
				
			}
			
		}
		
		
		if(!empty($product)) {
				
			foreach ($product as $key => $p ){
				$product_data[$key]['id'] = $p->getId();
				$product_data[$key]['name'] = $p->getName();
				$product_data[$key]['img'] = $p->getImage();
				$product_data[$key]['quantity'] = $p->getQuantity();
				$product_data[$key]['price'] = $p->getPrice();
		
			}
				
		}
		
		
		
		
		$cats_array = array();
		$sub_cats_array = array();
		
		
		$categories_m = new Categories();
		$cats = $categories_m->getCategories();
		$sub_categories = new SubCategories();
		$sub_cats = $sub_categories->getSubCategories();
		
		$cats_array = array();
		
		if(!empty($cats)) {
				
			foreach ($cats as $key => $c) {
		
				$cats_array[$key]['name'] = $c->getCategoryName();
				$cats_array[$key]['id'] = $c->getCategoryId();
		
			}
		
		}
		
		
		$sub_cats_array = array();
		
		if(!empty($sub_cats)) {
		
			foreach ($sub_cats as $key => $c) {
		
				$sub_cats_array[$key]['name'] = $c->getSubCategoryName();
				$sub_cats_array[$key]['id'] = $c->getSubCategoryId();
		
			}
		
		}
		
	
		
		
		echo $this->render('adminproducts',
				array('products' => $product_data,
					  'day_product'=> $d_product_data,
					  'slider_products' => $s_product_data,
					  'cats' => $cats_array,
					  'sub_cats' => $sub_cats_array	
				));
		
		
	}
	
	public function dayProduct() {
		$return = array();
		$http = new Http();
		
		if($http->isActive('id_new_product')) {
			
			$products_m = new Products();
			$products_m->setDayProduct($http->post('id_new_product'));
			
		}
		
		if($http->isActive('id')){
			
			$product = new Product($http->post('id'));
			$return['img'] = URL.'views/public/'.$product->getImage();
			$return['name'] = $product->getName();
			$return['price'] = $product->getPrice();
			
		}
		
		echo json_encode($return);
		
		
	}
	
	
	public function addProduct() {
		
		$http = new Http();
		
		$product = new Product();
		$product->setCategory($http->post("category"));
		$product->setSubCategory($http->post("sub_category"));
		$product->setName($http->post("name"));
		$product->setDescription($http->post("product_description"));
		
		$price = $http->post("price");
		$tab = explode(",", $price);
		if(count($tab) == 2) {
			
			$price = $tab[0].".".$tab[1];
			
		}
		
		
		$product->setPrice($price);
		
		$product->setQuantity($http->post("quantity"));
		$product->setProductAdded();
		$files = $_FILES['files']['name'][0];
		
		
		
		$images_location = 'views/public/img/produkty/';
		
		$product_additional_img = new ProductAdditionalImages();
		
		$id_product = 0; 
		$test = $_FILES['files']['name'];
		if(!empty($test)){
			foreach($_FILES['files']['name']  as $key => $value ){
				
				$time = time();
				$random = rand(1000, 10000);
				$new_name = $time.$random.$_FILES['files']['name'][$key];
				$tmp = $_FILES['files']['tmp_name'][$key];
				$to_save = $images_location.$new_name;
				move_uploaded_file($tmp, $to_save);
				
				if($key == 0) {
					
					$product->setImage('img/produkty/'.$new_name);
					$id_product = $product->writeData();
					
					
				}else {
					
					$product_additional_img->setAdditionalImages($id_product, 'img/produkty/'.$new_name);
					
				}
				
			}
		}
		
		
		$num = $http->post('num_of_variables');
		
		
		if($num) {
			
			$product_additional_info = new ProductAdditional();
			
			for($i=0; $i < $num; $i++) {
				
				$var = $http->post('product_variable_nr_'.$i);
				$val = $http->post('product_value_nr_'.$i);
				$product_additional_info->setAdditionalFields($id_product, $var, $val);
			
			}
			
		}
		
		$percent = $http->post("percent");
		if($percent != 0 && ($percent > 0 && $percent < 100)) {
			
			$promotions = new Promotion();
			$promotions->setProductId($id_product);
			$promotions->setPercent($http->post("percent")/100);
			$promotions->writeData();
			
		}
		
		
		
	echo ''; 
		return;
		
		
	}
	
	
	
	public function deleteProduct() {
		
		
		$http = new Http();
		$id = $http->post("id");
		if($id) {
			
			$product = new Product($id);
			$product->delete();
			
			$product_additional_images = new ProductAdditionalImages($id, true);
			$product_additional_images->deleteAllAdditionalImages();
			
			$product_additional = new ProductAdditional($id, true);
			$product_additional->deleteAllFields();
			
			$product_promotion  = new Promotion();
			$product_promotion->deletePromotionByProductId($id);
			
			
			$product_comments = new Comments($id);
			$product_comments->deleteAllComents();
			
		}
		
		
	}
	
	
	
	
	
	
	public function editProduct() {
		
		$http = new Http();
		
		if($http->isActive('change_product')) {
			
			
			$return =  $this->change($http);
			echo json_encode($return);
			return;	
			
		}
		
		
		$return = array();
		
		
		$id = $http->post('id');
		$product = new Product($id);
		$return['category'] = $product->getCategory();
		$return['sub_category'] = $product->getSubCategory();
		$return['name'] = $product->getName();
		$return['description'] = $product->getDescription();
		$return['quantity'] = $product->getQuantity();
		$return['price'] = $product->getPrice();
		$return['img'] = $product->getImage();
		$return['id'] = $product->getId();
		
		$additional_imgs = new ProductAdditionalImages($id);
		$imgs = $additional_imgs->getAdditionalImages();
		if(!empty($imgs)) {
			
			foreach ($imgs as $key => $i) {
				
				$return['additional_imgs'][$key] = $i;
			}
			
		}
		$product_additional_info = new ProductAdditional($id);
		$info = $product_additional_info->getAdditional();
		
		if(!empty($info)) {
				
			foreach ($info as $key => $i) {
		
				$return['additional_info'][$key] = $i;
				
			}
				
		}
		
		
		$promotion_m = new Promotions($id);
		$promotion = $promotion_m->getPromotion();
		
		if(!empty($promotion)) { 
			
			$return['promotion'] = $promotion->getPercent();
			
		}
		
		
		echo json_encode($return);
		
		
	}
	
	
	private function change($http) {
		
		$id = $http->post('id');
		//echo print_r($http);
		//return;
		if(!empty($id)) {
			
			$product_m = new Product($http->post('id'));
			$product_m->setCategory($http->post("category"));
			$product_m->setSubCategory($http->post("sub_category"));
			$product_m->setName($http->post("name"));
			$product_m->setDescription($http->post("product_description"));
			$price = $http->post("price");
			$tab = explode(",", $price);
			if(count($tab) == 2) {
				
				$price = $tab[0].".".$tab[1];
				
			}
		
			$product_m->setPrice($price);
			$product_m->setQuantity($http->post("quantity"));
			$id_img_to_delete = $http->post("main_img_to_delete");
			$main_img_delated = false;
			if($product_m->getId() == $id_img_to_delete) {
				
				$images_location = 'views/public/';
				if(file_exists($images_location.$product_m->getImage())) {
					
					unlink($images_location.$product_m->getImage());
					$product_m->setImage('');
					$main_img_delated = true;
				}
				
			}
			
			$additional_img_m = new ProductAdditionalImages();
			$lenght = $http->post('length');
			if($lenght) {
				
				for($start=0; $start < $lenght; $start++) {
					
					$id = $http->post('img_to_del_nr_'.$start);
					$images_location = 'views/public/';
					if(file_exists($images_location.$additional_img_m->getAdditionalImage($id))) {
							
						unlink($images_location.$additional_img_m->getAdditionalImage($id));
					
					}
					
					$additional_img_m->deleteAdditionalImages($id);
					
				}
				
			}
			
			
			
			
			$files = $_FILES['files']['name'][0];
			
			$images_location = 'views/public/img/produkty/';
			
			$product_additional_img = new ProductAdditionalImages();
			
			
			$test = $_FILES['files']['name'];
			if(!empty($test)){
				foreach($_FILES['files']['name']  as $key => $value ){
			
					$time = time();
					$random = rand(1000, 10000);
					$new_name = $time.$random.$_FILES['files']['name'][$key];
					$tmp = $_FILES['files']['tmp_name'][$key];
					$to_save = $images_location.$new_name;
					move_uploaded_file($tmp, $to_save);
			
					if($key == 0 && ($main_img_delated || $product_m->getImage()=='')) {
							
						$product_m->setImage('img/produkty/'.$new_name);

							
							
					}else {
							
						$product_additional_img->setAdditionalImages($product_m->getId(), 'img/produkty/'.$new_name);
							
					}
			
				}
			}
			
			
			
			$product_m->writeData(true);
			
			$to_delete = $http->post('to_delete');
			
			if($to_delete) {
				
				$product_additional_fields_m = new ProductAdditional();
				for($start = 0; $start < $to_delete; $start++) {
					
					$value = $http->post('field_id_to_delete_'.$start);
				    $product_additional_fields_m->deleteAdditionalFields($value);
					
				}
			
			}
			
			
			
			$num = $http->post('num_of_variables');
			
			if($num) {
					
				$product_additional_info = new ProductAdditional();
					
				for($i=0; $i < $num; $i++) {
			
					$var = $http->post('product_variable_nr_'.$i);
					$val = $http->post('product_value_nr_'.$i);
					$product_additional_info->setAdditionalFields($http->post('id'), $var, $val);
						
				}
					
			}
			
			
			
			$to_change = $http->post('num_of_variables_to_change');
			
			if($to_change) {
					
				$product_additional_info = new ProductAdditional();
					
				for($i=0; $i < $to_change; $i++) {
						
					$var = $http->post('ch_product_variable_nr_'.$i);
					$val = $http->post('ch_product_value_nr_'.$i);
					$product_additional_info->changeAdditionalFields($http->post('id_ch_product_variable_nr_'.$i), $var, $val);
			
				}
					
			}
			
			$promo = $http->post("promo");
			
			if($promo == 'false') {
				
				$promotions = new Promotion();
				$promotions->deletePromotionByProductId($http->post('id'));
			
			}
			
			if($promo == 'true') {
				
				$promotions = new Promotions();
				if($promotions->isPromo($http->post('id'))) {
					
					$percent = $http->post("percent");
					if($percent != 0 && ($percent > 0 && $percent < 100)) {
						
						$promo = new Promotions($http->post('id'));
						$pro = $promo->getPromotion(); 
						$pro->setPercent($http->post("percent")/100);
						$pro->writeData(true);
						
					}
				
				}else {
					
					
					$percent = $http->post("percent");
					if($percent != 0 && ($percent > 0 && $percent < 100)) {
							
						$promotions = new Promotion();
						$promotions->setProductId($http->post('id'));
						$promotions->setPercent($http->post("percent")/100);
						$promotions->writeData();
							
					}
					
			
				}
				
			}
			
			$return = array();
			$return['id'] = $product_m->getId();
			$return['name'] = $product_m->getName();
			$return['img'] = $product_m->getImage();
			$return['price'] = $product_m->getPrice();
			$return['quantity'] = $product_m->getQuantity();
			
			return $return;
			
			
		}
		
		
	
	}
	
	
	public function deleteFromSlider() {
		
		$http = new Http();
		$id = $http->post('id');
		if(!empty($id)) {
			
			$products_m = new Products('noload');
			$products_m->deleteProductFromSlider($id);
			echo 1;
			return '';
		}
		echo 0;
		
	}
	
	
	public function addToSlider() {
		
		$http = new Http();
		$return = array();
		$id = $http->post('id_new_product');
		if(!empty($id)) {
			
			$slider_m = new Slider();
			$slider_m->setProductId($id);
			$slider_m->writeData();
			
			$product = new Product($id);
			
			$return['id'] = $id;
			$return['name'] = $product->getName();
			$return['img'] = $product->getImage();
			$return['price'] = $product->getPrice();
		
		}
		
		echo json_encode($return);
		
		
	}
	
	
	
	public function main() {
		
		$logo_m = new Logo();
		$http = new Http();
		$shipping_m = new Shippments();
		$methods = $shipping_m->getShippmentMethods();
		$return = array();
		if (is_array($methods)) {
			
			foreach ($methods as $key=>$m ){
				
				$return[$key]['id'] = $m->getId();
				$return[$key]['name'] = $m->getShippingName();
				$return[$key]['cost'] = $m->getCost();
				
			}
			
		}
		
		
		if($http->isActive('change')) {
			
			
			//echo print_r($_FILES['files']['name'][0]);
			//return "";
			echo print_r($this->changeLogo());
			return '';
			
			
		}
		
		$logo = $logo_m->getLogo();
		
		
		echo $this->render('adminmain', array('logo'=> URL.'views/public/'.$logo,
				'methods' => $return
								
		));
		
	
	}
	
	
	private function changeLogo() {
		
		$logo_m = new Logo();	
		
		$files = $_FILES['files']['name'][0];
		
		
		$images_location = 'views/public/';
		$logo_name = $logo_m->getLogo();	
		if(file_exists($images_location.$logo_name && $logo_name != 'img/logo/logo.png')) {
				
			unlink($images_location.$logo_name);
				
		}
			
		
		$images_location = 'views/public/img/logo/';
		
		$test = $_FILES['files']['name'][0];
	
		if(!empty($test)){
				
				
				$time = time();
				$random = rand(1000, 10000);
				$new_name = $time.$random.$_FILES['files']['name'][0];
				$tmp = $_FILES['files']['tmp_name'][0];
				$to_save = $images_location.$new_name;
				move_uploaded_file($tmp, $to_save);
				$logo_m->setLogo('img/logo/'.$new_name);
				$logo_m->writeData(true);
				
				
		}
		
		
	}
	
	
	
	public function shipping() {
		
		$http = new Http();
		
		$id = $http->post('id');
		$method = $http->post('method');
		$cost = $http->post('cost');
		$shipping_m = new Shippment($id);
		$return['id'] = $shipping_m->getId();
		$return['cost'] = $shipping_m->getCost();
		$return['name'] = $shipping_m->getShippingName();
		
		if(!empty($id) && !empty($method) && !empty($cost)) {
			
			$shipping_m = new Shippment($id);
			$shipping_m->setShippingName($method);
			$shipping_m->setCost($cost);
			$shipping_m->writeData(true);
			$return['id'] = $shipping_m->getId();
			$return['cost'] = $shipping_m->getCost();
			$return['name'] = $shipping_m->getShippingName();
			
		}
		
		echo json_encode($return);
		
	}
	
	
	public function addShippingMethod() {
		
		$http = new Http();
		
		if($http->isActive('cost')) {
			$return = array();
			$method = $http->post('method');
			$cost = $http->post("cost");
			//echo print_r($http);
			//return ;
			$id = 0;
			
			if(!empty($method) && !empty($cost)) {
				
				$shipping_m = new Shippment();
				$shipping_m->setShippingName($method);
				$shipping_m->setCost($cost);
				$id = $shipping_m->writeData();
				$return['id'] = $id;
				$return['cost'] = $shipping_m->getCost();
				$return['method'] = $shipping_m->getShippingName();
			}
			
			
			echo json_encode($return);
			
			//$shipping_m->setCost($cost)
			
		}
		
		
	}
	
	
	public function deleteShippingMethod() {
		
		$http = new Http();
		
		if($http->isActive('id')) {
			
			$shipping_m = new Shippment($http->post('id'));
			$shipping_m->delete();
			echo 1;
			return '';
		}
		
		echo 0;
		
	}
	
	

	
}