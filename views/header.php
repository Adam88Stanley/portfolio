<!doctype html>
<html>
    <head>
    	<?php 
        if(!empty($title)){
        	echo '<title>'.$title.'</title>';
        }
        ?>

        
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>views/public/css/normalize.css" />
        <script type="text/javascript" src="<?php echo URL; ?>views/public/js/jquery.js" ></script>
        <script type="text/javascript" src="<?php echo URL; ?>views/public/js/mine_slider.js" ></script>
        
      
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>views/public/css/grid.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>views/public/css/header.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>views/public/css/mine_slider.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>views/public/css/content.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>views/public/css/footer.css" />
        <?php 
        if(!empty($html)){
        	echo $html;
        }
        ?>
        
        
          <style type="text/css">
            
            
            
            
            
            @media only screen and (min-width: 520px) {
                
            }
            
            
            @media only screen and (min-width: 660px) {
                
                
            }
            
            
            @media only screen and (min-width: 800px) {
                
              
            }
            
        </style>
   

    </head>
    <body>
        <!-- HEADER START -->
        <div class="header">
            <div class="header_top width_16 row">
                <div class="header_logo vspace_4">
                   <a href="<?php echo URL.'home/';?>"><img src="<?php echo URL; ?>views/public/<?php echo (!empty(self::$header['logo'])) ? self::$header['logo'] : 'img/logo/logo.png'; ?>" alt="twoje logo" /></a> 
                </div>
                <div class="search_form vspace_4">
                    <form action="<?php echo URL.'/product/search/ntab'; ?>" method="get">
                        <input type="search" name="search" placeholder="szukaj" />
                        <button type="submit" class="btn_hover"><img src="<?php echo URL; ?>views/public/img/search_icon_2.png"/></button>
                    </form>
                </div>
            </div>
            <div class="header_bottom width_16 row">
                <div class="top_nav vspace_4">
                    <div class="cart_user">
                        <div class="mobile_menu">
                            <ul>
                                <li><img src="<?php echo URL; ?>views/public/img/menu.png" alt="Menu" class="menu_icon" /></li>
                              
                               <?php 
                               	   $cat = new \Models\Categories();
                               	   $cats = $cat->getCategories();
	                               foreach ($cats as $key => $product){ 
	                               	
										echo '<li><a href="'.URL.'product/productlist/ntab/'.$product->getCategoryId().'/all/1/0">'.$product->getCategoryName().'</a></li>';
	                   			   
	                               } 
                   				?>
                               
                            </ul>
                        </div>
                        <?php echo (self::$header['login']) ? '<span class="logged_as">Zalogowany jako : '.self::$header['login'].'&nbsp;</span><a class="log_out" href="'.URL.'/logout"> Wyloguj się</a>' :'' ;?>
                        <a href="<?php echo URL.'user';?>" title="Użytkownik"><img src="<?php echo URL; ?>views/public/img/user.png" alt="Użytkownik" class="user_icon" /></a>
                        <a href="<?php echo URL.'cart/show';?>" title="Koszyk"><img src="<?php echo URL; ?>views/public/img/cart.png" alt="Kosz" class="cart_icon"/></a>
                        <div id="num_of_items"><?php echo (self::$header['number_of_products']) ? self::$header['number_of_products'] : '0'; ?></div>
                    </div>
                    <ul>
                        <li><a href="<?php echo URL.'home';?>">Strona główna</a></li>
                        <?php 
                        	if(!empty(self::$header['main_bar_pages'])){
	                        	foreach (self::$header['main_bar_pages'] as $p) {
	                        		
	                        		echo '<li><a href="'.URL.'pages/page/'.$p->getId().'">'.$p->getPageName().'</a></li>'; 
	                        		
	                        	}
                        	}
                        ?>
                     
                    </ul>
                </div>
            </div>
        </div>
        <!-- HEADER STOP -->