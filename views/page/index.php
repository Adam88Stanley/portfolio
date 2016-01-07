<?php use Lib\View; ?>

<? View::header($this->args['page']['title'].' '.$this->args['page']['header'].' '.$this->args['page']['style']); ?>

<div class="body vspace_4 row">
<?php require_once(View::commonPath('sidenav.php')); ?>
<div class="content">

	<?php 
	
		echo $this->args['page']['content'];
	
	?>



</div>
</div>
<?php View::footer(); ?>
