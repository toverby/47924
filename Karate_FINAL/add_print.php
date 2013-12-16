<?php
	include(dirname(__FILE__) . "/includes/manage.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Upload Photo</title>
</head>
<body>
	<div id="wrapper">
<?php 

require ('./connector.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.
	
	// Validate the incoming data...
	$errors = array();

	
	// Check for an /home/47924/public_html/to2446992/final/karate_V2/new_img:
	if (is_uploaded_file ($_FILES['/home/47924/public_html/to2446992/final/karate_V2/new_img']['tmp_name'])) {

		// Create a temporary file name:
		$temp = '/home/47924/public_html/to2446992/final/karate_V2/new_img' . md5($_FILES['/home/47924/public_html/to2446992/final/karate_V2/new_img']['name']);
	
		// Move the file over:
		if (move_uploaded_file($_FILES['/home/47924/public_html/to2446992/final/karate_V2/new_img']['tmp_name'], $temp)) {

			echo '<p>The file has been uploaded!</p>';
	
			// Set the $i variable to the /home/47924/public_html/to2446992/final/karate_V2/new_img's name:
			$i = $_FILES['/home/47924/public_html/to2446992/final/karate_V2/new_img']['name'];
	
		} else { // Couldn't move the file over.
			$errors[] = 'The file could not be moved.';
			$temp = $_FILES['/home/47924/public_html/to2446992/final/karate_V2/new_img']['tmp_name'];
		}

	} else { // No uploaded file.
		$errors[] = 'No file was uploaded.';
		$temp = NULL;
	}
	
	// Check for a size (not required):
	$s = (!empty($_POST['size'])) ? trim($_POST['size']) : NULL;
		
	
	
	if (empty($errors)) { 

		// Add the print to the database:
		$q = 'INSERT INTO to2446992_Karate_Student_App (`Photo`) VALUES (?, ?, ?, ?, ?, ?)';

														
		$stmt = mysqli_prepare($database, $q);
		mysqli_stmt_bind_param($stmt, 'isdsss', $i);
		mysqli_stmt_execute($stmt);
		
		// Check the results...
		if (mysqli_stmt_affected_rows($stmt) == 1) {

			// Print a message:
			echo '<p>The print has been added.</p>';
	
			// Rename the /home/47924/public_html/to2446992/final/karate_V2/new_img:
			$id = mysqli_stmt_insert_id($stmt); // Get the print ID.
			rename ($temp, "/home/47924/public_html/to2446992/final/karate_V2/new_img/$id");
	
			// Clear $_POST:
			$_POST = array();
	
		} else { // Error!
			echo '<p style="font-weight: bold; color: #C00">Your submission could not be processed due to a system error.</p>'; 
		}
		
		mysqli_stmt_close($stmt);
		
	} // End of $errors IF.
	
	// Delete the uploaded file if it still exists:
	if ( isset($temp) && file_exists ($temp) && is_file($temp) ) {
		unlink ($temp);
	}
	
} // End of the submission IF.

// Check for any errors and print them:
if ( !empty($errors) && is_array($errors) ) {
	echo '<h1>Error!</h1>
	<p style="font-weight: bold; color: #C00">The following error(s) occurred:<br />';
	foreach ($errors as $msg) {
		echo " - $msg<br />\n";
	}
	echo 'Please reselect the  try again.</p>';
}

// Display the form...
?>
<h1>Upload Profile Picture or Change</h1>
<form enctype="multipart/form-data" action="add_print.php" method="post">

	<input type="hidden" name="MAX_FILE_SIZE" value="310000" />
	
	<fieldset><legend>Weclome to isshinryu-karate</legend>
	

	<p><b>Photo location</b> <input type="file" name="/home/47924/public_html/to2446992/final/karate_V2/new_img" /></p>
	
	<p><b>Name</b> 
	<select name="ID"><option>Select One</option>
	<?php // Get records

		$q = "SELECT ID, CONCAT_WS(' ', FirstName, LastName) FROM to2446992_Karate_Student_App ORDER BY FirstName, LastName ASC";		
	$r = mysqli_query ($database, $q);
	if (mysqli_num_rows($r) > 0) {
		while ($row = mysqli_fetch_array ($r, MYSQLI_NUM)) {
			echo "<option value=\"$row[0]\"";
			// Check for stickyness:
			if (isset($_POST['ID']) && ($_POST['ID'] == $row[0]) ) echo ' selected="selected"';
			echo ">$row[1]</option>\n";
		}
	} else {
		echo '<option>Please you have not selected a name.</option>';
	}
	mysqli_close($database); // Close the database connection.
	?>
	</select></p>

	</fieldset>
		
	<div align="center"><input type="submit" name="submit" value="Submit" /></div>

	</form>
	</div>
</body>
</html>

<?php include('includes/footer.html'); ?>