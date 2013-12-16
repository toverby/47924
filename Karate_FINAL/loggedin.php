<?php
session_start();
require (config_inc.php);
// If no session value is present, redirect the user:
// Also validate the HTTP_USER_AGENT!
if (!isset($_SESSION['agent']) OR ($_SESSION['agent'] != md5($_SERVER['HTTP_USER_AGENT']) )) {

	// Need the functions:
	require ('login_ajax.php');
	redirect_user();	

}

// Set the page title and include the HTML header:
$page_title = 'Logged In!';
require_once ('manage.php');

// Print a customized message:
echo "<h1>Logged In!</h1>
<p>You are now logged in, {$_SESSION['firstname']}!</p>
<p><a href=\"logout.php\">Logout</a></p>";

?>
<?php include ('footer.html');  ?>