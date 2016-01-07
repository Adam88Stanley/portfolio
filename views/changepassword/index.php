<?php use Lib\View; ?>
<? View::header('<link rel="stylesheet" type="text/css" href="'.URL.'views/changepassword/content.css" />','Zmiana hasła'); ?>
<div class="body vspace_4 row">
<?php require_once(View::commonPath('sidenav.php')); ?>
  <div class="content">
  
  	<?php  if(!empty($this->args['errors'])){ ?>
                    	<ul class="error">
                    <?php
	                    foreach ($this->args['errors'] as $error ) {
	                    	
	                    	echo '<li>'.$error.'</li>';
	                    	
	                    }
                    ?>
                    	</ul>
                   <?php } ?>
                    	
    
  	<form action="<?php echo URL.'passrecovery/complete';?>" method="post">
  		<label>Hasło: <input type="password" name="password" /></label>
  		<label>Powtórz hasło: <input type="password" name="password_2" /></label>
  		<input type="hidden" name="id" value="<?php echo $this->args['id'];?>" />
  		<input type="hidden" name="email" value="<?php echo $this->args['email']; ?>" />
  		<input type="hidden" name="rand" value="<?php echo $this->args['rand'];?>" />
  		<input type="submit" name="change" value="zmień"/>
  	</form>
  
  
  </div>           
</div>
<?php View::footer(); ?>