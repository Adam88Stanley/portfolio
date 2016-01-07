	<div class="category">
		<h3>Kategorie</h3>
		<?php if(!empty($this->args['categories'])) {?>
		<ul id="cat_list">
		<?php 
		
			foreach ($this->args['categories'] as $c){
				
				echo '<li><span class="cat_name" id="cat_'.$c['id'].'">'.
						$c['name'].'</span><span class="E_D"><span class="edit_cat clickable"  value="'.$c['id'].'"> 
				Edytuj</span> / <span class="delete_cat clickable" value="'.$c['id'].'">Usuń</span></span></li>';
				
			}
		
		?>
		</ul>
			
		
		<?php } else {?>
			
			<p class="empty">Brak Kategorii.</p>
		
		<?php }?>
		<span class="button_add_cat">dodaj</span>
	</div>

	<div class="category">
		<h3>Podkategorie</h3>
		<?php if(!empty($this->args['categories'])) {?>
		<ul>
		<?php 
		
			foreach ($this->args['sub_categories'] as $c){
				
				echo '<li><span class="cat_name" id="sub_cat_'.$c['id'].'">'.
						$c['name'].'</span>
					<span class="E_D"><span class="edit_sub_cat clickable"  value="'.$c['id'].'"> 
					Edytuj</span> / <span class="delete_sub_cat clickable" value="'.$c['id'].'">Usuń</span></span></li>';
				
			}
		
		?>
		</ul>
			
		
		<?php } else {?>
			
			<p class="empty">Brak Kategorii.</p>
		
		<?php }?>
		
		<span class="button_add_sub_cat">dodaj</span>
	</div>
<script type="text/javascript">



$( ".delete_sub_cat" ).on('click', delecteSub );

function delecteSub() {

	if(!confirm("Usunąć podkategorię ?")){

		return 1;
	}
	
	var value = $(this).attr("value");
	
	$.ajax({url: "<?php echo URL.'admin/add_delete_subcat';?>" ,

		method: "POST",
		data: { del: '1', id:value},
		success: function(result){
			$('#sub_cat_'+value).parent().replaceWith("");
			
			
	 }});

}		
	
$( ".button_add_sub_cat" ).on('click', addSubCat );


function addSubCat() {

var ul = $(this).prev();
var d = new Date();
var form_id =  d.getTime();
ul.append("<li><form action=\"#\" id=\""+form_id+"\" method=\"post\" ><input class=\"replaced_input\"  name=\"val\"  type=\"text\" /> <input class=\"button_add_new"+form_id+"\" type=\"submit\" value=\"OK\" /></form></li>");


$( ".button_add_new"+form_id).click( function(e) {
	e.preventDefault();
	$.ajax({url: "<?php echo URL.'admin/add_delete_subcat';?>" ,
		method: "POST",
		data: $("#"+form_id).serialize(),
		dataType: "json",
		success: function(result){
			$('#'+form_id).replaceWith("<span class=\"cat_name\" id=\"sub_cat_"+result['id']+"\"  ></span><span class=\"E_D\" ><span class=\"edit_sub_cat\" value=\""+result['id']+"\" > Edytuj</span> / <span class=\"delete_sub_cat\"  value=\""+result['id']+"\">Usuń</span></span>");
			$("#sub_cat_"+result['id']).html(result['v']);
			$( ".edit_sub_cat" ).on('click',subcat );
			$( ".delete_sub_cat" ).on('click', delecteSub );
			
	 }});
	
});

	
}



$( ".delete_cat" ).on('click', delecteCat );

function delecteCat() {

	if(!confirm("Usunąć kategorię ?")){

		return 1;
	}
	
	var value = $(this).attr("value");
	
	$.ajax({url: "<?php echo URL.'admin/add_delete_cat';?>" ,

		method: "POST",
		data: { del: '1', id:value},
		success: function(result){
			$('#cat_'+value).parent().replaceWith("");
			
			
	 }});

}		
	
$( ".button_add_cat" ).on('click', addCat );


function addCat() {


var d = new Date();
var form_id =  d.getTime();
var ul = $(this).prev();
ul.append("<li><form action=\"#\" id=\""+form_id+"\" method=\"post\" ><input class=\"replaced_input\"  name=\"val\"  type=\"text\" /> <input class=\"button_add_new"+form_id+"\" type=\"submit\" value=\"OK\" /></form></li>");


$( ".button_add_new"+form_id).click( function(e) {
	e.preventDefault();
	$.ajax({url: "<?php echo URL.'admin/add_delete_cat';?>" ,
		method: "POST",
		data: $("#" + form_id).serialize(),
		dataType: "json",
		success: function(result){
			
			$('#'+form_id).replaceWith("<span class=\"cat_name\" id=\"cat_"+result['id']+"\"  ></span><span class=\"E_D\" ><span class=\"edit_cat\" value=\""+result['id']+"\" > Edytuj</span> / <span class=\"delete_cat\"  value=\""+result['id']+"\">Usuń</span></span>");
			$("#cat_"+result['id']).html(result['v']);
			$( ".edit_cat" ).on('click',cat );
			$( ".delete_cat" ).on('click', delecteCat );
			
	 }});
	
});

	
}
	

$( ".edit_cat" ).on('click',cat );

function cat() {
		
		var value = $(this).attr("value");
	
		content = $( "#cat_" + value ).text();
		$( "#cat_" + value ).replaceWith( "<form action=\"#\" id=\"form"+value+"\" method=\"post\" ><input class=\"replaced_input\"  name=\"val\"  type=\"text\" /><input type=\"hidden\" name=\"id\" value=\"" + value + "\" /> <input class=\"button"+value+"\" type=\"submit\" value=\"OK\" /></form>" );
		var parent = $(this).parent();
		$(parent).css({display:'none'});
		$( ".button" +value).click( function(e) {
			e.preventDefault();
			$.ajax({url: "<?php echo URL.'admin/test';?>" ,
				method: "POST",
				data: $("#form"+value).serialize(),
				success: function(result){
					$('#form'+value).replaceWith("<span class=\"cat_name\" id=\"cat_" + value + "\"></span> ");
					$("#cat_"+value).html(result);
					$(parent).css({display:'inline-block'});
					
			 }});
			
		});

}


$( ".edit_sub_cat" ).on('click',subcat );

function subcat() {

		var value = $(this).attr("value");
		content = $( "#sub_cat_" + value ).text();
		$( "#sub_cat_" + value ).replaceWith( "<form action=\"#\" id=\"sub_form"+value+"\" method=\"post\" ><input class=\"replaced_input\"  name=\"val\"  type=\"text\" /><input type=\"hidden\" name=\"id\" value=\"" + value + "\" /> <input class=\"button"+value+"\" type=\"submit\" value=\"OK\" /></form>" );
		var parent = $(this).parent();
		$(parent).css({display:'none'});
		$( ".button" +value).click( function(e) {
			e.preventDefault();
			$.ajax({url: "<?php echo URL.'admin/test2';?>" ,
				method: "POST",
				data: $("#sub_form"+value).serialize(),
				success: function(result){
					$('#sub_form'+value).replaceWith("<span class=\"cat_name\" id=\"sub_cat_" + value + "\"></span> ");
					$("#sub_cat_"+value).html(result);
					$(parent).css({display:'inline-block'});
					
			 }});
			
		});

}

	
</script>

