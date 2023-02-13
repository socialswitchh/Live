<?php  
session_start(); 
include_once('../config.php');  
	$current_date = date('Y-m-d H:i:s'); 

    $anonymous = @implode(',', $_POST['anonymous_name']);
	if (!empty($anonymous)) {
	 	$id = $_SESSION['id'];
		$query = "SELECT anonymous FROM gt_users WHERE dummy_id = '".$_SESSION['id']."'"; 
	    $query_retrived = mysqli_query($conn, $query) or die("Error:".mysqli_error($conn));
	    $row = mysqli_fetch_assoc($query_retrived);
	    $array = $row['anonymous'];   
		$blank_array = array(); 
	    $blank_array[] = $anonymous;  
	    $blank_array[] = $array;   
	    $ids = implode(',',$blank_array);  
		$query = mysqli_query($conn, "UPDATE gt_users SET anonymous='$ids' WHERE dummy_id='$id'");
	 }else{
	 	$id = $_SESSION['id'];
		$query = "SELECT anonymous FROM gt_users WHERE dummy_id = '".$_SESSION['id']."'"; 
	    $query_retrived = mysqli_query($conn, $query) or die("Error:".mysqli_error($conn));
	    $row = mysqli_fetch_assoc($query_retrived);
	    $array = $row['anonymous'];   
		$blank_array = array();  
	    $blank_array[] = $array;   
	    $ids = implode(',',$blank_array);  
		$query = mysqli_query($conn, "UPDATE gt_users SET anonymous='$ids' WHERE dummy_id='$id'");
	 } 
	  
?>
 