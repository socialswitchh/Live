<?php

session_start();

include_once('../config.php');  
	session_start();
		//print_r($_POST);
	if (isset($_POST['like'])){		
		
		$id = $_POST['id'];
		$query=mysqli_query($conn,"select * from `like_unlike` where post_id='$id' and user_id='".$_SESSION['id']."'") or die(mysqli_error());
		
		if(mysqli_num_rows($query)>0){
			mysqli_query($conn,"delete from `like_unlike` where user_id='".$_SESSION['id']."' and post_id='$id'");
		} else {
			mysqli_query($conn,"insert into `like_unlike` (user_id,post_id) values ('".$_SESSION['id']."', '$id')");
		}
	}		
?>
