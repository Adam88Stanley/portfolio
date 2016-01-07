<div class="category">
		<h3>Wiadomości od: <?php if($this->args['user']) {echo $this->args['user']; }?></h3>
		
		<?php if(!empty($this->args['messages'])) {?>
		<form action="" method="post" id="form_1">
		<input type="hidden" name="id_user" value="<?php echo $this->args['user_id'];?>" />
			<table>
				<tr>
						<td style="width:20%">Zaznacz</td>
						<td style="width:60%">Ostatnia Wiadomość</td>
						<td style="width:20%">Data</td>
				</tr>
				
				<?php foreach ($this->args['messages'] as $key => $m) {?>
					<tr>
						<td><input type="checkbox" name="to_delate[]" value="<?php echo $m['id']; ?>"/></td>
						<td  value="<?php echo $m['message']; ?>" ><?php echo $m['message'];?></td>
						<td><?php echo $m['date'];?></td>
					</tr>
				<?php }?>
				
			</table>
			<input type="submit" value="Usuń" class="button_delete" />
		</form>
		<?php } else {?>
			<p class="empty">Brak nowych wiadomości.</p>
		<?php }?>
		
	

	</div>

	<div class="category">
		<h3>Wyślij Wiadomość</h3>
		<form action="" method="post" id="form_2">
			<input type="hidden" name="message_to_user" value="<?php echo $this->args['user_id'];?>" />
			<label class="text">Treść wiadomości:
				
				<textarea name="message" class="message"></textarea>
			</label>
			<input type="submit" id="send_message" value="Wyślij" class="button" />
		</form>
		<div class="info"></div>
	</div>
<script type="text/javascript">


$(".button_delete").click(function(e) {
	e.preventDefault();
	
	 var values = $("#form_1 input:checkbox:checked").map(function(){
	      return $(this).val();
	    }).toArray();
	
	$.ajax({url: "<?php echo URL.'admin/deleteMessage';?>" ,
		method: "POST",
		data: $("#form_1").serialize(),
		success: function(result){
			
			for(var n in values) {

			    $('#form_1 :input').filter(function(){return this.value==values[n]}).parent().parent().remove();

			}		

	 }});

	

});


$("#send_message").click(function(e) {
	$(".button_back_1").unbind();
	e.preventDefault();
	
	
	$.ajax({url: "<?php echo URL.'admin/sendMessage';?>" ,
		method: "POST",
		data: $("#form_2").serialize(),
		
		success: function(result){
			
			$("#form_2").css({display:'none'});
			$(".info").append('<p>' + result +'</p><a href="#" class=\"button_back_1\">Wroć</a></p>');
			$(".button_back_1").click(function (e) {
				e.preventDefault();
				$("#form_2").css({display:'block'});
				$("#form_2").find("textarea").val("");
				$(".info").html('');
			});


			
	 }});

	

});








</script>
	