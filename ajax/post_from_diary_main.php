<?php  
session_start(); 
include_once('../config.php');  
    $id = $_POST['postid'];  
	$sql = "UPDATE gt_posts SET is_diary='No', is_post='main' WHERE id='".$id."'";  
	$result = $conn->query($sql);   
?>