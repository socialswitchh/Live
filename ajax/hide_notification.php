<?php  
session_start(); 
include_once('../config.php'); 
	$mainID = $_POST['main_id']; 
	$dummyID = $_POST['dummy_id'];
	
	$sql = "UPDATE gt_notification SET status='0' WHERE request_to_id='".$mainID."' OR  request_to_id='".$dummyID."'";  
	echo $sql;
	$result = $conn->query($sql);  
?>