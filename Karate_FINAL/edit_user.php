<?php 
include ('manage.php');
$page_title = 'Edit a User';

echo '<h1>Edit a User</h1>';

// Check for a valid user id, through GET or POST:
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From view_to2446992_Karate_Student_App.php
	$id = $_GET['id'];
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
	$id = $_POST['id'];
} else { // No valid id, kill the script.
	echo '<p class="error">This page has been accessed in error.</p>';
	include ('footer.html'); 
	exit();
}

require ('connector.php'); 

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$errors = array();
	
	// Check for a first name:
	if (empty($_POST['FirstName'])) {
		$errors[] = 'You forgot to enter your first name.';
	} else {
		$fn = mysqli_real_escape_string($database, trim($_POST['FirstName']));
	}
	
	// Check for a last name:
	if (empty($_POST['lastname'])) {
		$errors[] = 'You forgot to enter your last name.';
	} else {
		$ln = mysqli_real_escape_string($database, trim($_POST['lastname']));
	}

	// Check for an EmailAddress address:
	if (empty($_POST['EmailAddress'])) {
		$errors[] = 'You forgot to enter your EmailAddress address.';
	} else {
		$e = mysqli_real_escape_string($database, trim($_POST['EmailAddress']));
	}
	
	if (empty($errors)) { // If everything's OK.
	
		//  Test for unique EmailAddress address:
		$q = "SELECT id FROM to2446992_Karate_Student_App WHERE email='$e' AND id != $id";
		$r = @mysqli_query($database, $q);
		if (mysqli_num_rows($r) == 0) {

			// Make the query:
			$q = "UPDATE to2446992_Karate_Student_App SET FirstName='$fn', LastName='$ln', EmailAddressl='$e' WHERE id=$id LIMIT 1";
			$r = @mysqli_query ($database, $q);
			if (mysqli_affected_rows($database) == 1) { // If it ran OK.

				// Print a message:
				echo '<p>The user has been edited.</p>';	
				
			} else { // If it did not run OK.
				echo '<p class="error">The user could not be edited due to a system error. We apologize for any inconvenience.</p>'; // Public message.
				echo '<p>' . mysqli_error($database) . '<br />Query: ' . $q . '</p>'; // Debugging message.
			}
				
		} else { // Already registered.
			echo '<p class="error">The EmailAddress address has already been registered.</p>';
		}
		
	} else { // Report the errors.

		echo '<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p>';
	
	} // End of if (empty($errors)) IF.

} // End of submit conditional.

// Always show the form...

// Retrieve the user's information:
$q = "SELECT FirstName, LastName, EmailAddress FROM to2446992_Karate_Student_App WHERE id=$id";		
$r = @mysqli_query ($database, $q);

if (mysqli_num_rows($r) == 1) { // Valid user id, show the form.

	// Get the user's information:
	$row = mysqli_fetch_array ($r, MYSQLI_NUM);
	
	// Create the form:
	echo '<form action="edit_user.php" method="post">
<p>First Name: <input type="text" name="FirstName" size="15" maxlength="15" value="' . $row[0] . '" /></p>
<p>Last Name: <input type="text" name="LastName" size="15" maxlength="30" value="' . $row[1] . '" /></p>
<p>EmailAddress Address: <input type="text" name="EmailAddress" size="20" maxlength="60" value="' . $row[2] . '"  /> </p>
<p><input type="submit" name="submit" value="Submit" /></p>
<input type="hidden" name="id" value="' . $id . '" />
</form>';

} else { // Not a valid user id.
	echo '<p class="error">This page has been accessed in error.</p>';
}

mysqli_close($database);
		
include ('footer.html');
?>