<?php 

// Include the header:
$page_title = 'Login';
//include ('manage.html');

// Print any error messages, if they exist:
if (isset($errors) && !empty($errors)) {
	echo '<h1>Error!</h1>
	<p class="error">The following error(s) occurred:<br />';
	foreach ($errors as $msg) {
		echo " - $msg<br />\n";
	}
	echo '</p><p>Please try again.</p>';
}
//<?php include ('footer.html'); 
?>

<head>
  <link rel="stylesheet" type="text/css" href="style.css" media="screen"/>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />

</head>
<body>
	<div id="wrapper">
		<form id="Form" action="login.php" method="post" accept-charset='UTF-8'>
			<h1>Login</h1>
				<p>Email Address: <input type="text" name="email" size="20" maxlength="60" /> </p>
				<p>Password: <input type="password" name="pass" size="20" maxlength="75" /></p>
				<p><input type="submit" name="submit" value="Login" /></p>
		</form>

	</div>
</body>	
