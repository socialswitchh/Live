<?php 
session_start(); 
include_once('../config.php');  
$mobile = $_POST['mobile']; 
$query = "SELECT mobile FROM gt_users WHERE mobile = '$mobile'"; 
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