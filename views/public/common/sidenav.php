    <!-- SIDE NAVIGATION -->
            <div class="side_nav width_4">
                <ul>
                    <li>Menu</li>
                    <?php foreach ($this->args['categories'] as $key => $product){ 

                    	echo '<li><a href="'.URL.'product/productlist/ntab/'.$product->getCategoryId().'/all/1/0">'.$product->getCategoryName().'</a></li>';
                    }
                    ?>
                </ul>
                	<?php 
                	$true = $this->args['d_product']->getName();
                	if(!empty($true)){?>
                    <div class="left_side_product">
                        <h5>Produkt dnia</h5>
                        <ul >
                        
                            <li><a href="<?php echo URL.'product/nr/'.$this->args['d_product']->getId();?>" ><img src="<?php echo URL.'views/public/'.$this->args['d_product']->getImage(); ?>" alt="" /></a></li>
                            <li><a href="<?php echo URL.'product/nr/'.$this->args['d_product']->getId();?>"><?php echo $this->args['d_product']->getName(); ?></a></li>
                            <li><span class="price"><?php echo $this->args['d_product']->getPrice();?> zł</span></li>
                            <li><a href="<?php echo URL.'cart/addtocart?product_id='.$this->args['d_product']->getId().'&product_quantity=1&product_price='.$this->args['d_product']->getPrice().'&product_name='.$this->args['d_product']->getName(); ?>" class="to_cart">do kosza</a></li>
                        </ul>
                    </div>
                    <?php }?>
            </div>
            <!-- SIDE NAVIGATION STOP -->
          