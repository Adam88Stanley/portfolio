<?php use Lib\View; ?>
<? 
View::header('<link rel="stylesheet" type="text/css" href="'.URL.'views/delete/content.css" />','Usuwanie Konta'); 

?>
 <div class="body vspace_4 row">
<?php require_once(View::commonPath('sidenav.php')); ?>
<div class="content">
<h3 class="h3profile">Usuń Konto</h3>
<div class="profile">
<p>Czy napewno chcesz usunąć konto ?</p>
<form method="post" action="<?php echo URL.'user/delete' ?>">
	<input type="hidden" name="delete" value="1" />
	<input type="submit" name="yes" value="Tak"/>
</form>
<form method="post" action="<?php echo URL.'user/delete' ?>">
	<input type="hidden" name="delete" value="0" />
	<input type="submit" name="no" value="Nie"/>
</form>
</div>

</div>
</div>
<?php View::footer(); ?>