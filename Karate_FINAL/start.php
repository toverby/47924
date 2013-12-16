<?php ob_start();
session_name('karate_admin');
 ?>

<?php 
      header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
      header('Pragma: no-cache'); // HTTP 1.0.
      header('Expires: 0'); // Proxies.
?>     

 <?php 
 if (!isset($_SESSION['agent']) OR ($_SESSION['agent'] != md5($_SERVER['HTTP_USER_AGENT']) ))
 {

              // Need the functions:
              require('login_ajax.php');
              require ('login_page.php');
               redirect_user();  

            }else{

         $msg="You are already signed in";
                    
          $page='loggedin.php';
          $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
          $url = rtrim($url, '/\\');
 }
         
         
       header("Location: " . $url); 
       exit(); // Quit the script.
?> 

<?php ob_flush() ?>