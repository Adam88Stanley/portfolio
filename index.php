<?php
use Lib\Router;
use Controllers\Controller;
use Lib\ControllerFactory;
use Lib\DbaseFactory;
use Models\User;
use Lib\Session;
use Lib\Register;
use Lib\Authentication;
use Lib\Routes;
use controllers\Product;
use Lib\View;
use Lib\LoginVal;
use Models\Categories;
use Lib\Location;
use Models\Logo;
use Models\CartCleaner;
require_once('config.php');
$autoloader = new AutoLoader();
Session::start();
$db_factory = new DbaseFactory('mysql', HOST, USER, PASSWORD, DB);
$db = $db_factory->make();
Register::set('db', $db->connect());


$router = new Router();
$controllerF = new ControllerFactory();

if($router->getControllerName() === "admin") {
	
	$isAdmin = \Lib\Admin::isAdmin();
	
	if(!$isAdmin) {
		
		Location::To(URL.'home');
		
	}
	
}
$authentication = new Authentication(array('user','cart/confirm','cart/finalize'));

$cartCleaner = new CartCleaner();

$routes = new Routes(array(
		'',
		'admin',
		'admin/test',
		'admin/test2',
		'admin/add_delete_cat',
		'admin/add_delete_subcat',
		'admin/category',
		'admin/page',
		'admin/editCategoryPageName',
		'admin/addNewPage',
		'admin/editPage',
		'admin/deletePage',
		'admin/message',
		'admin/messages',
		'admin/sendMessage',
		'admin/deleteMessage',
		'admin/orders',
		'admin/order',
		'admin/orderDetails',
		'admin/products',
		'admin/dayProduct',
		'admin/addProduct',
		'admin/checkingNewMessages',
		'admin/checkingNewOrders',
		'admin/editProduct',
		'admin/main',
		'admin/shipping',
		'admin/addShippingMethod',
		'admin/deleteShippingMethod',
		'admin/deleteFromSlider',
		'admin/addToSlider',
		'admin/deleteProduct',
		'product/nr/arg',
		'product/productlist',
		'product/productlist/arg',
		'product/search/arg',
		'user',
		'user/profile',
		'user/edition',
		'user/last',
		'user/last/arg',
		'user/delete',
		'user/message',
		'user/message/arg',
		'user/details/arg',
		'registration',
		'login',
		'logout',
		'home',
		'home/def',
		'home/def/arg',
		'home/promo',
		'home/promo/arg',
		'home/popular',
		'home/popular/arg',
		'home/getproduct',
		'cart/addtocart',
		'cart/show',
		'cart/finalize',
		'cart/removeFromCart',
		'cart/mod',
		'cart/purchuase',
		'cart/confirm',
		'pages/page/arg',
		'passrecovery/recover',
		'passrecovery/complete',
		'success/success/arg',
		'activation/activate'
		
		
));

if(LoginVal::isLogged()) {
	
	View::setHeader('login', Session::get('login'));

}

$main_bar_cats = new \models\CategoryPage(1);
$logo = new Logo();
View::setHeader('logo', $logo->getLogo());
View::setHeader('main_bar_pages', $main_bar_cats->getPages());
View::setHeader('number_of_products', \controllers\Cart::getNumberOfProducts());

$cat = new Categories();

$footer_left_cat = new \models\CategoryPage(2);
$footer_right_cat = new \models\CategoryPage(3);

View::setFooter('left_cat_name', $footer_left_cat->getCategoryPageName());
View::setFooter('left_pages', $footer_left_cat->getPages());

View::setFooter('right_cat_name', $footer_right_cat->getCategoryPageName());
View::setFooter('right_pages', $footer_right_cat->getPages());

View::setFooter('menu', $cat->getCategories());

$action = $router->getAction();
$args = $router->getArgs();
$arg = empty($args) ? '' : 'arg';
$path = trim($router->getControllerName().'/'.$action.'/'.$arg,'/');

if($authentication->canShow($router->getControllerName()) && $routes->isValidRoute($path)) {
	
	$controller = $controllerF->getController($router->getControllerName(),$router->getAction(),$router->getArgs());
	
	
} else {
	
	if(!$authentication->canShow($router->getControllerName())){
		
		Location::To(URL.'login');
		
	}
	$controllerF->getController('error');
	
}



?>