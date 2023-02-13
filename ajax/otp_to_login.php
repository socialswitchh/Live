<?php 
include('../config.php');  
session_start();  
$otp = mysqli_escape_string($conn,$_POST['login_otp']); 
$sql=$conn->prepare("SELECT * FROM gt_users WHERE otp =?"); 
$sql->bind_param('s',$otp);
$sql->execute(); 
$result=$sql->get_result(); 
$row = $result->fetch_assoc(); 
$count = $result->num_rows;  
	if($count>0){ 
		echo "Successfully login."; 
	}else{  
		$error = "Your invalid credentials";
		$_SESSION['login_count']=$_SESSION['login_count']+1; 
	} 
?>