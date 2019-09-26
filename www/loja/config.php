<?php
require 'environment.php';

global $config;
global $db;

$config = array();
if(ENVIRONMENT == 'development') {
	define("BASE_URL", "http://localhost:8001/loja/");
	$host 				      = $_SERVER['REMOTE_ADDR'];
	$config['dbname'] 	= 'loja';
	$config['host'] 	  = $host;
	$config['dbuser'] 	= 'root';
	$config['dbpass'] 	= 'root';
} else {
	define("BASE_URL", "http://localhost/nova_loja/");
	$config['dbname'] 	= 'nova_loja';
	$config['host'] 	  = 'localhost';
	$config['dbuser'] 	= 'root';
	$config['dbpass'] 	= 'root';
}

$config['default_lang'] = 'en';

$db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>
