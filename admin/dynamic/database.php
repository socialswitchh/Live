<?php   
  function db() {
	$servername = "localhost";
	$username = "switchh_user";
	$password = "dHWYPf8PY?g2";
	$dbname = "switchh_live"; 
	$conn = mysqli_connect($servername, $username, $password, $dbname); 
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	   else{
		return $conn;
	}  
	
 }  
	
?>