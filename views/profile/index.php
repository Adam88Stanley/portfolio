<?php use Lib\View; ?>
<?php View::header(); ?>
<div class="content" style="height: 300px ">
<?php
$array = $this->args;
if(!empty($array)) {
	
	foreach ($array as $key=>$value) {
		echo $value.'<br>'; 
	}
	
}	
?>
</div>
<?php View::footer(); ?>