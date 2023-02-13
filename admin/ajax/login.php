<?php 
include('../config.php');  
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();  
$email = mysqli_escape_string($conn,$_POST['email']);
$password = mysqli_escape_string($conn,$_POST['password']); 
$sql=$conn->prepare("SELECT * FROM admin WHERE email =? and password =?"); 
$sql->bind_param('ss',$email,$password);
$sql->execute(); 
$result=$sql->get_result(); 
$row = $result->fetch_assoc(); 
$count = $result->num_rows;  
	if($count>0){  
		$_SESSION['id'] = $row['id'];
		$_SESSION['email'] = $row['email']; 
		$_SESSION['is_login'] = 'login';  
		 
	}else{  
		$error = "Your invalid credentials";
		$_SESSION['login_count']=$_SESSION['login_count']+1; 
	} 
?>