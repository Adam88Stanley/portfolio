<?php use Lib\View; ?>
<? View::header('<link rel="stylesheet" type="text/css" href="'.URL.'views/register/content.css" />','Rejestracja'); ?>

<div class="body vspace_4 row">
<?php require_once(View::commonPath('sidenav.php')); ?>

<div class="content">
                <div class="register_box">
                    <h1>Rejestracja</h1>
                    <?php if(!empty($this->args['errors'])){ ?>
                    	<ul class="error">
                    <?php
	                    foreach ($this->args['errors'] as $error ) {
	                    	
	                    	echo '<li>'.$error.'</li>';
	                    	
	                    }
                    ?>
                    	</ul>
                   <?php } ?>
                    <form method="post" action="<?php echo URL.'registration' ?>">
                    	<label>Login: <input type="text" name="login" required /></label>
                    	<label>Email: <input type="email" name="email" required /></label>
                        <label>Hasło: <input type="password" name="password" required /></label>
                        <label>Powtórz Hasło: <input type="password" name="password_2" required /></label>
                        <label><input type="checkbox" name="accept" value="1" required />Zapoznałem się z regulaminem sklepu i akceptuje jego treść.</label>
                        <input type="submit" class="btn" value="zarejestruj się"/>
                    </form>
                </div>
            </div>
        
        </div>

<?php View::footer(); ?>
