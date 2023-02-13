<?php
	session_start(); 
	include_once('../config.php');  
	$id 	= $_SESSION['id'];  
	$fname 	= $_POST['fname']; 
	$lname 	= $_POST['lname'];  
	$bio 	= $_POST['bio'];  
	$website = $_POST['website'];  
	$query 	= mysqli_query($conn, "UPDATE gt_users SET fname ='".$fname."', lname ='".$lname."', bio ='".$bio."', website ='".$website."' WHERE id = '".$id."'"); 
	if($query){ 
		echo "Profile successfully updated."; 
	}	
?>