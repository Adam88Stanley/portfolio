<?php use Lib\View; ?>
<? 
View::header('','Edycja'); 

?>
 <div class="body vspace_4 row">
<?php require_once(View::commonPath('sidenav.php')); ?>
<div class="content">
<h3 class="h3profile">Edycja</h3>
<div class="profile">
 
    <form method="post" action="<?php echo URL.'user/edition' ?>">
                            
    <?php 
				$names = array(
						'imie',
						'nazwisko',
						'kraj',
						'kod pocztowy',
						'miasto',
						'ulica',
						'nr domu',
						'nr mieszkania',
						'telefon',
						'email'
				);
				$post_names = array(
						'firstname',
						'surname',
						'country',
						'zipcode',
						'city',
						'street',
						'house',
						'appartment',
						'phone',
						'email'
					);
				$pos = 0;
		
		foreach ($this->args['personal_data'] as $data){
			
			echo '<label>'.ucfirst($names[$pos]).': <input type="text" name="'.$post_names[$pos].'" value="'.$data.'"/></label>';
			
			$pos++;
		}
	
	
	?>
           <input type="submit" name="save" class="btn" value="Zapisz zmiany"/> 
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
