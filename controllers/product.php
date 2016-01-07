<?php
namespace controllers;

use Lib\Controller;
use Models\Comments;
use Lib\Pagination;
use Lib\LoginVal;
use Lib\Http;
use Models\Comment;
use Lib\Register;
use Lib\Location;
use Models\Promotions;
use Models\Search;
use Models\SubCategories;
class Product extends Controller {
	
	protected $product_m;
	protected $categories_m;
	protected $categories;
	protected $category_ids;
	protected $d_product;
	
	public function __construct($action,$args){
		
		$this->categories_m = new \models\Categories();
		$this->categories = $this->categories_m->getCategories();
		$this->category_ids = $this->categories_m->getCategoriesIds();
		$this->products_m = new \models\Products();
		$this->d_product = $this->products_m->getDayProduct();
		
		parent::__construct($action, $args);
	
	}
	
	protected function def($arg=null) {
		
		$this->nr($arg);
		
	}
	
	public function nr($id = null) {
			
			$is_loged = LoginVal::isLogged();
			$http = new Http();
			$this->product_m = new \models\Product($id[0]);
			$name = $this->product_m->getName();
			
			if(empty($name)) {
				
				Location::To(URL.'error');
			
			}
			
			
			
			$available = $this->product_m->getQuantity();
			
		
			$promotions = new Promotions($id[0]);
			$pro = $promotions->getPromotion();
			
			 if(!empty($pro)){
			 	
			 	$old_price = $this->product_m->getOldPrice($pro->getPercent());
			 	$discount = $pro->getPercent() * 100;
			 	
			 }
			
			 
			 
			$additionals = $this->product_m->getAdditionals();
			$a_images = $this->product_m->getAdditionalImages();
			$comments_m = new Comments($id[0]);
			
			$pagination = new Pagination(2, $comments_m->getNumberOfComments());
			
			
			$avg_rating = $comments_m->getAverageRating();
			
			$comments = $comments_m->getComments(2, $pagination->page($id[1]));
			$next = $pagination->next();
			$prev = $pagination->prev();
			$num_pages = $pagination->getPages();
			
			$selected = $pagination->getSelected();
			$comment = $http->post('comment');
			
			if(!empty($comment) && $is_loged && $http->isActive('send') && (!empty($this->product_m))){
					
				$comment = new Comment();
				$comment->setComment($http->post('comment'));
				$comment->setDate();
				$comment->setProductId($this->product_m->getId());
				$comment->setUserId(Register::get('id'));
				$comment->setRate($http->post('star'));
				$comment->writeData();
				Location::To(URL.'product/nr/'.$id[0]);
			
			}
				
			
			
			$comment_tab = array();
			
			if(!empty($comments)){
				
				foreach ($comments as $key => $comment) {
					
					if(!empty($comment)) {
						
						$comment_tab[$key]['comment'] = $comment->getComment();
						$comment_tab[$key]['date'] = $comment->getDate();
						$comment_tab[$key]['rate'] = $comment->getRate();
						$user = new \models\Users($comment->getUserId());
						$login = $user->getLogin();
						$comment_tab[$key]['login'] = empty($login)? 'anonimowy' : $login;
					
					}
					
				}
			
			}
			
			$this->render('product', array(
					'categories'=> $this->categories,
					'd_product' => $this->d_product,
					'category' => $this->product_m->getCategory(),
					'name' => $this->product_m->getName(),
					'description' => $this->product_m->getDescription(),
					'image' => $this->product_m->getImage(),
					'quantity' => $this->product_m->getQuantity(),
					'price' => $this->product_m->getPrice(),
					'additionals' => $additionals,
					'images' => $a_images,
					'comments' => $comment_tab,
					'product_nr' => $id[0],
					'next' => $next,
					'prev' => $prev,
					'num_pages' =>$num_pages,
					'selected' => $selected,
					'is_loged' =>$is_loged,
					'avg_rating' =>$avg_rating,
					'discount' => $discount,
					'old_price' => $old_price,
					'available' => $available
			));
			
			
	}
	
	
	
