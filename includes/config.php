<?php 


ob_start();
session_start();

try {

	define('DBHOST','localhost');
	define('DBUSER','root');
	define('DBPASS','');
	define('DBNAME','ecommerce');
	define('DBPORT','3306');
	$db = new PDO("mysql:host=".DBHOST.";port=".DBPORT.";dbname=".DBNAME, DBUSER, DBPASS);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch (Exception $e) {
	die("Unable To Connect To Database");
}
//database credentials

function __autoload($classname){
	$classname = strtolower($classname);
	
	$filename = 'classes/class.'.$classname.'.php';
	if ( file_exists($filename)) {
      require_once $filename;
    }
    $filename = '../classes/class.'.$class . '.php';
   if ( file_exists($filename)) {
      require_once $filename;
    }

}

$user = new User($db);

?>
