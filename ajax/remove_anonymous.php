<?php  
session_start(); 
include_once('../config.php');  
	$current_date = date('Y-m-d H:i:s'); 
    $an_id = $_POST['an_id'];
	
	$id = $_SESSION['id'];
	$query = "SELECT anonymous FROM gt_users WHERE dummy_id = '".$_SESSION['id']."'"; 
	//echo $query;die;
    $query_retrived = mysqli_query($conn, $query) or die("Error:".mysqli_error($conn));
    $row = mysqli_fetch_assoc($query_retrived);
    $array = $row['anonymous'];  
	
	$narray = explode(',', $array); 
	if (($key = array_search($an_id, $narray)) !== false) {
    	unset($narray[$key]);
	} 
	  
	$anonymous = implode(',', $narray); 
	 
	$query = mysqli_query($conn, "UPDATE gt_users SET anonymous='$anonymous' WHERE dummy_id='$id'");
?>
 