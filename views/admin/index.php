<!doctype html>
<html>
<head>
	<title>Panel Administratora</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="<?php echo URL.'views/public/css/normalize.css';?>">
	<style type="text/css">
		body {

			width: 100%;
			min-width: 800px;
			margin: 0;
			background-color: #F8F8F8;
			color: #121515;
			font-family: 'Arial';
			font-size:0.8em;

		}

		.menubar {

				background-color: #EDEDED;

		}

		.clear {

			clear: both;

		}
		.menu {
			width: 200px;
			color: #FFF;
			padding-left: 20px;
			line-height: 50px;
			background-color: #008EDD;
			float: left;


		}
		.login {

			float: right;
			line-height: 50px;
			padding-right: 5%;

		}

		.login a {
			padding-left: 20px;
			text-decoration: none;
			color: #121515;
			font-weight: bold;


		}

		.left {

			width: 220px;
			height: 100vh;
			background: #121515;
			float: left;

		

		}

		.left ul {

			list-style: none;
			padding: 0;
			margin:0;

		}

		.left ul li {

			margin-top: 1px;


		}

		.left ul a {

			display: inline-block;
			width: 197px;
			border-left: 3px solid #232A32;
			line-height: 50px;
			background-color: #232A32;
			padding-left: 20px;
			text-decoration: none;
			color: #FFF;

		}

		.left ul a:hover {

			border-left: 3px solid #008EDD;
			background-color: #121515;

		}

		.content {

			padding: 20px;
			padding-left: 240px;

		}

	</style>


		<style type="text/css">
			
			.category {

				padding: 20px;
				background-color: #FFF;
				border-radius: 10px;
				border:1px solid #EDEDED;
				margin-bottom: 20px;

			}

			.category h3 {

				color: #008EDD;
				padding:15px;
				margin: 0;
				border-bottom: 1px solid #EDEDED;

			}

			.category ul {
				padding: 0;
				list-style: none;


			}

			.category ul li span.cat_name {

				width: 200px;
				display: inline-block;
				background-color: #F8F8F8;
				padding-left: 10px;
				margin-bottom: 1px;
				line-height: 30px;
				border: 1px solid #EDEDED;

			}

			[class^="button"] {
				border:0;
				display: inline-block;
				background-color: #008EDD;
				padding: 5px 20px;
				border-radius: 5px;
				color:#FFF;
				text-decoration: none;
			}

			[class^="button"]:hover {
				background-color: #0052DD;
				cursor: pointer;



			}
			
			.empty{
				
				font-size: 1.2em;
				text-align: center;
				
			}
			
			.replaced_input {
				width: 208px;
				line-height: 30px;
			
			}
			
			
			
			
			label {
				display: block;
				width: 200px;
				margin-bottom: 20px;
			}

			label input {

				width: 200px;

			}

			textarea#TypeHere {

				width: 500px;
				height: 300px;
				resize:none;

			}


		
			table {
				width: 100%;

			}

			table thead {

				background-color: #008EDD;
				color: #FFF;

			}

			table tr td{

				padding: 5px;

			}
			
			.noeditor {
				width:500px;
				height:150px;
				resize:none;
			
			
			}
			label {

				display: block;
				margin-bottom: 20px;

			}
			
			label.text{
			
				width:100%;
			
			}
			textarea.message {

				display: block;
				width: 100%;
				height:200px;
				resize:none;
			}
			.clickable {
				cursor: pointer;
			
			}
			tr {
			border-bottom: 1px solid #FFF;
			}
			.red {
				background-color: #FF3333;
				
			}
			.yellow {
				background-color: #FFFF33;
			}
			
			
			
			
			
			table tr td img {

				width: 50px;

			}










			.button {

				display: inline-block;
				background-color: #008EDD;
				padding: 5px 20px;
				border-radius: 5px;
				color:#FFF;
				border: 0;
				margin:5px 0;
				text-decoration: none;
			}

			.button:hover {
				background-color: #0052DD;
				cursor: pointer;



			}

			label {
				display: block;
				width: 150px;
				margin-bottom: 20px;
			}

			label input {

				width: 200px;

			}

			textarea#TypeHere {

				width: 500px;
				height: 300px;
				resize:none;

			}
			
			
			
			
			
			#upload_file {
			display: inline-block;
			min-width: 200px;
			min-height: 200px;
			border: 1px solid #EDEDED;
			border-radius: 5px;
			text-align: center;

		   }
		    #upload_file p {

			padding: 50px;
			width:100px;

		   }
			
			
			.change_logo {
			
				margin-top: 10px;
				
			
			}
			
			ul li a.selected {
			
				border-left: 3px solid #008EDD ;
				background-color: #121515;
			}
			

	</style>
	
	<script type="text/javascript" src="<?php echo URL.'views/public/js/jquery.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo URL.'views/public/js/jquery.form.js'; ?>"></script>
	
	
	<script type="text/javascript">
	
	$( document ).ready(function() {

	
			$( ".main" ).click(function(e) {
				e.preventDefault();
				$(".left ul a").removeClass("selected");
				$( ".left ul a.main" ).addClass("selected");
				$.ajax({url: "<?php echo URL.'admin/main';?>" , 
					
					success: function(result){
				$(".content").html(result);
				 }});
	
			});
			
			$(".main").click();
			
			$( ".cats" ).click(function(e) {
					e.preventDefault();
					$(".left ul a").removeClass("selected");
					$( ".left ul a.cats" ).addClass("selected");
					$.ajax({url: "<?php echo URL.'admin/category';?>" , 
						
						success: function(result){
					$(".content").html(result);
					 }});

			});


			$( ".message" ).click(function(e) {
				e.preventDefault();
				$(".left ul a").removeClass("selected");
				$( ".left ul a.message" ).addClass("selected");
				$.ajax({url: "<?php echo URL.'admin/messages';?>" , 
					
					success: function(result){
				$(".content").html(result);
				 }});

			});
			

			$( ".products" ).click(function(e) {
				e.preventDefault();
				$(".left ul a").removeClass("selected");
				$( ".left ul a.products" ).addClass("selected");
				$.ajax({url: "<?php echo URL.'admin/products';?>" , 
					
					success: function(result){
				$(".content").html(result);
				 }});

		});
		


			$( ".orders" ).click(function(e) {
				e.preventDefault();
				$(".left ul a").removeClass("selected");
				$( ".left ul a.orders" ).addClass("selected");
				$.ajax({url: "<?php echo URL.'admin/orders';?>" , 
					
					success: function(result){
				$(".content").html(result);
				 }});
				$(".num_order").text("");

		});
			


			$( ".page" ).click(function(e) {
				e.preventDefault();
				$(".left ul a").removeClass("selected");
				$( ".left ul a.page" ).addClass("selected");
				$.ajax({url: "<?php echo URL.'admin/page';?>" , 
					
					success: function(result){
				$(".content").html(result);
				 }});

		});

		

	});



	
	</script>
	

