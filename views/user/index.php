<?php use Lib\View; ?>
<? View::header('<link rel="stylesheet" type="text/css" href="'.URL.'views/user/content.css" />','Profil'); ?>
<div class="body vspace_4 row">

<?php require_once(View::commonPath('sidenav.php')); ?>
<div class="content">
<h3 class="h3profile">Profil</h3>
<div class="profile">
<ul class="personal_data">
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
				'email',
				'ostatnia wizyta',
				'data rejestracji'
		);
		$pos = 0;
		
		foreach ($this->args['personal_data'] as $data){
			
			echo '<li><span>'.$names[$pos].': </span>'.(empty($data) ? '<span class="empty">Pole niewypełnione</span>':$data).'</li>';
			
			$pos++;
		}
	
	
	?>

</ul>
<img src="<?php echo empty($this->args['photo']) ? URL.'views/public/users/default/default.png' : $this->args['photo']; ?>" alt="" class="profile_image"/>

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
