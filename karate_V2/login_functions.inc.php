<?php 

function redirect_user ($page = 'index.php') {

	$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
	// Remove any trailing slashes:
	$url = rtrim($url, '/\\');
	// Add the page:
	$url .= '/' . $page;
	// Redirect the user:
	header("Location: $url");
	exit(); // Quit the script.

} // End of redirect_user() function.

function check_login($database, $email = '', $pass = '') {
	//$email = $this->SanitizeForSQL($email);
	$errors = array(); // Initialize error array.

	// Validate the email address:
	if (empty($email)) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
			$e = mysqli_real_escape_string($database, trim($email));
	}

	// Validate the password:
	if (empty($pass)) {
			$errors[] = 'You forgot to enter your password.';
			} else {
					$p = mysqli_real_escape_string($database, trim($pass));
				}

	if (empty($errors)) { // If everything's OK.

				// Retrieve the user_id and first_name for that email/password combination:
						//$pass = sha1($pass);
			$q = "SELECT lastname, firstname FROM to2446992_kv2_admin WHERE email='$e' AND pass='$pass'";		
			$r = @mysqli_query ($database, $q); // Run the query.

	/*if (!mysqli_query($database,$q)){

		die('Error: SQL SELECT command   ' . mysqli_error($database));
							 }
						echo "Profile not found";
	
	*/	
		// Check the result:
	if (mysqli_num_rows($r) == 1) {

			// Fetch the record:
			$row = mysqli_fetch_array ($r, MYSQLI_ASSOC);
	
			// Return true and the record:
			return array(true, $row);
			
		} else { // Not a match!

			echo("Error description: " . mysqli_error($database));
			$errors[] = 'The email address and password entered do not match those on file.';
		}
		
	} // End of empty($errors) IF.
	
	// Return false and the errors:
	return array(false, $errors);

} // End of check_login() function.
?>