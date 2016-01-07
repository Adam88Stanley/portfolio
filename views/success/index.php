<?php use Lib\View; ?>
<?php View::header('<link rel="stylesheet" type="text/css" href="'.URL.'views/success/content.css" />'); 
 ?>
<div class="success">
	<h3><?php echo $this->args['success'];?>.</h3>
</div>
<?php View::footer(); ?>