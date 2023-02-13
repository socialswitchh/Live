<?php 
session_start(); 
include_once('../config.php');  
$id = $_SESSION['id']; 
$query = "SELECT * FROM gt_dummy_users WHERE user_id = '$id'"; 
$query_retrived = mysqli_query($conn, $query) or die("Error:".mysqli_error($conn));
$row = mysqli_fetch_assoc($query_retrived); 
$result = mysqli_num_rows($query_retrived); 
 echo json_encode($row); 
?>