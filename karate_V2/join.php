<?php 
session_start();
include ('header.html'); 

$page_title = 'Application to join';?>

<?php 
// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	require ('connector.php');

	$errors = array(); // Initialize an error array to store errors

// Check for a first name:
	if (empty($_POST['FirstName'])) {
		$errors[] = 'You forgot to enter your first name.';
			
									} else {
											$fn = mysqli_real_escape_string($database, trim($_POST['FirstName']));
											}	

	// Check for a last name:
	if (empty($_POST['LastName'])) {
		$errors[] = 'You forgot to enter your last name.';
									} else {
		$ln = mysqli_real_escape_string($database, trim($_POST['LastName']));
									}

	if (empty($_POST['Birthdate'])) {
		$errors[] = 'Please enter a birthdate';
									} else {
									$bd = mysqli_real_escape_string($database, trim($_POST['Birthdate']));
									}

	if (empty($_POST['EmergencyContact'])) {
				$errors[] = 'Please enter an Emergency Contact Name and Phone Number';
										} else {
					$ec = mysqli_real_escape_string($database, trim($_POST['EmergencyContact']));
											}

	if (empty($_POST['MobileNumber'])) {
		$errors[] = 'Please enter a telephone number';
										} else {
							$mp = mysqli_real_escape_string($database, trim($_POST['MobileNumber']));
										}

	if (empty($_POST['Address'])) {
					$errors[] = 'Please enter a valid address';
								} else {
		$ads = mysqli_real_escape_string($database, trim($_POST['Address']));
								}

	if (empty($_POST['City'])) {
					$errors[] = 'Please enter a  city name';
							} else {
							$cty = mysqli_real_escape_string($database, trim($_POST['City']));
							}

	if (empty($_POST['PostalCode'])) {
								$errors[] = 'Please enter a zip code';
									} else {
									$zip = mysqli_real_escape_string($database, trim($_POST['PostalCode']));
								}

	if (empty($_POST['EmailAddress'])) {
								$errors[] = 'You forgot to enter your email address.';
	 								} else {
									$e = mysqli_real_escape_string($database, trim($_POST['EmailAddress']));
											}
	if (!isset($_POST['Photo'])) {
								$_POST['Photo'] = "undefine";
				}else{

					$img = mysqli_real_escape_string($database, trim($_POST['Photo']));

								}
	if (!isset($_POST['ChildrenNames'])) {
			$_POST['ChildrenNames'] = "undefine";
							}else{
					$cn = mysqli_real_escape_string($database, trim($_POST['ChildrenNames']));

								}
	if (!isset($_POST['Notes'])) {
			$_POST['Notes'] = "undefine";
							}else{
					$nt=mysqli_real_escape_string($database, trim($_POST['Notes']));

								}							
	if (!isset($_POST['SpouseName'])) {
			$_POST['SpouseName'] = "undefine";
							}else{
					$sn=mysqli_real_escape_string($database, trim($_POST['SpouseName']));

								}							
	if (!isset($_POST['State'])) {
			$_POST['State'] = "undefine";
							}else{
					$st=mysqli_real_escape_string($database, trim($_POST['State']));

								}							
	if (!isset($_POST['PhoneNumber'])) {
			$_POST['PhoneNumber'] = "undefine";
							}else{
					$hp=mysqli_real_escape_string($database, trim($_POST['PhoneNumber']));

								}							
	if (!isset($_POST['Salutation'])) {
			$_POST['Salutation'] = "undefine";
							}else{
			$sal=mysqli_real_escape_string($database, trim($_POST['Salutation']));

								}				

	if (empty($errors)){

		/*
		$LastName = $_POST["LastName"];
		$FirstName = $_POST["FirstName"];
		*/
		if(mysqli_num_rows(mysqli_query ($database ,"SELECT LastName,FirstName FROM to2446992_kv2 WHERE LastName = '$ln' AND FirstName = '$fn' "))){
						//Code inside if block if userid is already there
					$errors[]='The system says you already have an Application on file. Please call for help';
					
														}else{
														echo '<p><br></p>';

															}
						
		

	//$q = "INSERT INTO  to2446992_kv2 (RegDate,Photo,Salutation,FirstName,LastName,Birthdate,EmergencyContact,MobileNumber,PhoneNumber,ChildrenNames,Address,City,State,PostalCode,EmailAddress,SpouseName,Notes)VALUES (NOW(),'$sal','$img',$fn','$ln','$bd','$ec','$hp','$cn','$ads','$cty','$st','$zip','$e','$sn','$nt')";	
	$q = "INSERT INTO to2446992_kv2(`RegDate`,`Photo`,`Salutation`,`FirstName`,`LastName`,`Birthdate`,`EmergencyContact`,`MobileNumber`,`PhoneNumber`,`ChildrenNames`,`Address`,`City`,`State`,`PostalCode`,`EmailAddress`,`SpouseName`,`Notes`)VALUES (NOW(),'$img','$sal','$fn','$ln','$bd','$ec','$mp','$hp','$cn','$ads','$cty','$st','$zip','$e','$sn','$nt')";														

				$r = @mysqli_query ($database, $q);
							
					if ($r){ 

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

	<form id="Form_App" action="join.php" method="post">
		
		<div id="Form_App_l">
		
			<h2>Personal Info</h2>

					<p>Mr./Mrs./Miss <input type="text" name="Salutation" size="5" maxlength="5" value="<?php if (isset($_POST['Salutation'])) echo $_POST['Salutation']; ?>" /></p>
				   
					<p>First Name: <input type="text" name="FirstName" size="20" maxlength="20" value="<?php if (isset($_POST['FirstName'])) echo $_POST['FirstName']; ?>" /></p>
				    
					<p>Last Name: <input type="text" name="LastName" size="20" maxlength="20" value="<?php if (isset($_POST['LastName'])) echo $_POST['LastName']; ?>" /></p>

					<p>Birth Date: <input type="date" name="Birthdate" size="10" maxlength="10" value="<?php if (isset($_POST['Birthdate'])) echo $_POST['Birthdate']; ?>" /></p>

					<p>Emerncy Contact: <input type="text" name="EmergencyContact" size="20" maxlength="20" value="<?php if (isset($_POST['EmergencyContact'])) echo $_POST['EmergencyContact']; ?>" /></p>

				    <p>Mobile Number: <input type="tel" name="MobileNumber" size="12" maxlength="12" value="<?php if (isset($_POST['MobileNumber'])) echo $_POST['MobileNumber']; ?>" /></p>

				    <p>Home/Second Number: <input type="tel" name="PhoneNumber" size="12" maxlength="12" value="<?php if (isset($_POST['PhoneNumber'])) echo $_POST['PhoneNumber']; ?>" /></p>


				    <p>Children Names(if necessary): <input type="text" name="ChildrenNames" size="20" maxlngth="20" value="<?php if (isset($_POST['ChildrenNames'])) echo $_POST['ChildrenNames']; ?>" /></p>
	    
		</div>
	    
	  <div id="Form_App_r">
	  	
		  	<h2>Location</h2>
			    <p>Address: <input type="text" name="Address" size="50" maxlength="50" value="<?php if (isset($_POST['Address'])) echo $_POST['Address']; ?>" /></p>

			    <p>City: <input type="text" name="City" size="20" maxlength="25" value="<?php if (isset($_POST['City'])) echo $_POST['City']; ?>" /></p>

			    <p>State(optional): <input type="text" name="State" size="4" maxlength="3" value="<?php if (isset($_POST['State'])) echo $_POST['State']; ?>" /></p>

			    <p>Zip: <input type="text" name="PostalCode" size="10" maxlength="9" value="<?php if (isset($_POST['PostalCode'])) echo $_POST['PostalCode']; ?>" /></p>

			    <p>Email Address: <input type="text" name="EmailAddress" size="30" maxlength="30" value="<?php if (isset($_POST['EmailAddress'])) echo $_POST['EmailAddress']; ?>"  /> </p>
			    </fieldset>
							
			   	<p>Spouse Name(optional): <input type="text" name="SpouseName" size="20" maxlength="20" value="<?php if (isset($_POST['SpouseName'])) echo $_POST['SpouseName']; ?>"  /> </p>
		    				
			   	<p for="Photo">Upload a photo</label> <input type="file" name="Photo" value="<?php if (isset($_POST[	'Photo'])) echo $_POST['Photo']; ?>"  /></p>
		
			<p>Please tell use more about yourself and/or child; such as health conditionals, prior experience or special needs<input type="text" name="Notes" size="1000" maxlength="1000" value="<?php if (isset($_POST['phone_number'])) echo $_POST['phone_number']; ?>"  /></p>

		   	<p><input type="submit" name="submit" value="Register" /></p>
		   
	  </div>
	
	</form>

</div>

<?php 

include ('footer.html'); 

?>