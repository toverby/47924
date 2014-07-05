<?php
/*	Author: Tyrone Overby
	Project: Final-Karate-Personal-Survey-Cart
	Class: PHP CIS-12-47924
	Prof: Dr. Lehr
	
****************Project Details(Karate)*****************
Tech used: OOP Connector to database using MySQLi class
Config Script to define paths and report errors, "config_inc.php"
queries(some)excuted using the object "query" from call MySQLi class\

3 tables in MySQL database(47924):
 to2446992_Karate_Student_App(hold karate student accounts includeing pic uploads using "join.php"),  to2446992_New_Customer(contain intial contacts using " cust_contact.php")
 to2446992_Admin(contains Administrator profiles created using "create.php") 


*/
// ************ SETTINGS ************ //

// Flag variable for site status:
define('LIVE', TRUE;

// Admin contact address:
define('EMAIL', 'InsertRealAddressHere');

// Site URL (base for all redirections):
define ('BASE_URL', 'http://209.129.8.3/~47924/to2446992/htdocs/karate/');

// define require and includes
define ('CONNECTOR',  '/home/47924/public_html/to2446992/htdocs/final/karateSECURE/connector.php');
define ('HEADER' ,  '/home/47924/public_html/to2446992/htdocs/final/karateSECURE/header.html');
//define ('MANAGE' ,  '/home/47924/public_html/to2446992/htdocs/final/karateSECURE/manage.php');
//define ('EMAIL' ,  '/htdocs/karate/includes/connector.php');
define ('LOGIN_FUNCTIONS',  '/home/47924/public_html/to2446992/htdocs/final/karateSECURE/login_functions.inc.php');
//$EMAIL = isset($_POST['email']) ? $_POST['email'] : '';

// Adjust the time zone for PHP 5.1 and greater:
date_default_timezone_set ('US/Western');

// ************ SETTINGS ************ //
// ********************************** //


// ****************************************** //
// ************ ERROR MANAGEMENT ************ //

// Create the error handler:
function my_error_handler ($e_number, $e_message, $e_file, $e_line, $e_vars) {

	// Build the error message:
	$message = "An error occurred in script '$e_file' on line $e_line: $e_message\n";
	
	// Add the date and time:
	$message .= "Date/Time: " . date('n-j-Y H:i:s') . "\n";
	
	if (!LIVE) { // Development (print the error).

		// Show the error message:
		echo '<div class="error">' . nl2br($message);
	
		// Add the variables and a backtrace:
		echo '<pre>' . print_r ($e_vars, 1) . "\n";
		debug_print_backtrace();
		echo '</pre></div>';
		
	} else { // Don't show the error:

		// Send an email to the admin:
		$body = $message . "\n" . print_r ($e_vars, 1);
		mail(EMAIL, 'Site Error!', $body, 'From: email@example.com');
	
		// Only print an error message if the error isn't a notice:
		if ($e_number != E_NOTICE) {
			echo '<div class="error">A system error occurred. We apologize for the inconvenience.</div><br />';
		}
	} // End of !LIVE IF.

} // End of my_error_handler() definition.

// Use my error handler:
set_error_handler ('my_error_handler');

// ************ ERROR MANAGEMENT ************ //
// ****************************************** //