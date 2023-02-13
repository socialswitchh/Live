<?php
	session_start(); 
	include_once('../config.php');  
	$id 	= $_SESSION['id'];  
	$fname 	= $_POST['fname'];
	$previous_name = $_POST['previous_name'];
	$lname 	= $_POST['lname'];  
	$bio 	= $_POST['bio'];  
	$website = $_POST['website']; 
	$prev_data_update = mysqli_query($conn, "UPDATE cool_name SET status ='0' WHERE name = '".$previous_name."'");
	if($prev_data_update){
	    $query 	= mysqli_query($conn, "UPDATE gt_users SET fname ='".$fname."', bio ='".$bio."', website ='".$website."' WHERE dummy_id = '".$id."'"); 
	        if($query){ 
        	    mysqli_query($conn, "UPDATE cool_name SET status ='1' WHERE name = '".$fname."'");
        		echo "Profile successfully updated."; 
	        }	
	} 
	
?>