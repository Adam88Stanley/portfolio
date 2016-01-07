<div class="category">
		<h3>Logo</h3>
		<form id="form_id" method="post" action="#" enctype="multipart/form-data">
			<div class="change_logo">
				<img id="src" src="<?php echo $this->args['logo'] ;?>" alt="" />
			</div>
			<input type="hidden" name="change" value="1" />
			<input type="file" name="logo" id="logo"  style="visibility: hidden;" /></br>
			<input type="submit" class="button_save" style="display:none;"  value="Zapisz" />
			<button class="button_change">Zmień</button>
		</form>
</div>
<div class="category">
		<h3>Metody wysyłki.</h3>
		
		<ul id="cat_list">
		<?php 
		
			foreach ($this->args['methods'] as $m){
				
				
				echo '<li><span  id="cat_'.$m['id'].'">'.
						'<span class="cat_name">'.$m['name'].'</span> <span class="cat_name" >'.
						$m['cost'].' zł</span></span><span class="E_D"><span class="edit_cat clickable"  value="'.$m['id'].'">
				Edytuj</span> / <span class="delete_cat clickable" value="'.$m['id'].'">Usuń</span></span></li>';
				
				
				
			}
		
		?>
		</ul>
		<span class="button_add_method">dodaj</span>
</div>

<script>

$( document ).ready(function() {
	
	$(".button_change").click(function(e) {
		
		e.preventDefault();
		$("#logo").click();
		
	   	
		
	});

});



$("#logo").change(function(evt) {

	var tgt = evt.target || window.event.srcElement,
    files = tgt.files;

	var fr = new FileReader();
	fr.onload = function () {
		
		$("#src").attr('src', fr.result);
	    
	}
	fr.readAsDataURL(files[0]);

	$(".button_save").css({display:'inline'});

	$(".button_save").click(function(e){

		e.preventDefault();
		save(files[0]);
		$(".button_save").css({display:'none'});
		
	});
 
	
});


function save(file) {

	var data = new FormData();

	data.append('files[]', file);
	data.append('change', $("#change").val());
	
	$.ajax({url: "<?php echo URL.'admin/main';?>" ,
		method: "POST",
		cache: false,
	    contentType: false,
	    processData: false,
		data: data,
		
		success: function(result){
			alert("Zapisano.");
			
	 }});
	
	
}

$( ".delete_cat" ).on('click',deleteMethod );

function deleteMethod() {

	if(!confirm("Usunąć ?")){

		return 1;
	}
	
	var val = $(this).attr('value');
	var button = this;  
	$.ajax({url: "<?php echo URL.'admin/deleteShippingMethod';?>" ,
		method: "POST",
		data: {id:val},
		success: function(result){
		if(result == 1) {

			var li = $(button).parent().parent().remove();
				
		}
			
	 }});
	

}



$(".button_add_method").click(function(){

	var value = Math.round((Math.random()*100));
	
	$( "#cat_list").append( "<li><form action=\"#\" id=\"form"+value+"\" method=\"post\" ><input class=\"replaced_input\"  name=\"method\"  type=\"text\" /><input class=\"replaced_input\"  name=\"cost\"  type=\"text\" /><input type=\"hidden\" name=\"id\" value=\"" + value + "\" /> <input class=\"button"+value+"\" type=\"submit\" value=\"OK\" /></form></li>" );

	$(".button"+value).click(function(e) {

		e.preventDefault();

		$.ajax({url: "<?php echo URL.'admin/addShippingMethod';?>" ,
			method: "POST",
			data: $("#form"+value).serialize(),
			dataType: "json",
			success: function(result){
				$("#form"+value).parent().remove();
				if(result['id'] != undefined ){
					
					tableUpdate(result['id'], result['method'], result['cost']);
					
				}
		 }});
	
	});
	
});



function tableUpdate(id, name, cost) {

 $("#cat_list").append("<li><span  id=\"cat_" + id + "\">"+
			"<span class=\"cat_name\">" + name + "</span> <span class=\"cat_name\" >" + cost +
			" zł</span></span> <span class=\"E_D\"><span class=\"edit_cat clickable\"  value=\""+ id +"\">" +
			"Edytuj</span> / <span class=\"delete_cat clickable\" value=\"" + id + "\">Usuń</span></span></li>");
 $( ".edit_cat" ).unbind();
 $( ".edit_cat" ).on('click',method );
 $( ".delete_cat" ).on('click',deleteMethod );
 
 
}


$( ".edit_cat" ).on('click',method );


function method() {
	
	var value = $(this).attr("value");

	content = $( "#cat_" + value ).text();
	$( "#cat_" + value ).replaceWith( "<form action=\"#\" id=\"form"+value+"\" method=\"post\" ><input class=\"replaced_input\"  name=\"method\"  type=\"text\" /><input class=\"replaced_input\"  name=\"cost\"  type=\"text\" /><input type=\"hidden\" name=\"id\" value=\"" + value + "\" /> <input class=\"button"+value+"\" type=\"submit\" value=\"OK\" /></form>" );
	var parent = $(this).parent();
	$(parent).css({display:'none'});
	$( ".button" +value).click( function(e) {
		e.preventDefault();
		$.ajax({url: "<?php echo URL.'admin/shipping';?>" ,
			method: "POST",
			data: $("#form"+value).serialize(),
			dataType: "json",
			success: function(result){
				
				$('#form'+value).replaceWith("<span  id=\"cat_" + result['id'] + "\">"+
						"<span class=\"cat_name\">"+result['name'] + "</span> <span class=\"cat_name\" >"+
						result['cost'] + " zł</span></span> ");
				$(parent).css({display:'inline-block'});
				
		 }});
		
	});

}







</script>