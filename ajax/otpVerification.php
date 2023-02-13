<?php 
session_start(); 
include_once('../config.php');  
$otp = @$_POST['login_otp']; 
$query = "SELECT otp FROM gt_users WHERE otp = '$otp'"; 
//echo $query;die; 
$query_retrived= mysqli_query($conn, $query) or die("Error:".mysqli_error($conn));
$rows = mysqli_fetch_assoc($query_retrived); 
$result = mysqli_num_rows($query_retrived); 
if (@$rows['otp'] == @$otp)
{
    echo 'true';
}
else
{ 
	echo 'false';
}
mysqli_free_result($query_retrived);
?>