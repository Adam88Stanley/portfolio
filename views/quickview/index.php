<div class="mask hide">
            <div class="box">
                <div class="bar"><?php echo $this->args['name']?><a href="#" class="close" value="0" >x</a></div>
                <div class="box_left_side"><a href="#"><img src="<?php echo URL.'views/public/'.$this->args['img']?>" alt="" /></a></div>
                <div class="box_right_side">
                    <h4><?php echo $this->args['name']?></h4>
                    <div class="box_description">
                        <p><?php echo $this->args['desc']?></p> 
                    </div>
                    <span class="price"><?php echo $this->args['price'];?> zł</span>
                    <a href="<?php echo URL.'cart/addtocart?product_id='.$this->args['id'].'&product_quantity=1&product_price='.$this->args['price'].'&product_name='.$this->args['name']; ?>" class="to_cart">do kosza</a>
                    
                    
                </div>
            </div> 
        </div>
		<script>
		
			$(".close").click(function(e){
				e.preventDefault();
				var value = $(this).attr("value");

				$.ajax({url: "<?php echo URL.'home/getproduct';?>" , data: {key1: value } ,success: function(result){
			        $("#div1").html(result);
			    }});

				
			    
			});
			
		</script>