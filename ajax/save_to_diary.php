<?php  
session_start(); 
include_once('../config.php');  
	$user_id = $_SESSION['id']; 
	$post_id = $_POST['id'];
	$current_date = date('Y-m-d H:i:s'); 
    $rows = mysqli_fetch_assoc($query_retrived); 
    $last_id = $rows['id'];  
	$sql = "INSERT INTO save_to_diary(`std_user_id`, `post_id`, `created_at`)
				VALUES('".$user_id."', '".$post_id."', '".$current_date."')";  
	$result = $conn->query($sql); 








	 












?>