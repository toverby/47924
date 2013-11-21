<?php #index.php
	//Tyrone Overby
	include ('includes/manage.html');
	require_once ('includes/class_lib.php');
	$page_title = 'Current Customers';
?>
<?php

	class search
	{
			

	$q = "SELECT CONCAT(last_name,first_name, '','','') as name FROM  2446992_New_Customer";	

	$r = @mysqli_query ($database, $q); 


	$num = mysqli_num_rows($r) or die(mysqli_error($database));

		if ($num > 0){ 


			echo "<h1>There are currently $num new students</h1>\n";


			echo '<table align="center" cellspacing="3" cellpadding="3" width="75%">
				<tr><td align="left"><b>Name</b></td><td align="left"><b></b></td></tr>';
					
				while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC))
				 {
					echo '<tr><td align="left">' . $row ['name'].'</td></tr>';
				}

				echo '</table>'; 

				mysqli_free_result ($r);

				} else { 

				echo '<p class="error">There are no new students</p>';

				}

mysqli_close($database);

}//end class query 
?>