</head>
<body>
<div class="menubar">
	<div class="menu">Menu</div>
	<div class="login"><a href="<?php echo URL.'logout'?>">Wyloguj się</a></div>
	<div class="clear"></div>
</div>
<div class='left'>
	<ul>
		<li><a href="#" class="main">Główna</a></li>
		<li><a href="#" class="cats">Kategorie</a></li>
		<li><a href="#" class="products" >Produkt</a></li>
		<li><a href="#" class="message">Wiadomości<span class="num"><?php echo ($this->args['unreaded'] !=0 ) ? '('.$this->args['unreaded'].')':'';?></span></a></li>
		<li><a href="#" class="orders">Zamówienia<span class="num_order"></span></a></li>
		<li><a href="#" class="page">Strony</a></li>
	</ul>
</div>
<div class="content">

	






















</div>

<script>

var lastId = function() {
	
	this.lastMessageId,
	this.counter = 0
	
};

lastId.prototype = {
		
	setLastId : function(id) {
		this.lastMessageId = id;
	},

	getLastId : function() {
		return this.lastMessageId;
	},

	increaseCounter : function() {
		this.counter++;
	},
	decreaseCounter : function() {
		this.counter--;
	},

	setCounter : function(val) {
		this.counter = val;
	},

	getCounter : function() {
		return this.counter;
	},

	resetCounter : function() {
		this.counter = 0;
	}
	

};

