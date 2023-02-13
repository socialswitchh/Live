<?php  

	/*session_start(); 
	include_once('../config.php');  
	$pId = @$_POST['pId'];
	$query = "SELECT * FROM gt_posts WHERE id = '".$pId."'"; 
    $query_retrived = mysqli_query($conn, $query) or die("Error:".mysqli_error($conn));
    $row = mysqli_fetch_assoc($query_retrived); 
    echo json_encode($row); */


	session_start(); 
	include_once('../config.php');  
	$pId = @$_POST['pId'];
	$query = "SELECT * FROM gt_posts WHERE id = '".$pId."'"; 
    $query_retrived = mysqli_query($conn, $query) or die("Error:".mysqli_error($conn));
    $row = mysqli_fetch_assoc($query_retrived); 
    $description = base64_decode($row['description']);
    $data = array(
    	'id' => $row['id'], 
    	'title' => $row['title'], 
    	'description'=> $description, 
    );
    echo json_encode($data);    
?>