<?php ob_start(); ?>
<?php 

 header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
 header('Pragma: no-cache'); // HTTP 1.0.
  header('Expires: 0'); // Proxies.
require ('config_inc.php');
require ('login_page.php');
require (CONNECTOR);
?>
<?php 	
function redirect_user ($page = 'login.php')
 	 
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

function check_login($database, $email = '', $password = '') 
	{
			//$email = $this->SanitizeForSQL($email);
	$errors = array(); // Initialize error array.

			// Validate the email address:
	if (empty($email)) {
		$errors[] = 'You forgot to enter your email address.';
			} else {
				$e = $mysqli->mysqli_real_escape_string($database, trim($email));
			}

			// Validate the password:
	if (empty($password)) {
			$errors[] = 'You forgot to enter your password.';
					} else {
			$p = $mysqli->mysqli_real_escape_string($database, trim($password));
						}

		if (empty($errors)) { // If everything's OK.

			// Retrieve the user_id and first_name for that email/password combination:
			$p= sha1($p);
			$q = "SELECT lastname, firstname FROM to2446992_karate_admin WHERE email='$e' AND pass='$p'";		
			//$r = @mysqli_query ($database, $q);
				$mysqli->query($q);

			if (!$mysqli_query($q)){

				die('Error: SQL SELECT command   ' . mysqli_error($database));
									 
								echo "Profile not found";
								echo "$p";
							}
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

<?php
if (isset($_GET['email'], $_GET['password'])) 
{

	// Need a valid email address:
	if (filter_var($_GET['email'], FILTER_VALIDATE_EMAIL)) 
	{
		
		// Must match specific values:
		if ( ($_GET['email'] == 'email@example.com') && ($_GET['password'] == 'testpass') ) 
		{
	
			// Set a cookie, if you want, or start a session.
			session_start();
			if ($_SERVER['REQUEST_METHOD'] == 'POST')
 {

				list ($check, $data) = check_login($database, $_POST['email'], $_POST['password']);
	
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
}
			// Indicate success:
			//echo 'CORRECT';
			
			} else { // Mismatch!
			echo 'INCORRECT';
			}
		
			}else { // Invalid email address!
			echo 'INVALID_EMAIL';
			}	

		} else { // Missing one of the two variables!
	echo 'INCOMPLETE';
	}
?>
	
<?php ob_flush(); ?>