var order_id = new lastId();
order_id.setLastId(<?php echo $this->args['maxid'];?>);

function updateOrder(nr, date, id) {

	var nr = nr;
	var value = id;
	var date = date;
	$("#table_1 tbody").prepend("<tr class=\"red\">"+
	"<form action=\"#\" method=\"post\" class=\"form_1\"><td class=\"clickable btn\" value=\""+value+"\">" + nr + "</td>"+
	"<td value=\""+value+"\"><input type=\"hidden\"  name=\"id\" value=\""+value+"\" />"+  
	"<select class=\"status\" name=\"status\"><option value=\"1\">złożono</option><option value=\"2\">przyjęto</option><option value=\"3\">wysłano</option></select></td><td>"+ date +"</td><td value=\""+value+"\"></td></tr>");

	emptyOrders();

	$(".status").unbind("change");
	$(".status").on("change", change);
	$(".btn").unbind();
	$(".btn").on("click", btn);

}


$(this).ready(function() {
	LastOrder();
	
	setInterval(newOrderUpdate, 1000);
});


function LastOrder() {
	$.ajax({url: "<?php echo URL.'admin/checkingNewOrders';?>" ,
		method: "POST",
		dataType: "json",
		data: {max : 1},
		success: function(result){	
			order_id.setLastId(result['maxid']);
			
	 	}});	
};


function newOrderUpdate() { 

		
		
		$.ajax({url: "<?php echo URL.'admin/checkingNewOrders';?>" ,
			method: "POST",
			data: {v : order_id.getLastId()},
			dataType: "json",
			success: function(result){	
			var end = result.length;
			
			var start = 0;
			for(start; start < end; start++) {
				
				if(result[start]['id'] > order_id.getLastId()) {
					newOrderInfo();
					order_id.setLastId(result[start]['id']);
					updateOrder(result[start]['nr'], result[start]['date'], result[start]['id']);
					
				}
					
					
				}

			}
			
			
		 });
		
}


function newOrderInfo() {

	$(".num_order").text("(Nowe)");
	
}



</script>










<script>

var lastMessageId = function() {
	
	this.lastMessageId,
	this.counter = 0
	
};

lastMessageId.prototype = {
		
	setLastId : function(id) {
		this.lastMessageId = id;
	},

	getLastId : function() {
		return this.lastMessageId;
	},

	increaseCounter : function() {
		this.counter++;
	},
	decreaseCounter : function() {
		this.counter--;
	},

	setCounter : function(val) {
		this.counter = val;
	},

	getCounter : function() {
		return this.counter;
	},

	resetCounter : function() {
		this.counter = 0;
	}
	

};

var id = new lastMessageId();


function update(name, message, date, id) {

	$("#messages_table").prepend("<tr><td>"+name+"</td><td class=\"user_message clickable\" value=\""+id+"\">"+message+"</td><td>"+date+"</td></tr>");
	$(".user_message").unbind();
	$(".user_message").on('click', user_message);

}


$(this).ready(function() {
	LastMessage();
	setInterval(newMessagesUpdate, 5000);
});


function LastMessage() {

	$.ajax({url: "<?php echo URL.'admin/checkingNewMessages';?>" ,
		method: "POST",
		dataType: "json",
		data: {max : 1},
		success: function(result){	
			id.setLastId(result['maxid']);
			id.setCounter(result['unreaded']);
			
			
	 	}});	
};


function newMessagesUpdate() { 

	
		$.ajax({url: "<?php echo URL.'admin/checkingNewMessages';?>" ,
			method: "POST",
			data: {v : id.getLastId()},
			dataType: "json",
			success: function(result){	
			var end = result.length;
			
			var start = 0;
			for(start; start < end; start++) {
				if(result[start]['id'] > id.getLastId()) {
					if($("#messages_table").length){
						update(result[start]['author'], result[start]['message'], result[start]['date'], result[start]['id']);
					}
					id.setLastId(result[start]['id']);
					id.increaseCounter();
					
				}

			};
			newMessagesInfo();
			
		 }});
		
}

function newMessagesInfo() {
	
	var num = id.getCounter();
	if(num != 0) {
		
		$(".num").text('('+num+')');
		
	}else {
		
		$(".num").text('');
		
	}
}

</script>

</body>
</html>
