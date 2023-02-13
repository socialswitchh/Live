<?php 
session_start(); 
include_once('../config.php');  
$email = $_POST['email']; 
$query = "SELECT email FROM gt_users WHERE email = '$email'"; 
$query_retrived = mysqli_query($conn, $query) or die("Error:".mysqli_error($conn));
$rows = mysqli_fetch_assoc($query_retrived); 
$result = mysqli_num_rows($query_retrived); 
if ($result>0)
{
   echo 'true';
}
else
{ 
	echo 'false';
	
}
mysqli_free_result($query_retrived);
?>