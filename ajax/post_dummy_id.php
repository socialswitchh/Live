<?php  
session_start(); 
include_once('../config.php');  
	$current_date = date('Y-m-d H:i:s'); 
	$last_id = $conn->insert_id;
	$user_id = $_POST['user_id'];
	$query = "SELECT id FROM gt_posts ORDER BY id DESC LIMIT 1"; 
    $query_retrived = mysqli_query($conn, $query) or die("Error:".mysqli_error($conn));
    $rows = mysqli_fetch_assoc($query_retrived); 
    $last_id = $rows['id'];  
	$sql = "UPDATE gt_posts SET is_post='dummy', user_id='".$user_id."' WHERE id='".$last_id."'";  
	$result = $conn->query($sql);  
?>