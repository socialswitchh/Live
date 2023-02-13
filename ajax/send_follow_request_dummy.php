<?php  
session_start();  
include_once('../config.php');  
	$current_date = date('Y-m-d H:i:s');   
	$from_id = $_POST['from_id'];  
	$to_id = $_POST['to_id'];  
	$fullname = $_POST['fullname']; 
	$privacy = $_POST['privacy']; 
	$photo = $_POST['photo']; 
	if ($privacy=="on") { 
		$pv_status = 'Pending'; 
	}else{ 
		$pv_status = 'Accept'; 
	} 
	$sql = "INSERT INTO gt_friend_request(request_from_id, request_to_id, request_status, request_notification_status, created_at)VALUES('$from_id', '$to_id', '".$pv_status."', 'No', '$current_date')";  
	//echo $sql; die; 
	$result = $conn->query($sql); 
	if($result){ 
			$sql2 = "UPDATE gt_friend_request SET request_type='following' WHERE request_to_id='".$to_id."' AND  request_from_id='".$from_id."'";  
			$conn->query($sql2); 
			$sql1 = "INSERT INTO gt_notification(request_from_id, request_to_id, message, user_image, created_at)VALUES('$from_id', '$to_id', '$fullname sends you follow request', '$photo', '$current_date')"; 
			$conn->query($sql1); 
	} 
?>