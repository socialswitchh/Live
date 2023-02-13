<?php 
session_start();
include('config.php');
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
    $last =   generateRandomString(5); 
*/
	$firstname = $_SESSION['user_first_name'];
	$lastname = $_SESSION['user_last_name']; 
	$email = $_SESSION['user_email_address'];
	$photo = $_SESSION['user_image'];
	$password = md5($firstname.'@123'); 
	$unique_name = '@'.$_SESSION['user_first_name'].rand(100000,999990);
	//echo $unique_name;die;
	$current_date = date('Y-m-d H:i:s'); 

	$query_check = "select * from `gt_users` where `email` = '".$email."'"; 
	//echo $query_check;die;
  	$res_check = mysqli_query($conn, $query_check);  
  	$row_check = mysqli_fetch_array($res_check, MYSQLI_ASSOC); 
  	$count_check = mysqli_num_rows($res_check); 
    if($count_check==0){
    	$sql = "INSERT INTO gt_users(dummy_id, fname, lname, email, unique_name,  password, photo, created_at)VALUES(0,'$firstname','$lastname','$email','$unique_name', '$password', '$photo', '$current_date')";  
		$result = $conn->query($sql); 
		$last_id = mysqli_insert_id($conn);
		if(isset($result)){
				$query = "select * from `gt_users` where `email` = '".$email."'"; 
		      	$res = mysqli_query($conn, $query);  
		      	$row = mysqli_fetch_array($res, MYSQLI_ASSOC); 
		      	$count = mysqli_num_rows($res); 
		        if($count>0){
		            $_SESSION['id'] = $row['id'];
					$_SESSION['email'] = $row['email'];
					$_SESSION['fname'] = $row['fname'];
					$_SESSION['lname'] = $row['lname']; 
					$_SESSION['is_login'] = 'login';  
		        }  
			$sql = "INSERT INTO gt_users(dummy_id, created_at)VALUES('$last_id', '$current_date')"; 
			$conn->query($sql); 
			header("Location:signup_step2.php");
		}
    }else{ 
		$query = "select * from `gt_users` where `email` = '".$email."'"; 
		      	$res = mysqli_query($conn, $query);  
		      	$row = mysqli_fetch_array($res, MYSQLI_ASSOC); 
		      	$count = mysqli_num_rows($res); 
		        if($count>0){
		            $_SESSION['id'] = $row['id'];
					$_SESSION['email'] = $row['email'];
					$_SESSION['fname'] = $row['fname'];
					$_SESSION['lname'] = $row['lname']; 
					$_SESSION['is_login'] = 'login';  
		        }  

    	$sql = "UPDATE gt_users SET login_with='Google' WHERE email='".$email."'";  
		$result = $conn->query($sql);
		header("Location:feed.php");
    } 
	 
?>