<?php 
session_start(); 
include_once('../config.php');  
$unique_name = $_POST['unique_name']; 
$query = "SELECT email FROM gt_users WHERE unique_name = '$unique_name'"; 
$query_retrived = mysqli_query($conn, $query) or die("Error:".mysqli_error($conn));
$rows = mysqli_fetch_assoc($query_retrived); 
$result = mysqli_num_rows($query_retrived); 
if ($result>0)
{
    echo 'false';
}
else
{ 
	echo 'true';
}
mysqli_free_result($query_retrived);
?>