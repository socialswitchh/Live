<?php
	session_start(); 
	include_once('../config.php');   
	$current_date = date('Y-m-d H:i:s');
	$userId 	 = $_POST['userId']; 
	$requestToId = $_POST['requestToId'];
	$fullname =  $_POST['fullname'];  
	//$request_type = $_POST['request_type'];
	 
	//echo "UPDATE gt_friend_request SET request_status ='Accept' WHERE request_from_id = '".$userId."' AND request_to_id = '".$requestToId."'";die;  
	$query 	= mysqli_query($conn, "UPDATE gt_friend_request SET request_status ='Accept' WHERE request_from_id = '".$userId."' AND request_to_id = '".$requestToId."'"); 
	if($query){ 
		$sql1 = "INSERT INTO gt_notification(request_from_id, request_to_id, message, created_at)VALUES('$requestToId', '$userId', '$fullname accept your follow request', '$current_date')"; 
		$conn->query($sql1);
		echo 'done';
	}	
?>