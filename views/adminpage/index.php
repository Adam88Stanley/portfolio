<div class="category">
		<h3>Kategorie</h3>
		<?php if(!empty($this->args['category_page_names'])) {?>
		<ul>
			<?php foreach ($this->args['category_page_names'] as $name) {
				if($name['name'] === 'Pasek główny'){
					
					echo '<li><span class="cat_name" >'.$name['name'].'</span></li>';
				
				}else {
					
				echo '<li><span class="cat_name" id="cat_page_name_'.$name['id'].'">'.$name['name'].'</span><span class="edit_cat_name clickable" value="'.$name['id'].'"> Edytuj </span></li>';
				
				}
			}
			?>
		</ul>
		<?php }else {?>
		
			<p class="empty">Brak Kategorii.</p>
			
		<?php }?>
	</div>

	


	<div class="category" id="scroll">
		<h3>Dodaj strone</h3>
		<div id="form_div">
			<form action="#" method="post" id="page_form">
				<label>Kategoria:
					<select id="category" name="category">
					<?php if(!empty($this->args['category_page_names'])) {?>
						
						<?php foreach ($this->args['category_page_names'] as $name) {
					
							echo '<option value="'.$name['id'].'">'.$name['name'].'</option>';
							
						}
					
						?>
			
					<?php } else {?>
					 
					 	<option>Brak kategorii</option>
					 
					<?php }?>
					</select>
				</label>
				<label>Nazwa Strony:*<input type="text" id="page_name" name="page_name"  /></label>
				<label>Tytuł:*<input type="text" id="title" name="title"  /></label>
				<label>Nagłówek <br/>HTML(&lt;head&gt;...&lt;/head&gt;):<textarea class="noeditor" id="header" name="header" ></textarea></label>
				<label>Style <br/>HTML(&lt;style&gt;...&lt;/style&gt;):<textarea class="noeditor" id="style" name="style" ></textarea></label>
				<label>Zawartość:*<textarea class="editor" name="cont" id="content_editor" ></textarea></label>
				<input type="hidden" id="content_editor_to_send" name="content" /> 
				<em>* pola wymagane</em><br/>
				<input type="submit" value="Dodaj" class="button_add_new_page" />
			</form>
		</div>
		<span id="form_info"></span>

	</div>

	<div class="category">
		<h3>Strony</h3>
		<?php if(!empty($this->args['pages_names'])) {?>
		<table>
			<thead>
				<tr>
					<td style="width:10%;">Nr</td>
					<td style="width:50%;">Tytuł Strony</td>
					<td style="width:40%;"></td>
				</tr>
			</thead>
			<tbody>
			<?php 
			
			$index = 1;
			foreach ($this->args['pages_names'] as $name) {?>
				<tr>
					<td class="nr"><?php echo $index;?></td>
					<td><?php echo $name['name'];?></td>
					<td><span class="edit_page clickable" value="<?php echo $name['id']?>">Edytuj</span> / <span class="delete_page clickable" value="<?php echo $name['id']?>">Usuń</span></td>
				</tr>
			<?php $index ++;} ?>
			
		</tbody>	
		</table>
		<?php }?>
	</div>
	
<script   type="text/javascript" src="<?php echo URL.'views/public/js/'?>tinymce/tinymce.min.js"></script>
	
<script type="text/javascript">

	tinymce.init({
		mode : "specific_textareas",
        editor_selector : "editor",
	    
	    width:"500px",
	    height:"500px",
	    theme: "modern",
	    language : "pl",
	    plugins: [
	        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
	        "searchreplace wordcount visualblocks visualchars code fullscreen",
	        "insertdatetime media nonbreaking save table contextmenu directionality",
	        "emoticons template paste textcolor colorpicker textpattern imagetools"
	    ],
	    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
	    toolbar2: "print preview media | forecolor backcolor emoticons",
	    image_advtab: true,
	    templates: [
	        {title: 'Test template 1', content: 'Test 1'},
	        {title: 'Test template 2', content: 'Test 2'}
	    ]
	});
	
</script>



<script type="text/javascript"> 


$(".delete_page").on("click", deletePage);


	function deletePage(e) {

	
	
	if(!confirm("Usunąć stronę ?")){

		return 1;
	}
	
	var value = $(this).attr("value");
	var to_del = $(this).parent().parent();
	$(to_del).replaceWith("");

	var index = 1;
	$( ".nr" ).each(function( ) {
		   $( this ).text(index) ;
		   index++;
	});

	
	$.ajax({url: "<?php echo URL.'admin/deletePage';?>" ,
		method: "POST",
		data: {id:value},
		success: function(result){
			
	
	 }});

	
}


$( ".edit_page" ).on("click", editPage); 

