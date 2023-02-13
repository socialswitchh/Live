<?php 

	session_start(); 

	include_once('../config.php');

	$userid = $_POST['user_id'];

	$anonymous = implode(',', $_POST['anonymous_name']);

	$query = mysqli_query($conn, "UPDATE gt_users SET anonymous='$anonymous' WHERE dummy_id='$userid'");
		if($query){ 
			mysqli_query($conn, "UPDATE gt_users SET status='1'  WHERE id='".$_SESSION['id']."'");
			$sql = "select * from `gt_users` where `email` = '".$_SESSION['email']."' and `mobile` = '".$_SESSION['mobile']."' and `status` = 1"; 
				 
			      	$res = mysqli_query($conn, $sql);  
			      	$row = mysqli_fetch_array($res, MYSQLI_ASSOC); 
			       
			      	$count = mysqli_num_rows($res); 
			        if($count>0){
			        	 
			            $_SESSION['is_login'] = 'login';
						
						 
						 
						print_r($_SESSION);
			        }  
		}

?>