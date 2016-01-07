	<div class="category">
		<h3 id="scroll" >Dodaj produkt</h3>
		<form id="product_form" method="post">
			<label>Kategoria:
			<?php if($this->args['cats']) {?>
				<select id="category" name="category">
				<?php foreach ($this->args['cats'] as $c) {?>
				
					<option value="<?php echo $c['id']; ?>"><?php echo $c['name']; ?></option>
				
				<?php }?>
				</select>
			<?php }else { ?>
				<p class="empty">Brak zdefiniowanych kategorii.</p>
			<?php }?>
			</label>
			<label>Podkategoria:
				<?php if($this->args['sub_cats']) {?>
				<select id="sub_category" name="sub_category">
				<?php foreach ($this->args['sub_cats'] as $c) {?>
				
					<option value="<?php echo $c['id']; ?>"><?php echo $c['name']; ?></option>
				
				<?php }?>
				</select>
			<?php }else { ?>
				<p class="empty">Brak zdefiniowanych podkategorii.</p>
			<?php }?>
			</label>
			<label>Nazwa:<input type="text" id="product_name" name="name"/></label>
			<label>Zdęcie:
			<div id = "upload_file">
			<p>Aby dodać zdjęcie przeciągnij i upuść lub kliknij w pole.</p>
			</div>
			<input type="file" id="file_image" style="visibility:hidden"/>
			<div class="error"></div>
			
			
			
			</label>
			<label>Opis:<textarea id="product_content" name="content" ></textarea></label>
			<label>Ilość:<input type="text" id="product_quantity" name="quantity" /></label>
			<label>Cena:<input type="text" id="product_price" name="price" /></label>
			Promocja: <input type="checkbox" id="product_promo" name="promo" value="1" /><br/>
			<span class="promotion"></span>
			<labe>Dodatkowe pola: <span class="button">+</span></label>
			<div id="fields"></div>
			<button class="button_add">Dodaj produkt</button>
		</form>

	</div>

	<div class="category">
		<h3>Produkt dnia</h3>
		<?php if($this->args['day_product']) {?>
		<form>
			<table>
			<?php if(!empty($this->args['day_product']['img'])) {?>
				<tr class="tr_day_product">
			<?php } else {?>
				<tr class="tr_day_product" style="display:none;">
			<?php }?>
					<td style="width:100px"><img id="d_product" src="<?php echo URL.'views/public/'.$this->args['day_product']['img']; ?>" alt=""></td>
					<td style="width:200px" id="name"><?php echo $this->args['day_product']['name']; ?></td>
					<td style="width:200px" id="price"><?php echo $this->args['day_product']['price']; ?>zł</td>
				<tr>
				
				
				<tr>
					<td>
						<label>Wybierz produkt dnia:
						
						<?php if($this->args['products']) {?>
							<select class="day_p" name="day_product">
								<option value="0">Brak</option>
								<?php
									foreach($this->args['products'] as $p) {
										
										echo '<option value="'.$p['id'].'"'.($p['id'] == $this->args['day_product']['id'] ? 'selected' : '').'>'.$p['name'].'</option>';
										
									}
								?>
								
							</select>
						<?php } else {?>
				
					<p class="empty">Brak produktów do wyboru.</p>
				
				<?php }?>
						</label>
					</td>
				</tr>
				
				
				
			</table>
		</form>
		<?php }else {?>
		
			<p class="empty">Brak produktu dnia.</p>
		
		<?php }?>
	</div>
	
	
	
	
	
	
	
	
	
	<div class="category">
		<h3>Produkty na pasku</h3>
		<?php if(!empty($this->args['slider_products'])) {?>
			<table id="slider_table">
				
					
				<?php foreach ($this->args['slider_products'] as $p) {?>
				
				<tr class="tr_slider_product">
					<td style="width:100px"><img src="<?php echo URL.'views/public/'.$p['img']; ?>" alt=""></td>
					<td style="width:200px"><?php echo $p['name']; ?></td>
					<td style="width:200px"><?php echo $p['price']; ?>zł</td>
					<td><span value="<?php echo $p['id']; ?>" class="clickable delete_f_s">Usuń</span></td>
				<tr>
				
				<?php }?>
			
				
			</table>

		<?php }else {?>
		
			<p class="empty">Brak produktów na pasku.</p>
		
		<?php }?>
		<form>
			<label>Wybierz produkt na pasek:
						
						<?php if($this->args['products']) {?>
							<select class="slider_p" name="slider_product">
								<option value="0">Brak</option>
								<?php
									foreach($this->args['products'] as $p) {
										
										echo '<option value="'.$p['id'].'"'.($p['id'] == $this->args['day_product']['id'] ? 'selected' : '').'>'.$p['name'].'</option>';
										
									}
								?>
								
							</select>
						<?php } else {?>
				
					<p class="empty">Brak produktów do wyboru.</p>
				
				<?php }?>
			</label>
		</form>
	</div>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	<div class="category">
		<h3>Produkty</h3>
		<?php if($this->args['products']) {?>
		<table id="product_list">
			<tr>
				<td style="width:30px">Nr</td>
				<td style="width:100px">Zdjęcie</td>
				<td style="width:200px">Nazwa</td>
				<td style="width:100px">Sztuk</td>
				<td>Cena</td>
			<tr>
			
			
			<?php 
				$nr = 0;
				foreach($this->args['products'] as $p) {
			?>
				
				<tr>
					<td class="nr"><?php echo ++$nr; ?></td>
					<td><img src="<?php echo URL.'views/public/'.$p['img']; ?>"></td>
					<td><?php echo $p['name']; ?></td>
					<td><?php echo $p['quantity']; ?></td>
					<td><?php echo $p['price']; ?>zł</td>
					<td><span class="clickable edit_product" value="<?php echo $p['id']; ?>" >Edytuj </span> / <span class="clickable delete_product"  value="<?php echo $p['id']; ?>" >Usuń</span></td>
				</tr>
	
			<?php }?>
		</table>
		<?php } else {?>
			
			<p class="empty">Brak produków.</p>
		
		<?php }?>
	</div>
	
