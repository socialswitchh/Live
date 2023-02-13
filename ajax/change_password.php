<?php
	session_start(); 
	include_once('../config.php');  
	$id 	= $_SESSION['id'];  
	$old_pass 	= $_POST['old_pass']; 
	$new_pass 	= $_POST['new_pass'];
	if ($old_pass=="") {
	 	echo "Please fill your old password.";
	 }elseif ($new_pass=="") {
	 	echo "Please fill your new password.";
	 }else{ 
	$query = "SELECT password FROM gt_users WHERE password = '".md5($old_pass)."'";  
	$query_retrived = mysqli_query($conn, $query) or die("Error:".mysqli_error($conn));
	$r = mysqli_fetch_assoc($query_retrived);  
	$result = mysqli_num_rows($query_retrived); 
	if ($result>0)
	{  
    	$success = mysqli_query($conn, "UPDATE gt_users SET password ='".md5($new_pass)."' WHERE password = '".$r['password']."'");
    	if ($success) {
    		echo "Your new password has been successfully changed !!";
    	} 
	}else{
		echo "Please enter correct old password"; 
	} 
	} 
?>