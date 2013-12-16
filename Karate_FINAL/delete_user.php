<?php 
$page_title = 'Remove Student';
include_once ('./manage.php');
echo '<h1>Remove Student</h1>';

// Check for a valid user ID, through GET or POST:
if ( (isset($_GET['ID'])) && (is_numeric($_GET['iID'])) ) { // From view_users.php
	$id = $_GET['ID'];
} elseif ( (isset($_POST['ID'])) && (is_numeric($_POST['ID'])) ) { // Form submission.
	$ID = $_POST['ID'];
} else { // No valid ID, kill the script.
	echo '<p class="error">This page has been accessed in error.</p>';
	include ('./footer.html'); 
	exit();
}

require ('./connector.php');

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if ($_POST['sure'] == 'Yes') { // Delete the record.

		// Make the query:
		$q = "DELETE FROM  to2446992_Karate_Student_App WHERE ID=$ID LIMIT 1";		
		$r = @mysqli_query ($database, $q);
		if (mysqli_affected_rows($database, $q) == 1) { // If it ran OK.

			// Print a message:
			echo '<p>The user has been deleted.</p>';	

		} else { // If the query did not run OK.
			echo '<p class="error">The user could not be deleted due to a system error.</p>'; // Public message.
			echo '<p>' . mysqli_error($database) . '<br />Query: ' . $q . '</p>'; // Debugging message.
		}
	
	} else { // No confirmation of deletion.
		echo '<p>The user has NOT been deleted.</p>';	
	}

} else { // Show the form.

	// Retrieve the user's information:
	$q = "SELECT CONCAT(LastName, ', ', FirstName) FROM users WHERE ID=$ID";
	$r = @mysqli_query ($database, $q);

	if (mysqli_num_rows($r) == 1) { // Valid user ID, show the form.

		// Get the user's information:
		$row = mysqli_fetch_array ($r, MYSQLI_NUM);
		
		// Display the record being deleted:
		echo "<h3>Name: $row[0]</h3>
		Are you sure you want to delete this user?";
		
		// Create the form:
		echo '<form action="delete_user.php" method="post">
	<input type="radio" name="sure" value="Yes" /> Yes 
	<input type="radio" name="sure" value="No" checked="checked" /> No
	<input type="submit" name="submit" value="Submit" />
	<input type="hidden" name="id" value="' . $ID . '" />
	</form>';
	
	} else { // Not a valid user ID.
		echo '<p class="error">This page has been accessed in error.</p>';
	}

} // End of the main submission conditional.

mysqli_close($database);
		
include ('./footer.html');
?>