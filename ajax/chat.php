<?php  
session_start(); 
include_once('../config.php');  
	$from_id  = $_POST['from_id'];
	$to_id = $_POST['to_id']; 
	$chat_message = @$_POST['chat_message']; 
	$current_date = date('Y-m-d H:i:s'); 
	$sql = "INSERT INTO gt_chatt(from_id, to_id, message, created_at)VALUES('$from_id', '$to_id', '$chat_message', '$current_date')"; 
	$result = $conn->query($sql);  
	if ($result) {
	 	echo "Data Save."; 
	 } 
?>