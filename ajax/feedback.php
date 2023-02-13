<?php 
// Include the database config file 
include_once('../config.php');  
if(!empty($_POST['feedback_desc']) && !empty($_POST['feedback_rating'])){  
    $feedback_rating = $_POST['feedback_rating'];
    $feedback_desc = $_POST['feedback_desc']; 
    $user_id = $_POST['user_id'];   
    $userIP = $_SERVER['REMOTE_ADDR']; 
    $currentDate = date("Y-m-d H:i:s"); 
    $query = "INSERT INTO feedback(user_id, feedback_desc, feedback_rating,user_ip, created_at) VALUES ('".$user_id."', '".$feedback_desc."', '".$feedback_rating."', '".$userIP."', '".$currentDate."')"; 
    $insert = $conn->query($query);  
    if ($insert) {
        echo "Thanks for your feedback";
    }     
} 
?>