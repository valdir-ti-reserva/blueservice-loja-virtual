<?php
require 'environment.php';

$config = array();
if(ENVIRONMENT == 'development') {
	define("BASE_URL", "http://localhost:8001/painel/");
	define("BASE_URL_SITE", "http://localhost:8001/loja/");
  $host 				      = $_SERVER['REMOTE_ADDR'];
	$config['dbname'] 	= 'loja';
	$config['host'] 	  = $host;
	$config['dbuser'] 	= 'root';
	$config['dbpass'] 	= 'root';
} else {
  define("BASE_URL", "http://localhost/painel/");
	define("BASE_URL_SITE", "http://localhost:8001/loja/");
	$config['dbname'] = 'loja';
	$config['host']   = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = 'root';
}

global $db;
try {
	$db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);
} catch(PDOException $e) {
	echo "ERRO: ".$e->getMessage();
	exit;
}

//Delimitando tempo de sessão
$timeout = 12000; // Tempo da sessao em segundos
// Verifica se existe o parametro timeout
if(isset($_SESSION['timeout'])) {
    // Calcula o tempo que ja se passou desde a cricao da sessao
    $duracao = time() - (int) $_SESSION['timeout'];

  	// Verifica se ja expirou o tempo da sessao
    if($duracao > $timeout) {
        // Destroi a sessao e cria uma nova
        session_destroy();
        session_start();
    }
}
// Atualiza o timeout.
$_SESSION['timeout'] = time();