<script type="text/javascript">


		


		$(".delete_f_s").on('click', delete_f_s);

		function delete_f_s() {

			var val = $(this).attr("value");
			var tr = $(this).parent().parent(); 


			$.ajax({url: "<?php echo URL.'admin/deleteFromSlider';?>" ,
				method: "POST",
				data: {id: val},
				success: function(result){
					
					$(tr).remove();
				
			 }});

			

		}









		$(".slider_p").change(function(){

			var product_id = $(this).val();
			var form = $(this).closest('form');
			
			if($(".button_add_to_slider").length == 0){
				$(".button_add_to_slider").unbind();
				$(form).append("<input type=\"submit\" class=\"button_add_to_slider\" value=\"Dodaj\" />");

				$(".button_add_to_slider").click(function(e){
					e.preventDefault();


					$.ajax({url: "<?php echo URL.'admin/addToSlider';?>" ,
						method: "POST",
						data: {id_new_product:product_id},
						dataType: "json",
						success: function(result){

							updateSliderTable(result["img"],result["name"],result["price"],result["id"]);
						
					 }});

					
					$(".button_add_to_slider").remove();
				});
			}

		
				
			
		});


	function updateSliderTable(img,name,price,id) {

			$("#slider_table").append("<tr><td><img src=\"<?php echo URL.'views/public/' ?>"+img+"\" alt=\"\"></td>"+
			"<td>"+ name+ "</td>"+
			"<td>"+ price +" zł</td>"+
			"<td><span value=\""+ id +"\" class=\"clickable delete_f_s\">Usuń</span></td></tr>");
			$(".delete_f_s").unbind();	
			$(".delete_f_s").on('click', delete_f_s);


		}







		

			

		$(".edit_product").on('click', editProduct);

		function editProduct(){
			
			$(".edit_product").unbind();
			
			$('html, body').animate({
		        scrollTop: $("#scroll").offset().top
		    }, 2000);
			
			clearForm();
			$("#upload_file p").css({display:'none'});
			var val = $(this).attr("value");
			$("#product_id").remove();
			$("#product_form").append("<input type=\"hidden\" id=\"product_id\" name=\"id\" value=\""+val+"\" />");
			$.ajax({url: "<?php echo URL.'admin/editProduct';?>" ,
				method: "POST",
				data: {id:val},
				dataType: "json",
				success: function(result){
					
					if(!$(".button_change").length){
						
						$("#product_form").append("<input type=\"submit\" class=\"button_change\" name=\"change_product\" value=\"Zmień\" />");
						$(".button_change").click(function(e){

							e.preventDefault();  
						    e.stopPropagation();
							change_product();
							
							$("#product_form").parent().children("h3").text("Dodaj produkt");
							$(".button_change").remove();
							$(".button_add").css({display:"block"});
							
						});
					

					}
					
					$(".button_add").css({display:"none"});
					$("#product_form").parent().children("h3").text("Edytuj produkt");
					
					$("#product_name").val(result["name"]);
					$("#product_price").val(result["price"]);
					$("#product_quantity").val(result["quantity"]);
					$("#product_content").val(result["description"]);
					$("#category").val(result["category"]);
					$("#sub_category").val(result["sub_category"]);
					
					if(result["promotion"] != undefined && !$(".promotion label").length){
						
						$("#product_promo").click();
						
						
					}else if(result["promotion"] == undefined && $(".promotion label").length){

						$("#product_promo").click();
						
					}
					
					if($(".promotion label").length) {
						
						$("#percent").val(result["promotion"] * 100);

					}

					if(result['additional_info'] != undefined) {
						var end = result['additional_info'].length;
						var start = 0;
						for(start; start < end; start++) {
							$(".button").click();
							$("#product_variable_nr"+(start+1)).val(result['additional_info'][start]["name"]);
							$("#product_value_nr"+(start+1)).val(result['additional_info'][start]["value"]);
							$("#product_value_nr"+(start+1)).closest('fieldset').append("<input class=\"field_id\" type=\"hidden\" value=\""+result['additional_info'][start]["id"]+"\"/>");
							$("#product_value_nr"+(start+1)).closest('fieldset').attr('class','old_field');
						} 

					}
					
					if(result['img'] != '') {
					   $("#upload_file").append("<div  style=\" display:inline-block; width:200px; margin:10px; position:relative\"><span value=\""+result["id"]+"_main"+"\" class=\"image_delete\" style=\" display:block; background-color:#008EDD; color:white; line-height:20px; width:20px; position:absolute; top:0; right:0;\">x</span><img style=\"width:100%;\" src=\"<?php echo URL.'views/public/';?>"+result['img']+"\"/></div>");
					   $(".image_delete").unbind('click');
					   $(".image_delete").on('click', imageDelete);
					}

					if(result["additional_imgs"][0]["product_image"] != undefined) {

						var start = 0;
						var end = result["additional_imgs"].length;

						for(start; start < end; start++) {

							   $("#upload_file").append("<div  style=\" display:inline-block; width:200px; margin:10px; position:relative\"><span value=\""+result["additional_imgs"][start]["id"]+"\" class=\"image_delete\" style=\" display:block; background-color:#008EDD; color:white; line-height:20px; width:20px; position:absolute; top:0; right:0;\">x</span><img style=\"width:100%;\" src=\"<?php echo URL.'views/public/';?>"+result["additional_imgs"][start]["product_image"]+"\"/></div>");
							   $(".image_delete").unbind('click');
							   $(".image_delete").on('click', imageDelete);
							   
						}

					}	
							
			 }});

			$(".edit_product").on('click', editProduct);
			
		}





		function change_product() {

		 
		   var files = imgArray.getAllImages();
		    
		   files = jQuery.grep(files, function(n, i){
			   return (n !== "" && n != null);
			 });

		    form = $("#product_form");
		    
		    var data = new FormData();


			for(var i = 0; i < files.length; i++) {
			
				data.append('files[]', files[i][0]);
				
			}

			data.append('name', $("#product_name").val());
			data.append('price', $("#product_price").val());
			data.append('quantity', $("#product_quantity").val());
			data.append('category', $("#category").val());
			data.append('sub_category', $("#sub_category").val());
			data.append('product_description', $("#product_content").val());
			data.append('promo', $("#product_promo").is(":checked"));
			data.append('percent', $("#percent").val());
			data.append('id', $("#product_id").val());
			data.append('change_product', true);
			data.append('main_img_to_delete', $(".main_img_to_delete").val());

			var tab = $(".imgs_to_delete");

			for(var i=0; i < tab.length; i++){

				data.append('img_to_del_nr_'+ i, $(tab[i]).val());
				
			}

			data.append('length', tab.length);
			

			var to_change = 0;

			$('.old_field').each(function(i, k) {
				
				to_change++;
				var val = $(k).children().children('[id^=product_variable]').val();
				var id = $(k).children('.field_id').val();
				data.append("ch_product_variable_nr_" + i , val);
				data.append("id_ch_product_variable_nr_" + i , id);

			});


			$('.old_field').each(function(i, k) {

				var val = $(k).children().children('[id^=product_value]').val();
				data.append("ch_product_value_nr_" + i , val);

			});

		  	data.append("num_of_variables_to_change", to_change);


		  	var new_fields = 0;

			$('.new_field').each(function(i, k) {

				new_fields++;
				var val = $(k).children().children('[id^=product_variable]').val();
				data.append("product_variable_nr_" + i , val);

			});


			$('.new_field').each(function(i, k) {

				var val = $(k).children().children('[id^=product_value]').val();
				data.append("product_value_nr_" + i , val);

			});

		  	data.append("num_of_variables", new_fields);
			

			var to_delete = 0;
			
		  	$('.field_to_delete').each(function(i, k) {
			  	
		  		to_delete++;
				var val = $(k).val();
				data.append("field_id_to_delete_" + i , val);

			});

		  	data.append("to_delete", to_delete);


		  	
			
			$.ajax({url: "<?php echo URL.'admin/editProduct';?>" ,
				method: "POST",
				data: data,
				dataType: "json",
				cache: false,
			    contentType: false,
			    processData: false,
				success: function(result){
					updateProductOnList(result['img'], result['name'], result['quantity'], result['price'], result['id']);
					alert("Zmiany zostały zapisane.");
					clearForm();
				
			 }});

			
		}
				


		

		

	
		$("#product_promo").click(function() {

			
			if($(".promotion label").length) {
				
				$(".promotion").html("");

			}else {
				
				$(".promotion").html("<label>Procent: <input type=\"text\" id=\"percent\" name=\"percent\" /></label>");

			}

			

		});
		

		var FieldAdder = {
			field:0,
			add: function(){
				this.field++;
			},
			get: function(){
				return this.field;
			},
			reset: function(){
				this.field=0;
			}
			

		};

		
	
	$(".button").click(function (e) {

		FieldAdder.add();
		var form = $(this).parent().parent();
		var next = $(this);
		$("#fields").append("<fieldset class=\"new_field\"><legend>Pole "+FieldAdder.get()+ " / <span class=\"clickable delete_field\" value=\""+FieldAdder.get()+"\">Usuń</span></legend><label>Nazwa: <input type=\"text\" name=\"product_variable_nr"+FieldAdder.get()+"\" id=\"product_variable_nr"+FieldAdder.get()+"\" /></label><label>Wartość: <input type=\"text\" name=\"product_value_nr"+FieldAdder.get()+"\" id=\"product_value_nr"+FieldAdder.get()+"\"/></label></fieldset>");
		$(".delete_field").unbind();
		$(".delete_field").click(function(){
			var value = $(this).parent().parent().children('.field_id').attr('value');
			if(value) {
				
				$("#product_form").append("<input type=\"hidden\" class=\"field_to_delete\" value=\""+value+"\" />");

			}
			$(this).closest('fieldset').remove();
			
		
		});

	});


	$(".delete_product").on('click',deleteProduct);

	function deleteProduct(){


		var product_id = $(this).attr("value");
	

		$.ajax({url: "<?php echo URL.'admin/deleteProduct';?>" ,

			method: "POST",
			data: {id:product_id},
			success: function(result){
	
			
			
		 }});

	
		
		$(this).closest('tr').remove();


		var index = 1;
		$( ".nr" ).each(function( ) {
			   $( this ).text(index) ;
			   index++;
		});
		
		
	}







	

	$(".day_p").change(function(){

		var product_id = $(this).val();
		var form = $(this).closest('form');
		
		if($(".button_change").length == 0){
			$("button_change").unbind();
			$(form).append("<input type=\"submit\" class=\"button_change\" value=\"OK\" />");
			$(".button_change").click(function(e){
				e.preventDefault();
				

				$.ajax({url: "<?php echo URL.'admin/dayProduct';?>" ,
					method: "POST",
					data: {id_new_product:product_id},
					success: function(result){
					
				 }});

				
				$(".button_change").remove();
			});
		}

		$.ajax({url: "<?php echo URL.'admin/dayProduct';?>" ,
			method: "POST",
			data: {id:product_id},
			dataType: "json",
			success: function(result){

			if(result['name']==null) {
				
				$(".tr_day_product").css({display:'none'});
				
			}else {
				$(".tr_day_product").css({display:'block'});
				$("#d_product").attr('src', result['img']);
				$("#name").text(result['name']);
				$("#price").text(result['price']+"zł");
				
			}
			
		 }});
			
		
	});



