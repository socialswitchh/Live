<?php  
session_start(); 
include_once('../config.php');  
 	$user_id 	 = $_SESSION['id'];  
	$post_id = $_POST['postt_id'];
	$desc = $_POST['desc'];
	$type = $_POST['type'];
	$current_date = date('Y-m-d H:i:s'); 
	$sql = "INSERT INTO re_post(user_id, post_id, description, type, created_at)VALUES('$user_id', '$post_id', '$desc', '$type', '$current_date')"; 
	$result = $conn->query($sql); 
?>
