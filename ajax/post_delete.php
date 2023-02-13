<?php   
session_start(); 
include_once('../config.php');   
	$post_id = $_POST['postid']; 
	$sql = "DELETE FROM gt_posts WHERE id='".$post_id."'";  
    $result = $conn->query($sql);   
?>
 