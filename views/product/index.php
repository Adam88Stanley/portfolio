<?php use Lib\View; ?>
<? View::header('<link rel="stylesheet" type="text/css" href="'.URL.'views/product/content.css" />','Produkt'); ?>

        <!-- CONTENT START -->
        <div class="body vspace_4 row">
            <div class="product width_16 row">
                <div class="content_left width_7">
                    
                     <?php   if(!empty($this->args['images'])){?>
                     	<div class="product_image_list">
                     	<?php 
                            
                            
                            	foreach ($this->args['images'] as $i){
                            		echo '<div>';
                            		echo '<img src="'.URL.'views/public/'.$i['product_image'].'" alt="" />';	
                           
                            		echo '</div>';
                            	}
                            
                            
                            
                            ?>
                     
                      </div>
                     <?php }?>
                    
                      
                   
                    <div class="product_image">
                   		<img src="<?php echo URL.'views/public/'.$this->args['image'];?>" alt="" />
                    </div>
                </div>
                <div class="content_mid width_5">
                    <div class="product_des">
                        <h2><?php echo $this->args['name'];?></h2>
                        
                      <?php  
                      if(!empty($this->args['avg_rating'])){
                      
	                      for($i = 0; $i < $this->args['avg_rating']; $i++){
			                        		
	
	                      		echo '<img src="'.URL.'views/public/img/rate.png" alt="star" class="avg_rate" />';
	
	                      }
                      }      
                      ?>    	
                    </div>
                </div>

                <div class="content_right width_4">
                    <div class="price_box">
                        <h3><?php echo $this->args['price'];?>zł</h3>
                        <p><?php echo (!empty($this->args['discount']) ? $this->args['discount'].'%' : '');?><span> <?php echo (!empty($this->args['old_price']) ? $this->args['old_price'].'zł' : '');?></span></p>
                        <form method="get" action="<?php echo URL.'cart/addtocart' ?>">
                           
                            <input type="hidden" name="product_id" value="<?php echo $this->args['product_nr'];?>" />
                            <label><input type="number" name="product_quantity" min="0" max="<?php echo $this->args['available'] ;?>" value="1" /> z <?php echo $this->args['available'] ;?></label>
                            <input type="hidden" name="product_price" value="<?php echo $this->args['price'];?>" />
                            <input type="hidden" name="product_name" value="<?php echo $this->args['name'];?>" />
                            
                            <input type="submit" class="add_to_cart" value="dodaj do kosza"/>
                        </form>
                    </div>
                </div>
                 <div class="content_bottom">
                    <div>
                    <?php   if(!empty($this->args['additionals'])){?>
                        <table>
                            <tr>
                                <th colspan="2">Dane o produkcie:</th>
                            </tr>
                            
                            <?php 
                            
                            
                            	foreach ($this->args['additionals'] as $a){
                            		echo '<tr>';
                            		echo '<th>'.$a['name'].'</th>';	
                            		echo '<td>'.$a['value'].'</td>';
                            		echo '</tr>';
                            	}
                            
                            
                            
                            ?>
                            
                          
                        </table>
                        <?php }?>
                        <h3>Opis produktu:</h3>
                        <p><?php echo $this->args['description'];?></p>
                        <h3>Komentarze:</h3>
                   		<div class="comments">
                   			<?php if($this->args['is_loged']) {?>
                   				
                   				<form id="ratingsForm" method="post" action="<?php echo URL.'product/nr/'.$this->args['product_nr']; ?>"  >
                   					<p>Twoja ocena:</p>
                   				
                   					   <div class="stars">
									        <input type="radio" name="star" value ="1" class="star-1" id="star-1" />
									        <label class="star-1" for="star-1" >1</label>
									        <input type="radio" name="star" value ="2" class="star-2" id="star-2" />
									        <label class="star-2" for="star-2">2</label>
									        <input type="radio" name="star" value ="3" class="star-3" id="star-3" />
									        <label class="star-3" for="star-3">3</label>
									        <input type="radio" name="star" value ="4" class="star-4" id="star-4" />
									        <label class="star-4" for="star-4">4</label>
									        <input type="radio" name="star" value ="5" class="star-5" id="star-5" />
									        <label class="star-5" for="star-5">5</label>
									        <span></span>
    									</div>
                   					
                   					
                 					<p>Twój komentarz:</p>
                   					<textarea class="comment_field" required  name="comment"></textarea>
         
                   					<input type="submit" class="btn" name="send" value="wyślij" />
                   				
                   				</form>
                   				
                   				
                   			<?php }?>
                   			
	                        <?php 
	                        if(!empty($this->args['comments'])){
	                        
		                        foreach ($this->args['comments'] as  $comment) {
		                        	
		                        	echo '<div class="comment">';
		                        	echo '<span class="login">'.$comment['login'].'</span>';
		                        	
		                        	echo '<span class="rate">';
		                        	for($i = 0; $i < $comment['rate']; $i++){
		                        		
		                        		echo '<img src="'.URL.'views/public/img/rate.png" alt="star" class="star" />';
		                        		
		                        	}
		                        	echo '</span>';
		                        	
		                        	echo '<span class="date">'.$comment['date'].'</span>';
		                        	
		                        	echo '<p>';
		                        	echo $comment['comment'];
		                        	echo '</p>';
		                        	echo '</div>';
		                        	
		                        }
		                        
		                        
	                        }?>
	                        
	                        
	                        <div class="pagination">
	                        	
	                        	<?php
	                        	if($this->args['num_pages'] > 1){
	                        		
	                        	 echo '<a href="'.URL.'product/nr/'.$this->args['product_nr'].'/'.$this->args['prev'].'" class="arrow">&lt;</a>';
	                        	 
	                        	 if(!empty($this->args['num_pages'] )){
	                        	 	$selected = $this->args['selected'];
	                        	 	
		                        	 for($i=0; $i<$this->args['num_pages']; $i++) {
		                        	             	 	
		  
		                        	 	echo '<a href="'.URL.'product/nr/'.$this->args['product_nr'].'/'.$i.'" '.(($selected == ($i+1)) ? 'class="selected"' : '').'>'.($i+1).'</a>';
		                        	 	
		                        	 } 
	                        	 }
	                        	 
	                        	 echo '<a href="'.URL.'product/nr/'.$this->args['product_nr'].'/'.$this->args['next'].'" class="arrow">&gt;</a>';
	                        
	                        	}
	                        	
	                        	?>
	                        </div>
                        </div>
                     </div>
                </div>
            </div>
           
        
        </div>
        <!-- CONTENT STOP -->
<?php View::footer(); ?>