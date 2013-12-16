<?php ob_start();
session_name('karate_admin');
require_once ('config_inc.php');
 ?>

<?php 
      header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
      header('Pragma: no-cache'); // HTTP 1.0.
      header('Expires: 0'); // Proxies.
?>     

 <?php 

        if (isset($_SESSION['email'])) {
         
          $msg="You are already signed in";
                    
          $page='loggedin.php';
          $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
          $url = rtrim($url, '/\\');

          // Add the page
          $url .= '/' . $page;
  
         }else{ 

         $page='login.html';
          $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
          $url = rtrim($url, '/\\');

          // Add the page
          $url .= '/' . $page;
                    
          }

       header("Location: " . $url); 
       exit(); // Quit the script.
?> 

<?php ob_flush() ?>