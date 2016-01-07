<?php use Lib\View; ?>
<? 
View::header('<link rel="stylesheet" type="text/css" href="'.URL.'views/confirm/content.css" />','Potwierdzenie zamuwienia'); 

?>
 <div class="body vspace_4 row">
<?php require_once(View::commonPath('sidenav.php')); ?>
<div class="content">
	<h3>Podsumowanie:</h3>
	<table>
		<thead>
			<tr>
				<td style="width:40%;">Nazwa</td>
				<td style="width:10%;">Ilość</td>
				<td style="width:10%;">Cena</td>
			</tr>
		</thead>
		<?php 
			foreach ($this->args['cart_data'] as $product) {
				echo '<tr>';
				echo '<td>'.$product['product_name'].'</td>';
				echo '<td>'.$product['product_quantity'].'</td>';
				echo '<td>'.$product['product_price'].'</td>';
				echo '</tr>';
				
			}
		?>
		</table>
	<?php 
	echo '<ul><li>Koszt dostawy: '.$this->args['shipping_cost'].'zł</li>';
	echo '<li>Łącznie do zapłaty: '.($this->args['price'] + $this->args['shipping_cost']).'zł</li></ul>';
	?>
	<strong>Adres dostawy :</strong>
	<ul>
<?php 
$names  = array('Imie' , 'Nazwisko', 'Kraj', 'Kod Pocztowy',
		'Miasto', 'Ulica', 'Numer domu', 'Numer Mieszkania'
 );
$i = 0;
foreach ($this->args['shippment'] as $data){
	echo '<li>'.$names[$i].': '.$data.'</li>';
	$i++;
}

?>
</ul>
<form action="<?php echo URL.'cart/purchuase';?>" method="get">
	<input type="hidden" name="shipping_method" value ="<?php echo $this->args['method']; ?>" />
	
		<label>Twoja wiadomość: (opcjonalna)
			<textarea name="message"></textarea>
		</label>
	
	
	
	
	<input type="submit" name="accept" value="zatwierdź" />
</form>
<a href="<?php echo URL.'user/edition';?>" class="button" >Zmień adres dostawy</a><br>
<a href="<?php echo URL.'cart/show';?>" class="button" >Powrót do koszyka</a>
</div>
</div>
<?php View::footer(); ?>
