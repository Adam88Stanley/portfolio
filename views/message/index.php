<?php use Lib\View; ?>
<? 
View::header('<link rel="stylesheet" type="text/css" href="'.URL.'views/message/content.css" />','Wiadomości'); 

?>
 <div class="body vspace_4 row">
<?php require_once(View::commonPath('sidenav.php')); ?>
<div class="content">
<h3 class="h3profile">Wiadomości</h3>
<div class="profile">

<form method="post" action="<?php echo URL.'user/message' ?>">
<label>Twoja wiadomość:
	<textarea name="message"></textarea>
</label>
<input type="submit" name="send" value="Wyślij" />
</form>
<form method="post" action="<?php echo URL.'user/message' ?>">
<table>
	<thead>
		<tr>
			<td style="width:20%">Autor</td>
			<td style="width:50%">Wiadomość</td>
			<td style="width:20%">Data</td>
			<td style="width:20%">Zaznacz</td>
		</tr>
	</thead>
	<tbody>
		<?php 
		
			foreach ($this->args['messages'] as $message) {
				
				echo '<tr>';
				echo '<td>'.(($message['seller']== false) ? $this->args['login'] : 'Sprzedawca').'</td>';
				echo '<td>'.$message['message'].'</td>';
				echo '<td>'.$message['date'].'</td>';
				echo '<td><input value="'.$message['id'].'" name="delete[]" type="checkbox" /></td>';
				echo '</tr>';
				
			}
		
		
		?>
	</tbody>
	
</table>
	<div class="pagination">
	    	<?php
	    	
	        	if($this->args['num_pages'] > 1){
	        		
	            	echo '<a href="'.URL.'user/message/'.$this->args['prev'].'" class="arrow">&lt;</a>';
	                	
	                	if(!empty($this->args['num_pages'] )){
	                		
	                    	$selected = $this->args['selected'];
	                    	
	                        	for($i=0; $i<$this->args['num_pages']; $i++) {
	                        		
		                        	echo '<a href="'.URL.'user/message/'.$i.'" '.(($selected == ($i+1)) ? 'class="selected"' : '').'>'.($i+1).'</a>';
		                        	 	
		                        } 
	                      }
	                        	 
	                       	 echo '<a href="'.URL.'user/message/'.$this->args['next'].'" class="arrow">&gt;</a>';
	                        
	        	}             	
	    	?>
	    </div>
<input type="submit" name="del" class='delete' value="Usuń zaznaczone" />
</form>

</div>
<div class="photo_buttons">
<ul class="buttons">
	<li><a href="<?php echo URL.'user/profile'; ?>">Profil</a></li>
	<li><a href="<?php echo URL.'user/edition'; ?>">Edycja</a></li>
	<li><a href="<?php echo URL.'user/last'; ?>">Zamówenia</a></li>
	<li><a href="<?php echo URL.'user/message'; ?>">Wiadomości</a></li>
	<li><a href="<?php echo URL.'user/delete'; ?>">Usuń Konto</a></li>
</ul>
</div>
</div>
</div>
<?php View::footer(); ?>