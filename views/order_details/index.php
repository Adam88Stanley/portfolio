<?php use Lib\View; ?>
<? 
View::header('<link rel="stylesheet" type="text/css" href="'.URL.'views/last/content.css" />'); 

?>
 <div class="body vspace_4 row">
<?php require_once(View::commonPath('sidenav.php')); ?>
<div class="content">
<h3 class="h3profile">Zamowienia</h3>
<div class="profile">
	<table style="width: 100%">
		<thead>
			<tr >
				<td style="width: 40%">Nazwa</td>
				<td style="width: 30%">Ilość</td>
				<td style="width: 30%">Cena</td>
			</tr>
		</thead>
		  
		  
		<?php 
		
			if(!empty($this->args['orders'])) {?>
				<?php foreach ($this->args['orders'] as $order){?>
				<tr>	
					<td><a href="<?php echo URL.'product/nr/'.$order['product_id']?>"><?php echo $order['name'];?></a></td>
					<td><?php echo $order['quantity'];?></td>
					<td><?php echo $order['price']*$order['quantity'];?> zł</td>
				</tr>
				<?php }?>		
					
					
		<?php }?>
		

	</table> 
</div>
<div class="photo_buttons">
<ul class="buttons">
	<li><a href="<?php echo URL.'user/last'; ?>">Wróć</a></li>
</ul>
</div>
</div>
</div>
<?php View::footer(); ?>
