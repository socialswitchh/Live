<?php  
session_start(); 
include_once('../config.php');   
	$user_id = @$_POST['commentUsrId'];
	$query = "SELECT fname, lname FROM gt_users WHERE id = '".$user_id."' ORDER BY id DESC LIMIT 1"; 
    $query_retrived = mysqli_query($conn, $query) or die("Error:".mysqli_error($conn));
    $rows = mysqli_fetch_assoc($query_retrived); 
    $num_row = mysqli_num_rows($query_retrived);
    if($num_row > 0) {
    	echo json_encode($rows); 
    }else {
    	echo json_encode(array('fname'=> 'null', 'lname'=> 'null')); 
    }
	
?>