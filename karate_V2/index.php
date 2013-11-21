<?php #index.php
	//Tyrone Overby
	session_start();
	include ('header.html');
	$page_title="Weclome to isshinryu-karate";
	//get meta info from orgrinal site
	$tags = get_meta_tags('http://isshinryu-karate.com');
	   
// test echo $tags['keywords'];     
// test echo $tags['description'];  

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 
	<head> 
		<title><?php echo $page_title; ?></title> 
		<link rel="stylesheet" type="text/css" href="style.css" media="screen"/>
	</head>
	
<body>
<div id="wrapper">
	<div id="content">

		 <h2>Welcome to our Dojo Cathedral City California featuring:</h2>
		 
		  <img  src="img/Fist_Welcome.jpg">
		  <ol><b>
		      <li>Sensei SandubraeSensei McConnell</li>
		      <li>Sensei Tweedie Sensei Doster</li>
		      <li>Mr Kendel</li>
		      <li>Mr Manger</li> 
		      <li>Mr G Petersen</li>
		      <li>Mr M Peterson</li>
		      <li>Mr Caballero</li>
		      <li>Mr Mota</li>
		      </b>
		  </ol>
		   <br>

<h2>School Schedule and Cost Kid's, 4 years old and older</h2>
	 
	<p>Tuesday's and Thursday's 5 PM to 6 PM and 6 PM to 7 PM Parents choice, either a one hour class, or a Two Hour Class. No extra cost to attend the TWO hour Classes. </p>

 <ul>
	<li>Veterans 3 Months Free</li>
	
	<li>Adults ONLY Tuesday's and Thursday's 7 PM to 8 PM $ 99.00 per Month Free Uniform Free Trial Class No Contracts</li>
	
 </ul>
 
 <h4>Ask about Special Family Rates ~ ~ ~ ~ New Students Start Weekly ~ ~ ~ ~ 760-568 0961 CALL NOW!</h4>
 
 <p>68225 Ramon Road at Whispering Palms Cathedral City "LIFE"WHITE Belt's Testing on Tuesday August 20th Juan Dominic Marissa Faith YELLOW Belt's Testing on ORANGE Belt's Testing on GREEN Belt's Testing on Tuesday August 20th Denise BROWN Belt's Testing on Tuesday August 20th Gracie BLACK Belt Testing on We Need Help for the SEPTEMBER Shiai is there any one Wanting to HELP? For those of you that don't know "US" here is a brief description of our Dojo. We are at 68225 Ramon Road at the intersection of Ramon Road and Whispering Palms.</p>

<p> We  have enough room to do Sparring and Self Defense in 5 FULL SIZED PERMANENT RINGS, Kata and Weapons comfortably with mirrors, We also have 6 hanging bags, RUBBER FLOORS, a room for consultation and counseling, as well as a room with about a 12 inch thick foam floor for beginners to learn to fall properly without fear of hurting themselves, storage space for our required supplies. As well as seperate Men's and Women's rest rooms with  Lockers. We also have a Knife Throwing, and Zen Archery Range. </p>
  
 </div>   
</div>
</body>
<!--insert footer page-->
<?php
	include ('footer.html');
?>