<?php
namespace Models;
use Lib\Model;
class Comments extends Model {
	
	protected $comment_m;
	protected $id;
	
	public function __construct($id) {
	
		parent::__construct();
		$this->id = $id;
		

	}
	
	public function getNumberOfComments() {
		
		$result = $this->db->getAll("SELECT COUNT(id) FROM comments WHERE product_id=$this->id");
		return $result[0]["COUNT(id)"];
		
	}
	
	public function getComments($onPage=6, $page=1) {
		
		$result = $this->db->simpleQuery()->from('comments', array('id'))->where('product_id=?',$this->id)->order('date','desc')->limit($onPage, $page)->all();
		foreach ($result as $tab) {
		
			$this->comment[] = new Comment($tab['id']);
				
		}
		
		return $this->comment;
		
	}
	
	public function getAverageRating() {
		
		
		$result = $this->db->getAll("SELECT AVG(rate) FROM comments WHERE product_id=$this->id");
		
		return $result[0]["AVG(rate)"];
		
		
	}
	
	public function deleteAllComents() {
		
		$this->db->simpleQuery()->from('comments')->where('product_id=?',$this->id)->delete();
		
		
	}

	
}