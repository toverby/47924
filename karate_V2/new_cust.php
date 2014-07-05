<?php include ('header.html'); 

$page_title = 'Get more information';
?>


<?php 
// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require ('connector.php');

	$errors = array(); // Initialize an error array.

	// Check for a first name:
	if (empty($_POST['first_name'])) {
		$errors[] = 'You forgot to enter your first name.';
	} else {
		$fn = mysqli_real_escape_string($database, trim($_POST['first_name']));
	}
	
	// Check for a last name:
	if (empty($_POST['last_name'])) {
		$errors[] = 'You forgot to enter your last name.';
	} else {
		$ln = mysqli_real_escape_string($database, trim($_POST['last_name']));
	}
	
	// Check for an email address:
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$e = mysqli_real_escape_string($database, trim($_POST['email']));
	}
	
		$last_name = $_POST["last_name"];
		$first_name = $_POST["first_name"];

	if(mysqli_num_rows(mysqli_query ($database ,"SELECT last_name,first_name FROM 2446992_New_Customer WHERE last_name = '$last_name' AND first_name = '$first_name' ")))
	 {
 		//Code inside if block if userid is already there
		$errors[]='The system says you have already registerd. Please call for help.';
		
		}else{
				echo '<p>Please wait...registration in process</p>';
	}

	if (empty($errors)){ 
					
		$q = "INSERT INTO  2446992_New_Customer (first_name, last_name, email,registration_date) VALUES
		 ('$fn', '$ln', '$e', NOW() )";	

		$r = @mysqli_query ($database, $q); // Run the query.
		
		if ($r) { 

				echo '<h1>Thank you!</h1>';
		
		} else { 
			
			
			echo '<h1>System Error</h1>;
				<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
			
			
			echo '<p>' . mysqli_error($database) . '<br /><br />Query: ' . $q . '</p>';
						
		} 
		
		mysqli_close($database); // Close the database connection.
		
		include ('footer.html'); 
		exit();
		
	} else { 
	
		echo '<h1>Error!</h1>
		<h2 class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { 
			echo " - $msg<br />\n";
		}
		echo '</h2><br /></p>';
		
	} 
	
	mysqli_close($database); 

} 
?>

<div id="wrapper">
<title><?php echo $page_title; ?></title>

	<h2>New Customer</h2>

	<form id="Form" action="new_cust.php" method="post">

			<p>First Name: <input type="text" name="first_name" size="15" maxlength="20" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>" /></p>
		    
			<p>Last Name: <input type="text" name="last_name" size="15" maxlength="40" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>" /></p>
		    
			<p>Email Address: <input type="text" name="email" size="20" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"  /> </p>
		    
			<p>Phone Number: <input type="tel" name="phone_number" size="10" maxlength="10" value="<?php if (isset($_POST['phone_number'])) echo $_POST['phone_number']; ?>"  /> </p>
		   	<p><input type="submit" name="submit" value="Submit" /></p>
	</form>

</div>

<?php include ('footer.html'); ?>