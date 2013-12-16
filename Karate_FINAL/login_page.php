<?php ob_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Login</title>
	<link rel="stylesheet" href="login_style.css" type="text/css" media="screen" />
	 <script type="text/javascript" src= "jquery-1.6.4.min.js" charset="utf-8"></script>
	  <script type="text/javascript" src= "login.js" charset="utf-8"></script>
	  <script type="text/javascript" src="start.js" charset="utf-8"></script>


</head>
<body>

	
<h1>Login</h1>

<p id="results"></p>
	

	<form action="login.php" method="post" id="login">
		<p id="emailP">Email Address: <input type="text" name="email" id="email" size="15" /><span class="errorMessage" id="emailError">Please enter your email address!</span></p>
		<p id="passwordP">Password: <input type="password" name="password" id="password" size"15" /><span class="errorMessage" id="passwordError">Please enter your password!</span></p>
		<p><input type="submit" name="submit" value="Login!" /></p>

	</form>
</body>
</html>
<?php ob_flush() ?>