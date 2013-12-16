<?php
// Check if the form has been submitted:
//if ($_SERVER['REQUEST_METHOD'] == 'POST') {

// Include the header:
$page_title = 'Login';

include_once('manage.php');

// Print any error messages, if they exist:
if (isset($errors) && !empty($errors)) {
	echo '<h1>Error!</h1>
	<p class="error">The following error(s) occurred:<br />';
	foreach ($errors as $msg) {
		echo " - $msg<br />\n";
	}
	echo '</p><p>Please try again.</p>';
}
?>
<h2>Login</h2>

<p id="results"></p>

	<form action="login.php" method="post"  id="login">

	<p id="emailP">Email Address: <input type="text" name="email" id="email"/> <span class="errorMessage" id="emailError">Please enter your email address!</span></p>
	<p id="passwordP">Password: <input type="password" name="pass" /><span class="errorMessage" id="passwordError">Please enter your password!</span></p></p>

	<p><input class="login_button" type="submit" name="submit"  value="Login!" /></p>

</form>
