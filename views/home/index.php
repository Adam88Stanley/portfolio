<?php use Lib\View; ?>
<? 
View::header('<link rel="stylesheet" type="text/css" href="'.URL.'views/home/content.css" />','Strona główna'); 

?>
 <div class="body vspace_4 row">
<?php require_once(View::commonPath('sidenav.php')); ?>

<div class="content width_11">
                <!-- MINE SLIDER START -->
                <div class="slider" id="main_slider">
                    <span class="left_arrow"></span>
					<?php if(!empty($this->args['slider'])){?>
					
						<?php foreach($this->args['slider'] as $product) { ?>
						<div>
							<a href="<?php echo URL.'product/nr/'.$product->getId();?>">
								<img src="<?php echo URL.'views/public/'.$product->getImage();?>" alt="buty" />
							</a>
							<div class="slider_description">
								<h3><?php echo $product->getName();?></h3>
								<span class="price"><?php echo $product->getPrice();?> zł</span>
								<a href="<?php echo URL.'cart/addtocart?product_id='.$product->getId().'&product_quantity=1&product_price='.$product->getPrice().'&product_name='.$product->getName(); ?>" class="add_to_cart">do kosza</a>
							</div>
						</div>
						<?php }?>
						
					<?php } ?>
                    <span class="right_arrow" ></span>
                </div>
                <!-- MINE SLIDER STOP -->
                <div class="products vspace_4">
                    <div class="display_options">
                    <a href="<?php echo URL.'home/'.$this->args['action'].'/'.$this->args['tab'].'/'.$this->args['prev'];?>"><img src="<?php echo URL;?>views/public/img/arrow_left.png" alt="" /></a>
                    <a href="<?php echo URL.'home/'.$this->args['action'].'/'.$this->args['tab'].'/'.$this->args['next'];?>"><img src="<?php echo URL;?>views/public/img/arrow_right.png" alt="" /></a>
                    <a href="<?php echo URL.'home/'.$this->args['action'].'/ntab/'.$this->args['selected'] ;?>" class="mode"><img src="<?php echo URL;?>views/public/img/op_1.png" alt="" /></a>
                    <a href="<?php echo URL.'home/'.$this->args['action'].'/tab/'.$this->args['selected'];?>" class="mode"><img src="<?php echo URL;?>views/public/img/op_2.png" alt="" /></a>
                    </div>
                    <ul class="product_cats">
                        <li><a href="<?php echo URL.'home/def'?>" <?php if($this->args['def']) echo 'class="selected"';?>>Nowości</a></li>
                        <li><a href="<?php echo URL.'home/popular'?>" <?php if($this->args['popular']) echo 'class="selected"';?>>Popularne</a></li>
                        <li><a href="<?php echo URL.'home/promo'?>" <?php if($this->args['promo']) echo 'class="selected"';?>>Promocje</a></li>
                    </ul>
                    
                    <?php if($this->args['tab'] == 'tab') {?>
                    
	                    <table>
	                    	<?php foreach($this->args['products'] as $product) {?>
	                    	
	                    		<tr>
	                    			<td style="width:30%"><img src="<?php echo URL.'views/public/'.$product->getImage();?>" alt="" /></td>
	                    			<td style="width:30%"><a href="<?php echo URL.'product/nr/'.$product->getId();?>"><?php echo $product->getName();?></a></td>
	                    			<td style="width:20%"><?php echo $product->getPrice();?> zł</td>
	                    			<td style="width:20%"><a href="<?php echo URL.'cart/addtocart?product_id='.$product->getId().'&product_quantity=1&product_price='.$product->getPrice().'&product_name='.$product->getName(); ?>" class="to_cart">do kosza</a></td>
	                    		</tr>
	                    
	                    
	                    	<?php }?>
	                    </table>
                    
                    <?php }else if($this->args['tab'] == 'ntab') {?>
                    
	                    <ul class="product_blocks" >
	                	<?php if($this->args['products']) {?>
		                       <?php foreach($this->args['products'] as $product) {?>
			                        <li>
			                        
			                        
			                          <a href="<?php echo URL.'product/nr/'.$product->getId();?>" >
			                                <span>
			                                    <span class="quick_view" value='<?php echo $product->getId(); ?>' >Szybki podgląd</span>
			                                    <img src="<?php echo URL.'views/public/'.$product->getImage();?>" alt="" />
			                                </span>
			                                <h5><?php echo $product->getName();?></h5>
			                            </a>
			                           <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ornare vel lacus maximus accumsan. Nunc nisl velit, tincidunt a eros id, malesuada accumsan ligula. </p> -->
			                            <span class="price"><?php echo $product->getPrice();?> zł</span>
			                            <a href="<?php echo URL.'cart/addtocart?product_id='.$product->getId().'&product_quantity=1&product_price='.$product->getPrice().'&product_name='.$product->getName(); ?>" class="to_cart">do kosza</a>
			                       
			                        </li>
		                       <?php }?>
	                       <?php }?>
	                      </ul>
                      
                  <?php }?> 
                </div>
            </div>

</div>
<div id="div1"></div>

<!-- QUICK VIEW BOX START -->
        
 <!-- QUICK VIEW BOX STOP -->

        <script>
			$(".quick_view").click(function(e){
				e.preventDefault();
				var value = $(this).attr("value");

				$.ajax({url: "<?php echo URL.'home/getproduct';?>" , data: {key1: value } ,success: function(result){
			        $("#div1").html(result);
			    }});

				
			    
			});
		</script>

<?php View::footer(); ?>
