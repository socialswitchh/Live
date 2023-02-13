<?php  
session_start(); 
include_once('../config.php');  
	$current_date = date('Y-m-d H:i:s'); 
	$to_id = $_POST['to_id'];
	$from_id = $_POST['from_id'];
	 
	$sql = "DELETE FROM gt_friend_request WHERE request_to_id='".$from_id."' AND request_from_id='".$to_id."'"; 
   // echo $sql;
    $result = $conn->query($sql);  

    
?>
 