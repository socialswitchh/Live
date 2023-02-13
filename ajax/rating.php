<?php  
session_start();
include_once('../config.php');   
if(!empty($_POST['postID']) && !empty($_POST['ratingNum'])){  
    $postID = $_POST['postID'];  
    $ratingNum = $_POST['ratingNum'];  
    $user_id = $_SESSION['id']; 
    $post_user_id = $_POST['user_id'];  
    $userIP = $_SERVER['REMOTE_ADDR'];  

    $query = "SELECT id, rating_number FROM rating WHERE post_id = '".$postID."' AND post_user_id = '".$post_user_id."' AND user_id='".$user_id."'";  
    $result = $conn->query($query);  
    $data = $result->fetch_assoc(); 
   // print_r($data); 
    if($result->num_rows > 0){  
        $query = "UPDATE rating SET rating_number='".$ratingNum."', user_ip='".$userIP."' WHERE id='".$data['id']."'";  
        $insert = $conn->query($query);   
        $status = 2;  
    }else{  
        // Insert rating data in the database  
        $query = "INSERT INTO rating (user_id, post_user_id, post_id, rating_number,user_ip) VALUES ('".$user_id."', '".$post_user_id."', '".$postID."', '".$ratingNum."', '".$userIP."')";  
        $insert = $conn->query($query); 
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