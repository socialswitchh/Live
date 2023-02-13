<?php
	session_start(); 
	include_once('../config.php');  
	$id 	= $_SESSION['id'];  
	$privacy 	= $_POST['privacy'];  
    	$query = mysqli_query($conn, "UPDATE gt_users SET is_privacy ='".$privacy."' WHERE id = '".$id."'");
    	if ($query) {
    		echo "success";
    	}  
?>