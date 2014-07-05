<?php 

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	require ('connector.php');
	require ('login_functions.inc.php');
	
		
	// Check the login:
	list ($check, $data) = check_login($database, $_POST['email'], $_POST['pass']);
	
	if ($check) { // OK!
		
		// Set the session data:
		session_start();		
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

} // End of the main submit conditional.

// Create the page:
include ('login_page.inc.php');
?>