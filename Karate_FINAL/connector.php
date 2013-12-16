<?php #connector.php
	DEFINE ('USER','47924');
	DEFINE ('PASS', '47924cis12');
	DEFINE ('HOST','209.129.8.3');
	DEFINE ('SITE_NAME','47924');
	
	$database = new  MySQLi (HOST,USER,PASS,SITE_NAME) ;
	
	if ($database->connect_error) {
		echo $database->connect_error;
		unset($database);
	} else { // Establish the encoding.
		$database->set_charset('utf8');
	}

?>