<?php
/*
**    DYNAMO
**    Rambod Rahmani <rambodrahmani@yahoo.it>
*/
	$debugMode = true;

	$ips['domain_test.com']['A'] = '127.0.0.1';

	define('BASE_URL', '192.168.0.128');
	
	define('DB_SERVER', "localhost");
	define('DB_USER', "root");
	define('DB_PASSWORD', "root");
	define('DB_DATABASE', "dynamo");

	$conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
	
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$conn->set_charset("utf8");
?>
