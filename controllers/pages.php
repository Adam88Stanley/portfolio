<?php
namespace controllers;

use Lib\Controller;
use Lib\Http;
use Lib\Location;
use Models\Page;
class Pages extends Controller {
	
	

	
	public function __construct($action,$args){
		
		
		
		$this->categories_m = new \models\Categories();
		$this->categories = $this->categories_m->getCategories();
		$this->category_ids = $this->categories_m->getCategoriesIds();
		$this->products_m = new \models\Products();
		$this->d_product = $this->products_m->getDayProduct();
		
		parent::__construct($action, $args);
		

	}
	
	public function page($arg){
		
		
		$page = new Page($arg[0]);
		$page_args['title'] = "<title>".$page->getTitle()."</title>";
		$page_args['header'] = $page->getHeader();
		$page_args['style'] = "<style>".$page->getStyle()."</style>";
		$page_args['content'] = $page->getContent();
		
		if(empty($page_args['content'])) {
			
			Location::To(URL.'error');
			
		}
		
		$this->render('page', array(
				'categories'=> $this->categories,
				'd_product'=>$this->d_product,
				'page' =>$page_args));
		
		
	}
	

}