	protected function productlist($arg = null) {
	
		$tab = $this->checkArg($arg);
		
		
		$http = new Http();
		if($http->isActive('sub_cat')){
			
			$arg[2] = $http->get('sub_cat');
			$arg[3] = $http->get('sort');
			Location::To(URL.'product/productlist/'.$arg[0].'/'.$arg[1].'/'.$arg[2].'/'.$arg[3].'/0');
			
		}
		
		$pagination = $this->sort($arg);
		$pag = $pagination['pagination'];
		$sub_categories_m = new SubCategories();
		$sub_cats = $sub_categories_m->getSubCategories();
		
		$sub_cats_array = array();
		
		if(!empty($sub_cats)) {
		
			foreach ($sub_cats as $key => $c) {
		
				$sub_cats_array[$key]['name'] = $c->getSubCategoryName();
				$sub_cats_array[$key]['id'] = $c->getSubCategoryId();
		
			}
		
		}
		
		
		
		$products = $pagination['products'];
		$next = $pag->next();
		$prev = $pag->prev();
		$this->render('products',array(
				'categories'=> $this->categories,
				'products' => $products,
				'ids' => $this->category_ids,
				'slider' =>$this->slider,
				'd_product'=>$this->d_product,
				'next'=>$next,
				'prev'=>$prev,
				'action'=>$this->action,
				'promo' => true,
				'sub_categories' => $sub_cats_array,
				'category'=>$arg[1],
				'sub_category' => $arg[2],
				'order' => $arg[3],
				'page' => $arg[4],
				'tab' => $tab
	
		));
	
	}
	
	
	
	
	protected function sort($arg) {
		
		switch ($arg[3]) {
				
			case 1:
				$return = array();
				$return['pagination'] = new Pagination(2, $this->products_m->getNumberOfProductsBySubCategory($arg[1],$arg[2]));
				$return['products'] = $this->products_m->getProductsBySubCategory($arg[1], 2, $return['pagination']->page($arg[4]) , $arg[2], 'product_price', 'desc');
				return $return;
				
			case 2:
				
				$return = array();
				$return['pagination'] = new Pagination(2, $this->products_m->getNumberOfProductsBySubCategory($arg[1],$arg[2]));
				$return['products'] = $this->products_m->getProductsBySubCategory($arg[1], 2, $return['pagination']->page($arg[4]) , $arg[2], 'product_price', 'asc');
				return $return;
				
			case 3:
				$return = array();
				$return['pagination'] = new Pagination(2, $this->products_m->getNumberOfProductsBySubCategory($arg[1],$arg[2]));
				$return['products'] = $this->products_m->getProductsBySubCategory($arg[1], 2, $return['pagination']->page($arg[4]) , $arg[2], 'product_added', 'desc');
				return $return;
								
			default:
				$return = array();
				$return['pagination'] = new Pagination(2, $this->products_m->getNumberOfProductsBySubCategory($arg[1],$arg[2]));
				$return['products'] = $this->products_m->getProductsBySubCategory($arg[1], 2, $return['pagination']->page($arg[4]) , $arg[2]);
				return $return;		
		}
		
		
	}
	
	
	
	
	private function checkArg($arg) {
	
		$tab = false;
	
		if($arg[0]=='tab'){
	
			return $tab = 'tab';
	
		}else {
	
			return $tab = 'ntab';
	
		}
	
	}
	
	
	
	protected function search($arg = null) {
	
		$http = new Http();
		$search = $http->get('search');
		
		$search_m = new Search($search);
		
		
		$pag = new Pagination(2, $search_m->getNumberoOfMached());
		$products = $search_m->getProducts(2,$pag->page($arg[1]));
		
		$next = $pag->next();
		$prev = $pag->prev();
		$this->render('search',array(
				'categories'=> $this->categories,
				'products' => $products,
				'ids' => $this->category_ids,
				'slider' =>$this->slider,
				'd_product'=>$this->d_product,
				'next'=>$next,
				'prev'=>$prev,
				'action'=>$this->action,
				'page' => $arg[1],
				'tab' => $arg[0],
				'search' => $search
	
		));
	
	}
	
	
	
	
	
	
	
}