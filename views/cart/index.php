<?php use Lib\View; ?>
<? 
View::header('<link rel="stylesheet" type="text/css" href="'.URL.'views/cart/content.css" />','Koszyk'); 

?>
 <div class="body vspace_4 row">
<?php require_once(View::commonPath('sidenav.php')); ?>
<div class="content">
	<h3>Koszyk:</h3>
	<div class="cart">
		<?php 
		if(empty($this->args['cart_data'])) {
			
			echo "<p>Twój koszyk jest pusty!</p>";
		
		}else {?>
		<table>
		<thead>
			<tr>
				<td style="width:40%;">Nazwa</td>
				<td style="width:10%;">Ilość</td>
				<td style="width:10%;">Cena</td>
				<td style="width:40%; ">Dodaj/Usuń</td>
			
			</tr>
		</thead>
		<?php 
			foreach ($this->args['cart_data'] as $product) {
				echo '<form  method="get" action="'.URL.'cart/mod">';
				echo '<input type="hidden" name="product_id" value="'.$product['product_id'].'"/>';
				echo '<input type="hidden" name="product_name" value="'.$product['product_name'].'"/>';
				echo '<input type="hidden" name="product_price" value="'.$product['product_price'].'"/>';
				echo '<tr class="order">';
				echo '<td>'.$product['product_name'].'</td>';
				echo '<td>'.$product['product_quantity'].'</td>';
				echo '<td>'.$product['product_price'].'</td>';
				echo '<td><input type="number" min="1" name="product_quantity" value="1"/>';
				echo '<input type="submit" name="add" value="dodaj"/>';
				echo '<input type="submit" name="sub" value="usuń"/></td>';
				echo '</tr>';
				echo '</form>';
				
			}
			
		?>
		</table>
		<form method="get" action="<?php echo URL.'cart/purchuase'?>">
		
			<select name="shipping_method">
				<?php 
			
					foreach ($this->args['shipping'] as $k => $m){
						//echo '<option>';
						//echo $m['shipping_name'];
						//echo '</option>';
						echo '<option value="'.$m['id'].'">'.$m['shipping_name'].', koszt wysyłki: '.$m['cost'].' zł</option>';
						
					}
				
				?>
			</select>
			<input type="submit" class="button" value="Dokonaj Zakupu"/>
		</form>
		
		
		<?php }?>
		
	</div>
</div>
</div>
<?php View::footer(); ?>
