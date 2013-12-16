<?php
require_once ('./config_inc.php'); 
include_once(HEADER);
require_once ('./upload_image.php');
echo '<h1>Students</h1>';

require_once (CONNECTOR);

// Number of records to show per page:
$display = 10;

// Determine how many pages there are...
if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
	$pages = $_GET['p'];
} else { // Need to determine.
 	// Count the number of records:
	$q = "SELECT COUNT(ID) FROM to2446992_Karate_Student_App";
	$r = @mysqli_query ($database, $q);
	$row = @mysqli_fetch_array ($r, MYSQLI_NUM);
	$records = $row[0];
	// Calculate the number of pages...
	if ($records > $display) { // More than 1 page.
		$pages = ceil ($records/$display);
	} else {
		$pages = 1;
	}
} // End of p IF.

// Determine where in the database to start returning results...
if (isset($_GET['s']) && is_numeric($_GET['s'])) {
	$start = $_GET['s'];
} else {
	$start = 0;
}

// Determine the sort...
// Default is by registration date.
$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'rd';

// Determine the sorting order:
switch ($sort) {
	case 'ID':
		$order_by = 'ID ASC';
		break;
	case 'ln':
		$order_by = 'LastName ASC';
		break;
	case 'fn':
		$order_by = 'FirstName ASC';
		break;
	case 'rd':
		$order_by = 'RegDate ASC';
		break;
	case 'Photo':
		$order_by = 'Photo ASC';
		break;
	default:
		$order_by = 'RegDate ASC';
		$sort = 'rd';
		break;
}
	
// Define the query:
$q = "SELECT LastName, FirstName, DATE_FORMAT(RegDate, '%M %d, %Y')as dr, ID, Photo FROM to2446992_Karate_Student_App";

$r = @mysqli_query($database, $q); // Run the query.

    	// Table header:
			echo '<table align="center" cellspacing="0" cellpadding="5" width="75%">
			<tr>
				<td align="left"><b>Edit</b></td>
				<td align="left"><b>Delete</b></td>
				<td align="left"><b><a href="view_students.php?sort=ID">ID</a></b></td>
				<td align="left"><b><a href="view_students.php?sort=Photo">Photo</a></b></td>
				<td align="left"><b><a href="view_students.php?sort=ln">Last Name</a></b></td>
				<td align="left"><b><a href="view_students.php?sort=fn">First Name</a></b></td>
				<td align="left"><b><a href="view_students.php?sort=rd">Date Registered</a></b></td>
			</tr>
			';

			// Fetch and print all the records....
			$bg = '#000000'; 
if($r === FALSE) {
    die(mysqli_error($database)); // TODO: better error handling
}
while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC))

 {
	$bg = ($bg=='#000000' ? '#ffffff' : '#000000');
		echo '<tr bgcolor="' . $bg . '">
		<td align="left"><a href="edit_user.php?id=' . $row['ID'] . '">Edit</a></td>
		<td align="left"><a href="delete_user.php?id=' . $row['ID'] . '">Delete</a></td>
		<td align="left">' . $row['ID'] . '</td>
		<td align="left">' . $row['LastName'] . '</td>
		<td align="left">' . $row['Photo'] . '</td>
		<td align="left">' . $row['FirstName'] . '</td>
		<td align="left">' . $row['dr'] . '</td>
	</tr>
	';
} // End of WHILE loop.

echo '</table>';
mysqli_free_result ($r);
mysqli_close($database);

// Make the links to other pages, if necessary.
if ($pages > 1) {
	
	echo '<br /><p>';
	$current_page = ($start/$display) + 1;
	
	// If it's not the first page, make a Previous button:
	if ($current_page != 1) {
		echo '<a href="view_students.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Previous</a> ';
	}
	
	// Make all the numbered pages:
	for ($i = 1; $i <= $pages; $i++) {
		if ($i != $current_page) {
			echo '<a href="view_students.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
		} else {
			echo $i . ' ';
		}
	} // End of FOR loop.
	
	// If it's not the last page, make a Next button:
	if ($current_page != $pages) {
		echo '<a href="view_students.php?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '">Next</a>';
	}
	
	echo '</p>'; // Close the paragraph.
	
} // End of links section.

?>