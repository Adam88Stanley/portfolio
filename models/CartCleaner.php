<?php
namespace Models;
use Lib\Model;
class CartCleaner extends Model {
	
	public function __construct() {
	
		parent::__construct();
		
		
		$date = date("Y-m-d H:i:s", time()-600);
		
		$result = $this->db->getAll("SELECT product_id, quantity FROM last_ordered WHERE date < '".$date."' AND active=0");
		if($result){
			echo "dddddd";
			$this->db->query('START TRANSACTION');
			$this->db->query("DELETE FROM last_ordered WHERE date < '".$date."' AND active=0");
			$this->db->query('COMMIT');
			
			foreach($result as $product) {
				
				$this->db->query('START TRANSACTION');
				$id = $product["product_id"];
				$quantity = $product["quantity"];
				$this->db->query("UPDATE products SET product_quantity = product_quantity + ".$quantity.", product_sold = product_sold-".$quantity." WHERE product_id='".$id."'");
				$this->db->query('COMMIT');

				
			}
		}
		
		
	}
	
	
}

?>