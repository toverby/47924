<?php #connector.php
	DEFINE ('USER','47924');
	DEFINE ('PASS', '47924cis12');
	DEFINE ('HOST','209.129.8.3');
	DEFINE ('SITE_NAME','47924');
	
	$database=@mysqli_connect(HOST,USER,PASS,SITE_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error());

	mysqli_set_charset($database, 'utf8');
?>