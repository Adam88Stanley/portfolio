     <!-- FOOTER START -->
        <div class="footer width_16 row vspace_4">
            <div class="width_4">
                <h4><?php echo self::$footer['left_cat_name']; ?></h4>
                <ul>
                	 <?php 
                        	if(!empty(self::$footer['left_pages'])){
	                        	foreach (self::$footer['left_pages'] as $p) {
	                        		
	                        		echo '<li><a href="'.URL.'pages/page/'.$p->getId().'">'.$p->getPageName().'</a></li>'; 
	                        		
	                        	}
                        	}
                        ?>
                </ul>
            </div>
            <div class="width_4">
                <h4>Informacje o koncie</h4>
                <ul>
                    <li><a href="<?php echo URL.'user/last'; ?>">Moje zamówienia</a></li>
                    <li><a href="<?php echo URL.'user/edition'; ?>">Ustawienia Konta</a></li>
             
                </ul>
            </div>
            <div class="width_4">
            	<?php if(!empty(self::$footer['menu'])) {?>
                <h4>Kategorie</h4>
                <ul>
                    <?php foreach (self::$footer['menu'] as $key => $product){ 

                    	echo '<li><a href="'.URL.'product/productlist/'.$product->getCategoryId().'/all/1/0">'.$product->getCategoryName().'</a></li>';
                    
                    }
                    ?>
                </ul>
            	<?php }?>
            </div>
            <div class="width_4">
                <h4><?php echo self::$footer['right_cat_name']; ?></h4>
                <ul>
                	 <?php 
                        	if(!empty(self::$footer['right_pages'])){
	                        	foreach (self::$footer['right_pages'] as $p) {
	                        		
	                        		echo '<li><a href="'.URL.'pages/page/'.$p->getId().'">'.$p->getPageName().'</a></li>'; 
	                        		
	                        	}
                        	}
                        ?>
                </ul>
            </div>
        </div>
            
        <!--FOOTER STOP -->
        
        <script>
            
            $(document).ready(function(){
                $(".mobile_menu ul > li:first-child").click(function() {
                    $(this).parent().children("li:not(:first-child)").toggle();
                });
                $(".mobile_menu ul li:not(li:first-child)").toggle();
                
            });
            
            
            $(document).ready(function(){
                
                var width = $(window).outerWidth();
                $(window).resize(function() {
                    width = $(this).outerWidth();
                    check();
                });
                $(".footer div h4").click( function() {
                    if(width < 790){
                       $(this).next().toggle();
                    }
                });
                check();
                function check(){
                    if(width > 780){
                        $(".footer div ul").css("display", "block");
                    }else {
                        $(".footer div ul").css("display", "none");
                    }
                }
                
            });
        </script>
        
        
        
        
        </body>
</html>