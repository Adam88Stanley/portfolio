<?php use Lib\View; ?>
<? View::header('<link rel="stylesheet" type="text/css" href="'.URL.'views/login/content.css" />','Logowanie'); ?>
<div class="body vspace_4 row">
<?php require_once(View::commonPath('sidenav.php')); ?>
  <div class="content">
                <div class="login_box">
                    <h1>Logowanie</h1>
                    
                    	<?php 
                    	
                    		if(!empty($this->args['error'])){
                    			echo '<div class="error">';
                    			echo $this->args['error'];
                    			echo '</div>';
                    		}
                    	
                    	?>
                    
                    <form method="post" action="<?php echo URL.'login' ?>" >
                        <label>Login: <input type="text" name="login" required /></label>
                        <label>Hasło: <input type="password" name="password" required /></label>
                        <label>Zaloguj się jako admin <input style="display:inline; width:5%;" type="checkbox" name="admin"/></label>
                        <input type="submit" class="btn" value="zaloguj się"/>
                    </form>
                    <span>Zapomniałeś hasła? <a href="<?php echo URL ;?>passrecovery/recover">Kliknij</a></span>
                </div>
                <div class="register_box">
                    <h1>Rejestracja</h1>
                    <span>Nie posiadasz konta?</span>
                    <a href="<?php echo URL.'registration' ?>">zarejestruj się</a>
                </div>
            </div>
</div>
<?php View::footer(); ?>