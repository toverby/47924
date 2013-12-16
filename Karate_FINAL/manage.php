<?php ob_start(); ?>

<?php
      header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
      header('Pragma: no-cache'); // HTTP 1.0.
      header('Expires: 0'); // Proxies.
     require ('config_inc.php'); 
     $page_title="Adiministratiive";
?>           
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  <title><?php echo $page_title; ?></title> 
<link rel="stylesheet" type="text/css" href="style.css" media="screen"/>
 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <script type="text/javascript" src="start.js" charset="utf-8"></script>
 <script type="text/javascript" src="jquery-1.6.4.min.js" charset="utf-8"></script>
  <script type="text/javascript" src= "login.js" charset="utf-8"></script>
  

</head>

<body>
<div id="wrapper">

    <div id="header">

      	<h3>Customer administration</h3>
      
    </div>

  <div id="tabs">
    
      <ul>
      
        <li><a href="create.php">Create Account</a></li>
        <li><a href="getrecords.php">Display Contact List</a></li>
        <li><a href="view_students.php">Display Students</a></li>
        <li><a href="edit_user.php">Edit Student Info</a></li>
        <li><a href="">NonActive</a></li>
        <li class="logout"><a href="logout.php">Logout</a></li>
   
      </ul> 
    </div>