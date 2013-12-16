<?PHP
/* connect to db */
include('connector.php');
$ID   = $_ REQUEST ['ID'];
$query = "SELECT Photo FROM to2446992_Karate_Student_App WHERE ID = ‘$ID’";
result = mysql_query($query) or die(mysql_error());
mysql_fetch_array($result);
header(”Content-length: $size”);
header(”Content-type: image/”);
echo $content;
?>