<?php
require_once('lib/AutoLoader.php');

define('URL', "http://".$_SERVER["HTTP_HOST"].rtrim($_SERVER['PHP_SELF'],"index.php"));

define('VIEW_PATH','views'.DIRECTORY_SEPARATOR);
define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DB', 'shop');
define('ADMIN_LOGIN', 'admin');
define('ADMIN_PASSWORD', 'admin');

// EMAIL 

define('EMAIL_USERNAME', 'Ustawić!');
define('EMAIL_PASSWORD', 'Ustawić!');