function clearForm() {
	
	deleteFields();
	$("#file_image").val("");
	$(".imgs_to_delete").remove();
	$(".main_img_to_delete").remove();
	$(".error").html('');
	$("#product_name").val("");
	$("#product_price").val("");
	$("#product_quantity").val("");
	$("#product_content").val("");
	$("#category").val(1);
	$("#sub_category").val(1);
	if($(".promotion label").length) {
		$("#percent").val("");
		$("#product_promo").click();
	}
	$("#upload_file").html("<p>Aby dodać zdjęcie przeciągnij i upuść lub kliknij w pole.</p>");

}
	

function deleteFields() {
		
	FieldAdder.reset();
	$("#fields").html("");

}

function updateProductOnList(img, name, quantity, price, id) {

	var tr = $('.edit_product[value="1"]').parent().parent();
	var nr = $(tr).children('td:first-child').text();
	$(tr).replaceWith("<tr><td>"+nr+"</td><td><img src=\"<?php echo URL.'views/public/';?>"+img+"\" alt=\"\" /></td><td>"+name+"</td><td>"+quantity+"</td><td>"+price+"</td><td><span class=\"clickable edit_product\" value=\""+id+"\" >Edytuj </span> / <span class=\"clickable delete_product\"  value=\""+id+"\" >Usuń</span></td></tr>");
	$(".delete_product").unbind();
	$(".edit_product").unbind();
	$(".delete_product").on('click',deleteProduct);
	$(".edit_product").on('click', editProduct);
	
}
	
		
	

