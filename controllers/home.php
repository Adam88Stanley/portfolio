<?php
namespace controllers;

use Lib\Controller;
use Models\Category;
use Models\Categories;
use Models\Products;
use Models\Slider;
use Lib\Pagination;
use Lib\Http;

class Home extends Controller {

	protected $categories_m;
	protected $products_m;
	protected $categories;
	protected $products;
	protected $slider;
	protected $slider_m;
	protected $d_product;
	protected $promotions;
	protected $category_ids;
	
	
	public function __construct($action=null, $args=null){
		
		$this->categories_m = new Categories();
		$this->categories = $this->categories_m->getCategories();
		$this->products_m = new Products();
		$this->category_ids = $this->categories_m->getCategoriesIds();
		$this->slider = $this->products_m->getSliderProducts();
		$this->d_product = $this->products_m->getDayProduct();
		
		
		
		parent::__construct($action, $args);
	
	}
	
	protected function def($arg=null) {
		
		$tab = $this->checkArg($arg);
		
		$pag = new Pagination(2, 10);
		
		$this->products =  $this->products_m->getNews(2, $pag->page($this->args[1]));
		$next = $pag->next();
		$prev = $pag->prev();
		$this->render('home',array(
				'categories'=> $this->categories,
				'products' => $this->products,
				'slider' =>$this->slider,
				'd_product'=>$this->d_product,
				'next'=>$next,
				'prev'=>$prev,
				'action'=>empty($this->action)?'def':$this->action,
				'def'=> true,
				'ids' => $this->category_ids,
				'tab' => $tab,
				'selected' => $this->args[1]
		));
		
	}
	
	
	protected function promo($arg = null) {
		
		$tab = $this->checkArg($arg);
		
		$pag = new Pagination(2, $this->products_m->getNumberOfProductsInPromo());
		$this->promotions = $this->products_m->getPromotions(2, $pag->page($this->args[1]));
		$next = $pag->next();
		$prev = $pag->prev();
		$this->render('home',array(
				'categories'=> $this->categories,
				'products' => $this->promotions,
				'slider' =>$this->slider,
				'd_product'=>$this->d_product,
				'next'=>$next,
				'prev'=>$prev,
				'action'=>$this->action,
				'promo' => true,
				'ids' => $this->category_ids,
				'tab' => $tab,
				'selected' => $this->args[1]
				
		));
	
	}
	
	
	protected function popular($arg = null){
		
		$tab = $this->checkArg($arg);
		
		$pag = new Pagination(2, $this->products_m->getNumberOfPopularPro());
		$this->products = $this->products_m->getPopular(2, $pag->page($this->args[1]));
		$next = $pag->next();
		$prev = $pag->prev();
		$this->render('home',array(
				'categories'=> $this->categories,
				'products' => $this->products,
				'slider' =>$this->slider,
				'd_product'=>$this->d_product,
				'next'=>$next,
				'prev'=>$prev,
				'action'=>$this->action,
				'popular'=>true,
				'ids' => $this->category_ids,
				'tab' => $tab,
				'selected' => $this->args[1]
		));
		
		
	}
	
	private function checkArg($arg) {
		
		$tab = false;
		
		if($arg[0]=='tab'){
				
			return $tab = 'tab';
				
		}else {
				
			return $tab = 'ntab';
				
		}
		
	}

	
	public function getproduct() {
		$http = new Http();
		
		if($http->get('key1') == 0){
			return;
		}
		$product = new \models\Product($http->get('key1'));
		$data['id'] = $http->get('key1');
		$data['name'] = $product->getName();
		$data['img'] = $product->getImage();
		$data['desc'] = $product->getDescription();
		$data['price'] = $product->getPrice();
		echo $this->render('quickview', $data);
		
		
	}
	
	
	
}