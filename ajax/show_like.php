<?php

session_start();

include_once('../config.php'); 
	
	if (isset($_POST['showlike'])){
		$id = $_POST['id'];
		$query2=mysqli_query($conn,"select * from `like_unlike` where post_id='$id'");
		echo mysqli_num_rows($query2);	
	}
?>

