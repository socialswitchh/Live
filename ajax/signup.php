<?php  
session_start();
include_once('../config.php'); 
/*	function generateRandomString($length = 5, $hasNumber = true, $hasLowercase = true, $hasUppercase = true): string
	{
	    $string = '';
	    if ($hasNumber)
	        $string .= '0123456789';
	    if ($hasLowercase)
	        $string .= 'abcdefghijklmnopqrstuvwxyz';
	    if ($hasUppercase)
	        $string .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    return substr(str_shuffle(str_repeat($x = $string, ceil($length / strlen($x)))), 1, $length);
	} 

    $batch =  'Student';
    $last =   generateRandomString(5); */

	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$mobile = $_POST['mobile'];
	$unique_name = $_POST['unique_name'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	//$dob = $_POST['dob'];
	//$gender = $_POST['gender'];
	$current_date = date('Y-m-d H:i:s'); 
	$sql = "INSERT INTO gt_users(dummy_id, fname, lname, mobile, unique_name, email, password, created_at)VALUES(0,'$firstname','$lastname','$mobile','$unique_name','$email', '$password','$current_date')";  
	$result = $conn->query($sql); 
	$last_id = mysqli_insert_id($conn);
	if(isset($result)){ 
		$query = "select * from `gt_users` where `email` = '".$email."' and `mobile` = '".$mobile."'"; 
			      	$res = mysqli_query($conn, $query);  
			      	$row = mysqli_fetch_array($res, MYSQLI_ASSOC); 
			      	$count = mysqli_num_rows($res); 
			        if($count>0){
			            $_SESSION['id'] = $row['id'];
			            $_SESSION['email'] = $row['email'];
						$_SESSION['fname'] = $row['fname'];
						$_SESSION['lname'] = $row['lname'];
						$_SESSION['mobile'] = $row['mobile']; 
						$_SESSION['unique_name'] = $row['unique_name']; 
			        }
		$sql = "INSERT INTO gt_users(dummy_id, created_at)VALUES('$last_id', '$current_date')"; 
		$conn->query($sql);
		//echo "User registerd, now select Anonymous name.";

	}
?>