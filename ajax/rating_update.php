<?php 
// Include the database config file 
include_once('../config.php');  
 
if(!empty($_POST['postID']) && !empty($_POST['ratingNum'])){ 
    // Get posted data 
    $postID = $_POST['postID']; 
    $ratingNum = $_POST['ratingNum']; 
    $user_id = $_POST['user_id']; 
     
    // Current IP address 
    $userIP = $_SERVER['REMOTE_ADDR']; 
     
    // Check whether the user already submitted the rating for the same post 
    $query = "SELECT rating_number FROM rating WHERE post_id = $postID AND user_ip = '".$userIP."'"; 
    $result = $conn->query($query); 
     
    if($result->num_rows > 0){ 
        // Status 
        $status = 2; 
    }else{ 
        // Insert rating data in the database 
        $query = "INSERT INTO rating (user_id, post_id, rating_number,user_ip) VALUES ('".$user_id."', '".$postID."', '".$ratingNum."', '".$userIP."')"; 
        $insert = $conn->query($query); 
         
        // Status 
        $status = 1; 
    } 
     
    // Fetch rating details from the database 
    $query = "SELECT COUNT(rating_number) as rating_num, FORMAT((SUM(rating_number) / COUNT(rating_number)),1) as average_rating FROM rating WHERE post_id = $postID GROUP BY (post_id)"; 
    $result = $conn->query($query); 
    $ratingData = $result->fetch_assoc(); 
     
    $response = array( 
        'data' => $ratingData, 
        'status' => $status 
    ); 
     
    // Return response in JSON format 
    echo json_encode($response); 
} 
?>