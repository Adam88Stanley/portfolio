
	<div class="category">
		<h3>Zamówienia niezrealizowane</h3>
		<table id="table_1">
			<thead>
				<tr>
					<td style="width:30%">Numer</td>
					<td style="width:20%">Status</td>
					<td style="width:30%">Data</td>
					<td style="width:20%"></td>
				</tr>
			</thead>
			<tbody>
			<?php if(!empty($this->args['new_orders'])) {?>
			<?php foreach ($this->args['new_orders'] as $o) {
				
				$op_1['ststus'] = $o['status'];
				if($op_1['ststus'] == 'przyjęto') {
					$op_2['ststus'] = 'złożono';
					$op_1['value'] = 2;
					$op_2['value'] = 1;
				}else {
					$op_2['ststus'] = 'przyjęto';
					$op_1['value'] = 1;
					$op_2['value'] = 2;
				}
				
					$class = 'red';
				if($op_1['ststus']=='przyjęto'){
					$class = 'yellow';
				}
				
			?>
				<tr class="<?php echo $class; ?>" >
					<form action="#" method="post" class="form_1">
						<td class="clickable btn" value="<?php echo $o['details']; ?>"><?php echo $o['order_nr']; ?></td>
						<td id="<?php echo $o['details']; ?>">
							<input type="hidden"  name="id" value="<?php echo $o['details'];?>;" />
							<select class="status" name="status">
								<option value="<?php echo $op_1['value']; ?>"><?php echo $op_1['ststus'] ;?></option>
								<option value="<?php echo $op_2['value']; ?>"><?php echo $op_2['ststus'] ; ?></option>
								<option value="3">wysłano</option>
							</select>
						</td>
						<td><?php echo $o['date'] ;?></td>
						<td value="<?php echo $o['details'];?>"></td>
					</form>
				</tr>
			
			<?php }}?>
				
			</tbody>
		</table>
	</div>


	<div class="category">
		<h3>Zamówienia zrealizowane</h3>
		<form action="#" method="post" id="form_2">
		
		<table >
			<thead>
				<tr>
					<td style="width:30%">Numer</td>
					<td style="width:30%">Status</td>
					<td style="width:30%">Data</td>
					<td style="width:10%">Zaznacz</td>
				</tr>
			</thead>
			<tbody>
			<?php if(!empty($this->args['completed_orders'])) {?>
			<?php foreach ($this->args['completed_orders'] as $o) {?>
					<tr style="background-color: #33CC33;">
						<td class="clickable btn" value="<?php echo $o['id'];?>"><?php echo $o['order_nr']; ?></td>
						<td><?php echo $o['status'];?></td>
						<td><?php echo $o['date'] ;?></td>
						<td><input type="checkbox" name="to_delete[]" value="<?php echo $o['id'];?>" /></td>
					</tr>
			<?php }?>
		<?php } ?>
			</tbody>
		</table>
		<input type="submit" value="Usuń zaznaczone" class="button_del" />
		</form>
		
	</div>

<script type="text/javascript">

	$('.button_del').click(function(e) {
		e.preventDefault();
		
		 var values = $("#form_2 input:checkbox:checked").map(function(){
		      return $(this).val();
		    }).toArray();

		$.ajax({url: "<?php echo URL.'admin/orders';?>" , 
			method: "POST",
			data: $("#form_2").serialize(),
			success: function(result){

				for(var n in values) {

				    $('#form_2 :input').filter(function(){return this.value==values[n]}).parent().parent().remove();

				}	

				
				 hideIfEmpty();
				
		 }});
		



	}); 



	

	$('.btn').on('click', btn);

	function btn() {
		var value = $(this).attr("value");

		$.ajax({url: "<?php echo URL.'admin/orderDetails';?>" , 
			method: "POST",
			data: { id:value},
			success: function(result){
				$(".content").html(result);
		 }});
	}

	$(".status").on('change', change);
	function change() {
		$('.button_status').unbind();
		var parent = $(this).parent().parent().children().last();
		var value = $(this).val();
		if(!$(parent).children().length){
			$(parent).append("<input type=\"submit\" class=\"button_status\" value=\"Zmień\" />");
		}

		$(".button_status").click(function() {
			
			var idd = $(this).parent().attr('value');
			
			if(value==3){
				
				updateTableR($(this).parent().parent());
				$(this).parent().parent().remove();

				if(!$("#table_1 tbody tr").length) {
					
					emptyOrders();
					
				}
				
			}else if(value==2) {
				
				
				$(this).parent().parent().css({"background-color": '#FFFF33'});
				$(this).remove();
				
			}else if(value==1){

				
				$(this).parent().parent().css({"background-color": '#FF3333'});
				$(this).remove();
				
			}

			$.ajax({url: "<?php echo URL.'admin/orders';?>" , 
				method: "POST",
				data: { status:value, id:idd},
				success: function(result){
					
			 }});

			

			});


	}

	
	function hideIfEmpty() {
		
		if(!$("#form_2 tbody tr").length) {
			$("#form_2 .button_del").css({display:'none'});
			$("#form_2").parent().append("<p class=\"empty empty_r\">Brak zamówień.</p>");
		}
		
	}


	function emptyOrders() {
			
			if(!$("#table_1 tbody tr").length) {
				$("#table_1").parent().append("<span class=\"info\"><p class=\"empty\">Brak zamówień.</p></span>");
			}else {
				$(".info").text("");
			
			}
		}
	
	emptyOrders();
	
	function updateTableR(tr) {
		
		$(".empty_r").remove();
		$("#form_2 .button_del").css({display:'block'});
		

		var nr = $(tr).children("td:nth-child(2)").text();
		var value = $(tr).children("td:nth-child(2)").attr('value');
		var date = $(tr).children("td:nth-child(4)").text();


		
		$("#form_2 tbody").prepend("<tr style=\"background-color: #33CC33;\"><td class=\"clickable btn\"  value=\""+value+"\">" + nr + "</td><td>wysłano</td><td>"+ date +"</td><td><input type=\"checkbox\" name=\"to_delete[]\" value=\""+ value +"\" /></td></tr>");
		$(".btn").unbind();
		$(".btn").on("click", btn);

	}

	hideIfEmpty();

							
</script>