</script>



<script>



$("#upload_file").on("dragover", function(event) {
    event.preventDefault();  
    event.stopPropagation();
    
});

$("#upload_file").on("dragleave", function(event) {
    event.preventDefault();  
    event.stopPropagation();
    
});



var ImageArray =  function () {

	this.image = []

};


ImageArray.prototype = {

	addImage : function (value) {

			this.image.push(value); 

	},

	deleteImage : function(key) {

		delete this.image[key];

	},

	getImage : function(key) {

		return this.image[key];

	},

	getAllImages : function() {

		return this.image;

	},


};

var imgArray = new ImageArray();

$("#upload_file").on("click", function(event) {

	event.preventDefault();  
    event.stopPropagation();

	$("#file_image").click();
	$("#file_image").unbind('change');

	$("#file_image").change(function(e) {
		if(e.target.files[0] != undefined) {

		    load(e.target.files);
		}

	});

});


$("#upload_file").on("drop", function(event) {

    event.preventDefault();  
    event.stopPropagation();

    	if(event.originalEvent.dataTransfer.files[0] != undefined) {

			load(event.originalEvent.dataTransfer.files);

		}

});



$(".button_add").click(function (e) {

	e.preventDefault();  
    e.stopPropagation();
	
 
   var files = imgArray.getAllImages();
    
   files = jQuery.grep(files, function(n, i){
	   return (n !== "" && n != null);
	 });

    form = $("#product_form");
    
    var data = new FormData();


	for(var i = 0; i < files.length; i++) {
	
		data.append('files[]', files[i][0]);
		
	}

	data.append('name', $("#product_name").val());
	data.append('price', $("#product_price").val());
	data.append('quantity', $("#product_quantity").val());
	data.append('category', $("#category").val());
	data.append('sub_category', $("#sub_category").val());
	data.append('product_description', $("#product_content").val());
	data.append('promo', $("#product_promo").is(":checked"));
	data.append('percent', $("#percent").val());
	var variables = 0;
  	$('[id^=product_variable]').each(function(i, k){

		variables++;
  		data.append("product_variable_nr_" + i , $(k).val());
	 
	}) ;


  	$('[id^=product_value]').each(function(i, k){

  		data.append("product_value_nr_" + i , $(k).val());
	 
	}) ;
  
  	data.append("num_of_variables", variables);
	

	
	$.ajax({url: "<?php echo URL.'admin/addProduct';?>" ,
		method: "POST",
		data: data,
		cache: false,
	    contentType: false,
	    processData: false,
		success: function(result){
			
			alert("Produkt został dodany.");
		
	 }});

	
});



