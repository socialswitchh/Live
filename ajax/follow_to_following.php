<?php  
session_start(); 
include_once('../config.php'); 
	$from_id = $_POST['from_id']; 
	$to_id = $_POST['to_id'];  
	$sql = "UPDATE gt_friend_request SET request_type='following' WHERE request_from_id='".$from_id."' AND  request_to_id='".$to_id."'"; 
	//echo $sql; die;
	$result = $conn->query($sql);
	 
	  
?>