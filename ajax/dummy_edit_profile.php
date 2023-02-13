<?php
	session_start(); 
	include_once('../config.php');  
	$id 	= $_SESSION['id'];  
	$fname 	= $_POST['fname'];  
	$bio 	= $_POST['bio'];  
	$website = $_POST['website'];   
	$query 	= mysqli_query($conn, "UPDATE gt_users SET fname='".$fname."', bio ='".$bio."', website ='".$website."' WHERE dummy_id = '".$id."'"); 
	if($query){ 
		echo "Dummy Profile successfully updated."; 
	}	
?>