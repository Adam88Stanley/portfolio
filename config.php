<?php
require_once('lib/AutoLoader.php');
$path = dirname($_SERVER['PHP_SELF'])."/";

define('URL', "http://".$_SERVER['SERVER_NAME'].$path);

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


