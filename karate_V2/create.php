<?php 

$page_title = 'Adminstration';
include ('manage.html');

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	require ('connector.php'); // Connect to the db.

	$errors = array(); // Initialize an error array.
		
	if (empty($_POST['firstname'])) {
		$errors[] = 'You forgot to enter your first name.';
	} else {
		$fn = mysqli_real_escape_string($database, trim($_POST['firstname']));
	}
	
	
	if (empty($_POST['lastname'])) {
		$errors[] = 'You forgot to enter your last name.';
	} else {
		$ln = mysqli_real_escape_string($database, trim($_POST['lastname']));
	}
	
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$e = mysqli_real_escape_string($database, trim($_POST['email']));
	}
		
	if (!empty($_POST['pass'])) {
		if ($_POST['pass'] != $_POST['pass2']) {
			$errors[] = 'Your password did not match the confirmed password.';
		} else {
			$p = mysqli_real_escape_string($database, trim($_POST['pass']));
		}
	} else {
		$errors[] = 'You forgot to enter your password.';
	}

		
if(mysqli_num_rows(mysqli_query ($database ,"SELECT lastname,email FROM to2446992_kv2_admin WHERE lastname = '$ln' AND email = '$e' "))){
								//Code inside if block if userid is already there
	$errors[]='You email is already registered as an Admin; Contact customer service';
								}else{
														echo '<p><br></p>';

							}


if (empty($errors)) { // If everything's OK.
					
			//create new admin account
$p=sha1($p);		
$q = "INSERT INTO `to2446992_kv2_admin`(firstname, lastname, `email`, `pass`) VALUES ('$fn','$ln','$e', '$p')";		
$r = @mysqli_query ($database, $q); // Run the query.

		if ($r)
				 { 
				<div id="wrapper">
				
					echo '<h2>SUCCESS!</h2>';
					echo '<p><br></p>';
				</div>
		
		$t = "SELECT lastname, firstname , email AS LastName, FirstName, EmailAddress FROM `to2446992_kv2_admin`";		
			$x = @mysqli_query ($database, $t); // Run the query.


						echo '<table align="center" cellspacing="0" cellpadding="5" width="75%">
								<h3>The following account has been created:</h3><br><br>
								<tr>
									<td align="left"><b>Last Name</b></td>
									<td align="left"><b>First Name</b></td>
									<td align="left"><b>Email Address</b></td>						
								</tr>
									';

							// Fetch and print all the records....
						$bg = '#eeeeee';
						
						$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
						
							echo '<tr bgcolor="' . $bg . '">
								<td align="left">' . $ln . '</td>
								<td align="left">' . $fn . '</td>
								<td align="left">' . $e . '</td>
								
							</tr>
							';
		
						 // End of WHILE loop.

					echo '</table>';
												
		} else { 
			
			
			echo '<h1>There was an error creating account</h1>'	; 
			
			// Debugging message:
			echo '<p>' . mysqli_error($database) . '<br /><br />Query: ' . $q . '</p>';
						
		} // End of if ($r) IF.
		
		mysqli_close($database); // Close the database connection.
	
		
		exit();
		
	} else { 
	
		echo '<h1>Error!</h1>
		<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p><p><br /></p>';
		
	} // End of if (empty($errors)) IF.
	
	mysqli_close($database); // Close the database connection.

} // End of the main Submit conditional.
?>

<div id="wrapper">

	<h1>Admin page</h1>

		<form id="Form" action="create.php" method="post">

				<p>First Name: <input type="text" name="firstname" size="20" maxlength="20" value="<?php if (isset($_POST['firstname'])) echo $_POST['firstname']; ?>" /></p>

				<p>Last Name: <input type="text" name="lastname" size="20" maxlength="20" value="<?php if (isset($_POST['lastname'])) echo $_POST['lastname']; ?>" /></p>

				<p>Email Address: <input type="text" name="email" size="20" maxlength="40" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"  /> </p>

				<p>Password: <input type="password" name="pass" size="20" maxlength="20" value="<?php if (isset($_POST['pass'])) echo $_POST['pass']; ?>"  /></p>

				<p>Confirm Password: <input type="password" name="pass2" size="20" maxlength="20" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>"  /></p>

				<p><input type="submit" name="submit" value="submit" /></p>
		</form>
</div>		
<?php include ('footer.html'); ?>
