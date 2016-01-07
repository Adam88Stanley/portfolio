<?php
namespace Models;
use Lib\ORM;
class Page extends ORM {
	
	protected $id;
	protected $page_name;
	protected $title;
	protected $header;
	protected $style;
	protected $content;
	
	
	public function __construct($id = null) {
		$this->id = $id;
		parent::__construct('pages', $id);
		
	}
	
	public function getId() {
		
		return $this->id;
		
	}
	
	
	public function getPageName() {
	
		return $this->page_name;
	
	}
	
	public function getTitle() {
			
		return $this->title;
			
	}
	
	public function getHeader() {
	
		return $this->header;
	
	}
	

	public function getStyle() {
	
		return $this->style;
	
	}
	
	public function getContent() {
	
		return $this->content;
	
	}
	
	public function setPageName($pagename) {
		
		$this->page_name = $pagename;
		
	}
	
	
	public function setTitle($title) {
			
		$this->title = $title;
			
	}
	
	public function setHeader($header) {
	
		$this->header = $header;

	}
	
	
	public function setStyle($style) {
	
		$this->style = $style;
	
	}
	
	public function setContent($content) {
	
		$this->content = $content;
	
	}
	
	
	
	
	
	
}