function load(arg) {
	
	if(!$("#upload_file div").length){

		$("#upload_file p").css({display:'none'});

	}

	var error = '';

	$(".error").html('');

	var file_ext = arg[0].name.split('.');
	file_ext = file_ext[file_ext.length-1];

	if(file_ext != 'png' && file_ext != 'jpg' && file_ext != 'jpeg'){

		error = "Niewłasciwy format.";
		printError(error);
		return;

	}

	var file_size = arg[0].size;

	if((file_size/1000000)>3) {

		error = "Plik jest za duży. Maksymalnie 3MB.";
		printError(error);
		return;

	}

	if(($("#upload_file").children().length > 3)) {

		error = "Maksymalnie 3 zdjęcia.";
		printError(error);
		return;

	}

	imgArray.addImage(arg);
	
   	var src = URL.createObjectURL(imgArray.getImage(imgArray.getAllImages().length-1).item(0));
	
    $("#upload_file").append("<div value=\""+((imgArray.getAllImages().length)-1)+"\"  style=\" display:inline-block; width:200px; margin:10px; position:relative\"><span class=\"image_delete\" style=\" display:block; background-color:#008EDD; color:white; line-height:20px; width:20px; position:absolute; top:0; right:0;\">x</span><img style=\"width:100%;\" src=\""+ src +"\"/></div>");
    
    $(".image_delete").on('click', imageDelete);


}





function imageDelete(e){

	e.preventDefault();  
	e.stopPropagation();

	
	$(".error").html('');
	if($("#upload_file").children("div").length < 2){

		$("#upload_file p").css({display:'block'});

	}


	var server_side_img_id = $(this).attr("value");

	if(server_side_img_id != undefined) {

		var result = server_side_img_id.split("_");
		if(result[1] == 'main'){

			$("#product_form").append("<input class=\"main_img_to_delete\" type=\"hidden\" value=\""+ result[0]+ "\" />");
			
		}else {

			$("#product_form").append("<input class=\"imgs_to_delete\" type=\"hidden\" value=\""+ result[0]+ "\" />");
			
		}


	}
	
	$(this).parent().remove();
	imgArray.deleteImage($(this).parent().attr("value"));
	

}


function printError(error) {

	$(".error").append('<p style=\"color:red;\">' + error + '</p>');

}





</script>

