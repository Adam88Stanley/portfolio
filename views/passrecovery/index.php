<?php use Lib\View; ?>

<? View::header('<link rel="stylesheet" type="text/css" href="'.URL.'views/passrecovery/content.css" />','Odzyskiwanie hasła'); ?>

<div class="body vspace_4 row">
<?php require_once(View::commonPath('sidenav.php')); ?>
<div class="content">

	<?php if($this->args['success']) {?>
		
		<p>Na twój adres e-mail została wysłana wiadomość. Pstępuj według
		instrukcj zawartej w widaomości aby odzyskać hasło.</p>
	
	
	<?php } else {?>
	
		<p>W celu odzyskać hasła wypelnij formularz.</p>
			<?php 
	                    	
	            if(!empty($this->args['error'])){
	                echo '<div class="error">';
	                echo $this->args['error'];
	                echo '</div>';
	            }
	                    	
	        ?>
		<form action="<?php echo URL.'passrecovery/recover';?>" method="get">
			<label>E-mail: <input type="email" name="email" required /></label>
			<input type="submit" value="wyślij" />
		</form>

	<?php }?>

</div>
</div>
<?php View::footer(); ?>