function editPage(e) {

	
	$('.button_save_changes').unbind();
	
	var value = $(this).attr("value");
	$("#scroll h3").replaceWith("<h3>Edytuj Strone</h3>");
	$(".button_add_new_page").css({display:'none'});
	
	
	if(!$(".button_cancel").length){
		$("#page_form").append("<span class=\"edit_mode\"><input type=\"hidden\" id=\"page_to_edid_id\" name=\page_to_edid_id\ value=\""+value+"\" /><input type=\"submit\"  class=\"button_save_changes\" value=\"Zapisz\"/> <input type=\"submit\" class=\"button_cancel\" value=\"Anuluj\"/></span>");
	}
	$("#page_to_edid_id").val(value);
	
	$.ajax({url: "<?php echo URL.'admin/editPage';?>" ,
		method: "POST",
		data: {id:value},
		dataType: "json",
		success: function(result){
			$("#category").val(result['category']);
			$('#page_name').val(result['page_name']);
			$('#title').val(result['title']);
			$('#header').val(result['header']);
			$('#style').val(result['style']);
			$('#content_editor_to_send').val(result['content']);
			tinymce.get('content_editor').setContent(result['content']); 
			
	 }});


	$(".button_cancel").click(function(){

		$("#page_form").find("input[type=text], textarea").val("");
		$("#scroll h3").replaceWith("<h3>Dodaj Strone</h3>");
		$(".edit_mode").html('');
		tinymce.get('content_editor').setContent(''); 
		$(".button_add_new_page").css({display:'block'});
		
	});

	 
		
	$( ".button_save_changes" ).click( function (e) {
		e.preventDefault();

		
		$('#content_editor_to_send').val(tinyMCE.get('content_editor').getContent());
		

		$.ajax({url: "<?php echo URL.'admin/editPage';?>" ,
			method: "POST",
			data: $("#page_form").serialize(),
			success: function(result){
				
				$("#form_div").css({display:'none'});
				$("#form_info").append("<p>Strona została zaktualizowana pomyślnie.</p><a href=\"#\" class=\"button_back\">Wróć</a>");
				$(".button_back").click(function(e){
				e.preventDefault();
				$("#page_form").find("input[type=text], textarea").val("");
				tinymce.get('content_editor').setContent(''); 
				$("#form_info").html('');
				$("#scroll h3").replaceWith("<h3>Dodaj Strone</h3>");
				$("#form_info").html('');
				$(".edit_mode").html('');
				$("#form_div").css({display:'block'});
				$(".button_add_new_page").css({display:'block'});
				});
				
		 }});


	});


	    $('html, body').animate({
	        scrollTop: $("#scroll").offset().top
	    }, 2000);
	
	
}




$( ".button_add_new_page" ).click( function (e) {

	e.preventDefault();
	$('#content_editor_to_send').val(tinyMCE.get('content_editor').getContent());
	$("#form_div").css({display:'none'});
	

	$.ajax({url: "<?php echo URL.'admin/addNewPage';?>" ,
		method: "POST",
		data: $("#page_form").serialize(),
		success: function(result){
			

			if(!result) {
				
				$("#form_info").append("<p>Wystąpił błąd podczas dodawania strony.</p><a href=\"#\" class=\"button_back\">Wróć</a>");
				$(".button_back").click(function(e){
					e.preventDefault();
					$("#form_div").css({display:'block'});
					$("#form_info").html('');
				});
				return 0;
			}
			$("#form_info").append("<p>Strona została dodana pomyślnie.</p><a href=\"#\" class=\"button_back\">Wróć</a>");
			$(".button_back").click(function(e){
			e.preventDefault();
			$("#form_div").css({display:'block'});
			$("#page_form").find("input[type=text], textarea").val("");
			tinymce.get('content_editor').setContent(''); 
			$("#form_info").html('');
			});

			
			renderNewPage($("#title").val(), result);
		
	 }});

	
});

function renderNewPage(title, id) {
	
	var nr = ($("table tbody tr").length) + 1;
	$("table tbody").append("<tr class=\"nr\"><td>" + nr + "</td><td>" + title + "</td><td><span class=\"edit_page clickable\" value=\""+ id +"\">Edytuj</span> / <span class=\"delete_page clickable\" value=\"" + id + "\">Usuń</span></td></tr>");
	$(".delete_page").unbind();
	$( ".edit_page" ).unbind();
	$(".delete_page").on("click", deletePage);
	$(".edit_page").on("click", editPage); 
	
}



$( ".edit_cat_name" ).on('click', editCatName );

function editCatName() {

	var thisElement = $(this);
	var value = $(this).attr("value");


	$( "#cat_page_name_"+value ).replaceWith( "<form action=\"#\" id=\"edit_name_form"+value+"\" method=\"post\" ><input class=\"replaced_input\"  name=\"val\"  type=\"text\" /><input type=\"hidden\" name=\"id\" value=\"" + value + "\" /> <input class=\"button_edit"+value+"\" type=\"submit\" value=\"OK\" /></form>" );
	$(thisElement).css({display:'none'});
	
	
	$( ".button_edit" +value).click( function(e) {
		e.preventDefault();
		$.ajax({url: "<?php echo URL.'admin/editCategoryPageName';?>" ,
			method: "POST",
			data: $("#edit_name_form"+value).serialize(),
			success: function(result){
				$('#edit_name_form'+value).replaceWith("<span class=\"cat_name\" id=\"cat_page_name_" + value + "\"></span> ");
				$("#cat_page_name_"+value).html(result);
				$(thisElement).css({display:'inline-block'});
				
		 }});
		
	});


	
}








</script>
