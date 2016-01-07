<?php use Lib\View; ?>
<? 
View::header('<link rel="stylesheet" type="text/css" href="'.URL.'views/last/content.css" />','Kupione'); 

?>
 <div class="body vspace_4 row">
<?php require_once(View::commonPath('sidenav.php')); ?>
<div class="content">
<h3 class="h3profile">Zamowienia</h3>
<div class="profile">
	<form method="post" action="<?php echo URL.'user/last' ?>">
		<table style="width: 100%">
			<thead>
				<tr >
					<td style="width: 40%">Nr zamówienia</td>
					<td style="width: 30%">Status</td>
					<td style="width: 20%">Data</td>
					<td style="width: 10%">Zaznacz</td>
				</tr>
			</thead>
			  
			  
			<?php 
			
				if(!empty($this->args['orders'])) {?>
					<?php foreach ($this->args['orders'] as $order){?>
					<tr>	
						<td><a href="<?php echo URL.'user/details/'.$order['id']; ?>"><?php echo $order['nr'];?></a></td>
						<td><?php echo $order['state'];?></td>
						<td><?php echo $order['date'];?></td>
						<td><input type="checkbox" name="to_delete[]" value="<?php echo $order['id'];?>"/></td>
					</tr>
					<?php }?>		
						
						
			<?php }?>
			
			
		</table> 
		
		<div class="pagination">
	    	<?php
	    	
	        	if($this->args['num_pages'] > 1){
	        		
	            	echo '<a href="'.URL.'user/last/'.$this->args['prev'].'" class="arrow">&lt;</a>';
	                	
	                	if(!empty($this->args['num_pages'] )){
	                		
	                    	$selected = $this->args['selected'];
	                    	
	                        	for($i=0; $i<$this->args['num_pages']; $i++) {
	                        		
		                        	echo '<a href="'.URL.'user/last/'.$i.'" '.(($selected == ($i+1)) ? 'class="selected"' : '').'>'.($i+1).'</a>';
		                        	 	
		                        } 
	                      }
	                        	 
	                       	 echo '<a href="'.URL.'user/last/'.$this->args['next'].'" class="arrow">&gt;</a>';
	                        
	        	}             	
	    	?>
	    </div>
		
		
		
		
		<input type="submit" class="delete" value="Usuń zaznaczone" />
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
