<?php  
	session_start();  
	include_once('../config.php'); 
	/*$userid = $_POST['user_id']; 
	$title = implode(',', $_POST['title']); 
	$sql = mysqli_query($conn, "SELECT * from gt_users where dummy_id='".$userid."'"); 
	$row = mysqli_fetch_array($sql);  
	$badges_id = $row['badges']; 
	//echo $badges_id;die; 
	$sql_badges = mysqli_query($conn, "SELECT * from gt_badges where id='".$badges_id."'"); 
	$row_badges = mysqli_fetch_array($sql_badges);  
	$badges_name = $row_badges['title']; 
	$query = mysqli_query($conn, "UPDATE gt_users SET fname='$badges_name', badges='$title' WHERE dummy_id='$userid'");*/

	$userid = $_POST['user_id'];
	$cool_name = $_POST['cool_name']; 
	$query = mysqli_query($conn, "UPDATE gt_users SET fname='$cool_name' WHERE dummy_id='$userid'");
	if($query){
	    mysqli_query($conn, "UPDATE cool_name SET status='1' WHERE name ='$cool_name'"); 
	}



?>