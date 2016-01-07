<div class="category">
		<h3>Numer Zamówienia: <?php echo ((!empty($this->args['order_nr']) ? $this->args['order_nr'] : '' ))?></h3>
		<table>
			<thead>
				<tr>
					<td style="width:30%">Adres</td>
					<td style="width:20%">Nazwa</td>
					<td style="width:10%">Sztuk</td>
					<td style="width:10%">Cena</td>
					<td style="width:10%">Płatność</td>
				</tr>
			</thead>
			
			<?php 
			$rowspan = count($this->args['order_data']);
			
			foreach($this->args['order_data'] as $key => $o) {?>
			
				<tr>
					<?php if($key == 0) {?>
						<td rowspan="<?php echo $rowspan; ?>"><?php echo $this->args['order_details']['address']; ?></td>
					<?php }?>
					<td><?php echo $o['product_name']; ?></td>
					<td><?php echo $o['product_quantity']; ?></td>
					<td><?php echo $o['product_price']; ?></td>
					<?php if($key == 0) {?>
						<td rowspan="<?php echo $rowspan; ?>"><?php echo $this->args['order_details']['shipping_method']; ?></td>
					<?php }?>
				</tr>
				
			
			<?php }?>
			
			
		</table>
	</div>
