
	<div class="category">
		<h3>Nowe Wiadomości</h3>
		<?php if(!empty($this->args['message_data'])) {?>
		<table id="messages_table">
			<thead>
				<tr>
					<td style="width:20%">Autor</td>
					<td style="width:60%">Ostatnia Wiadomość</td>
					<td style="width:20%">Data</td>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($this->args['message_data'] as $key => $m) {
			?>
				<tr>
					<td><?php echo $m['author'];?></td>
					<td class="<?php echo 'user_message clickable'?>" value="<?php echo $m['id']; ?>" ><?php echo $m['message'];?></td>
					<td><?php echo $m['date'];?></td>
				</tr>
			<?php }?>
			</tbody>
		</table>
		<?php } else {?>
			<p class="empty">Brak nowych wiadomości.</p>
		<?php }?>
	</div>

	<div class="category">
		<h3>Wyślij Wiadomość</h3>
		<form action="" method="post" id="form_1">
			<label>Do :
				<select name="message_to_user">
					<?php 
					if(!empty($this->args['users'])) {
						
						foreach ($this->args['users'] as $u) {
							
								echo '<option value="'.$u['id'].'">'.$u['login'].'</option>';	
							
						}
						
					}
					
					?>
				</select>
			</label>
			<label class="text">Treść wiadomości:
				<textarea class="message" name="message"></textarea>
			</label>
			<input type="submit" id="send_message" value="Wyślij" class="button" />
		</form>
		<div class="info"></div>
	</div>
	
	
	
	<div class="category">
		<h3>Użytkownicy</h3>
		<form action="" method="post" id="form_2">
			<label>Do :
				<select name="user_id">
					<?php 
					if(!empty($this->args['users'])) {
						
						foreach ($this->args['users'] as $u) {
							
								echo '<option value="'.$u['id'].'">'.$u['login'].'</option>';	
							
						}
						
					}
					
					?>
				</select>
			</label>
			<input type="submit" id="users" value="Dalej" class="button" />
		</form>
	</div>
	


	
	<script type="text/javascript">



		

		$("#users").click(function(e) {
			e.preventDefault();
		
				$.ajax({url: "<?php echo URL.'admin/message';?>" , 
					method: "POST",
					data: $("#form_2").serialize(),
					success: function(result){
						$(".content").html(result);
				 }});
	
	
		});


		$(".user_message").on('click', user_message);

		
		function user_message() {
			
			var value = $(this).attr("value");
			id.decreaseCounter();
			newMessagesInfo();
			
				$.ajax({url: "<?php echo URL.'admin/message';?>" , 
					method: "POST",
					data: { id:value},
					success: function(result){
						$(".content").html(result);
				 }});


		};


		$("#send_message").click(function(e) {
			$(".button_back_1").unbind();
			e.preventDefault();
			
			
			$.ajax({url: "<?php echo URL.'admin/sendMessage';?>" ,
				method: "POST",
				data: $("#form_1").serialize(),
				
				success: function(result){
					
					$("#form_1").css({display:'none'});
					$(".info").append('<p>' + result +'</p><a href="#" class=\"button_back_1\">Wroć</a></p>');
					$(".button_back_1").click(function (e) {
						e.preventDefault();
						$("#form_1").css({display:'block'});
						$("#form_1").find("textarea").val("");
						$(".info").html('');
					});


					
			 }});

			

		});


	</script>
