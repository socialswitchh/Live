<?php  
session_start(); 
include_once('../config.php');  
	$current_date = date('Y-m-d H:i:s'); 
	$to_id = $_POST['to_id'];
	$from_id = $_POST['from_id'];
	 
	$sql = "DELETE FROM gt_friend_request  WHERE request_from_id='".$from_id."' AND request_to_id='".$to_id."' AND request_status='Pending'";  
    echo $sql;
    $result = $conn->query($sql);  

    
?>
 