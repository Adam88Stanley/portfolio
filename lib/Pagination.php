<?php
namespace Lib;
class Pagination {
	
	protected $products_on_page;
	protected $num_of_items;
	protected $pages;
	protected $page;
	protected $selected;
	
	
	public function __construct($onPage, $numberOfProducts) {
		
		$this->page = 1;
		
		$this->pages = ceil($numberOfProducts/$onPage);		
		
	}
	
	public function getSelected() {
		
		return $this->page+1;
		
	}
	
	public function getPages() {
		
		return $this->pages;
		
	}
	
	
	public function page($page) {
		
		
		
		if(empty($page) || !is_numeric($page)){
			
			$this->page = 0;
			return 1;
			
		}else{
			
			$this->page = $page;
			return $page+1;
			
		}
		
	}
	
	public function next() {
		
		if($this->page > $this->pages-2) {
				
			return  0;
				
		}
		
		$next = $this->page;
		
		return ++$next;
		
		
	}
	
	
	public function prev() {
		
		$this->page;
		if($this->page == 0){
			
			return $this->pages-1;
			
		}
		
		$prev = $this->page;
		
		return --$prev;
		
		
		
	}
	

	
}



















/*

<?php
namespace Lib;
class Pagination {

	protected $pagination_array;
	protected $products_on_page;
	protected $num_of_items;
	protected $pages;
	protected $page;
	protected $selected;


	public function __construct($pagination_array, $products_on_page) {

		$this->pagination_array = $pagination_array;
		$this->products_on_page = $products_on_page;
		$this->num_of_items = count($this->pagination_array);
		$this->pages = ceil($this->num_of_items/$this->products_on_page);


	}
	public function getSelected() {

		return $this->page + 1;

	}

	public function getPages() {

		return $this->pages;

	}


	public function page($page) {

		$this->page = is_numeric($page) ? $page : 0;
		if(empty($page) || $page == 0){
				
			$products;
			$start = 0;
				
			if(!empty($this->pagination_array)){

				foreach($this->pagination_array as $item) {
						
					$start++;
					$products[] = $item;
						
					if($start == $this->products_on_page) {

						return $products;

					}
						
						
				}

			}
			return $products;
				
				
		}else {
				
			$products = array();
			$start = $this->products_on_page * $page;
			$end = $this->products_on_page * ($page +1);
				
			for($start; $start < $end; $start++) {

				$products[] = $this->pagination_array[$start];

				if(	$start == $this->num_of_items){
						
					return $products;
						
				}

			}
				
			return $products;
				
		}

	}

	public function next() {

		$result;

		if($this->page > $this->pages-2) {
				
			$result = 0;

		} else {
				
			$result = $this->page + 1;
				
		}
		return $result;

	}


	public function prev() {

		$result;

		if($this->page < 1) {

			$result = $this->pages-1;

		} else {

			$result = $this->page - 1;

		}

		return $result;


	}




}*/