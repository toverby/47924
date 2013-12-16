<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

require ('config_inc.php');

require (CONNECTOR);

require (LOGIN_FUNCTIONS);

	
	// Check the login:
	list ($check, $data) = check_login($database, $_POST['email'], $_POST['pass']);
	
	if ($check) { // OK!
		
		// Set the session data:
		//session_start();		
		$_SESSION['firstname'] = $data['firstname'];
		$_SESSION['lastname'] = $data['lastname'];

		$_SESSION['agent'] = md5($_SERVER['HTTP_USER_AGENT']);
		
		// Redirect:
		redirect_user('loggedin.php');
			
				} else { // Unsuccessful!

			// Assign $data to $errors for login_page.inc.php:
		echo("Error description: " . mysqli_error($database));
		
		$errors = $data;

	}
		
	mysqli_close($database); // Close the database connection.

require ('login_page.inc.php');
?>