<?php
    session_start();
	include_once('config.php');  
   	if(session_destroy()) {
	$sql2=$conn->prepare("UPDATE `gt_users` SET is_login=0 WHERE id =?");
	$sql2->bind_param('s',$_SESSION['id']); 
	$sql2->execute();
      header("Location: index.php");
    } 
?>