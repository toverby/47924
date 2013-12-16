<?php ob_start(); ?>
<?session_start(); ?>
<?php 
 header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
 header('Pragma: no-cache'); // HTTP 1.0.
  header('Expires: 0'); // Proxies.
require ('config_inc.php');
include ('login_page.php');
require(CONNECTOR);
  ?>
 <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
 {

 	function redirect_user ($page = 'index.php')
 	 {

	$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
	// Remove any trailing slashes:
	$url = rtrim($url, '/\\');
	// Add the page:
	$url .= '/' . $page;
	// Redirect the user:
	header("Location: $url");
	exit(); // Quit the script.

	} // End of redirect_user() function.

	function check_login($database, $email = '', $pass = '') 
	{
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
					$p= sha1($p);
					$q = "SELECT lastname, firstname FROM to2446992_karate_admin WHERE email='$e' AND pass='$p'";		
					$r = @mysqli_query ($database, $q);

			if (!mysqli_query($database,$q)){

				die('Error: SQL SELECT command   ' . mysqli_error($database));
									 }
								echo "Profile not found";
								echo "$p";
				
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
	}
?>