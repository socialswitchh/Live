<?php  
include_once('../config.php');  
if(!empty($_POST['user_id']) && !empty($_POST['post_id']) && !empty($_POST['rcommentId']) && !empty($_POST['ratingNum'])){  
    $postID = $_POST['post_id']; 
    $ratingNum = $_POST['ratingNum']; 
    $user_id = $_POST['user_id']; 
    $comment_id = $_POST['rcommentId'];   
    $userIP = $_SERVER['REMOTE_ADDR'];   
    $query = "SELECT id, rating_number FROM comment_rating WHERE post_id = $postID AND user_id = '".$user_id."' AND comment_id = '".$comment_id."' AND user_ip = '".$userIP."'";  
    $result = $conn->query($query); 
    $data = $result->fetch_assoc();
   // print_r($data);die;
    if($result->num_rows > 0){ 
        $query = "UPDATE comment_rating SET rating_number='".$ratingNum."', user_id='".$user_id."', user_ip='".$userIP."' WHERE id='".$data['id']."'"; 
        $insert = $conn->query($query);  
        $status = 2; 
    }else{
  // echo "INSERT INTO comment_rating (user_id, post_id, comment_id, rating_number,user_ip)VALUES ('".$user_id."', '".$postID."', '".$comment_id."', '".$ratingNum."', '".$userIP."')";  
         
        $query = "INSERT INTO comment_rating (user_id, post_id, comment_id, rating_number,user_ip)VALUES ('".$user_id."', '".$postID."', '".$comment_id."', '".$ratingNum."', '".$userIP."')";  
        $insert = $conn->query($query);  
        $status = 1; 
    }  
    $query = "SELECT COUNT(rating_number) as rating_num, FORMAT((SUM(rating_number) / COUNT(rating_number)),1) as average_rating FROM comment_rating WHERE comment_id = $comment_id  GROUP BY (comment_id)";  
    $result = $conn->query($query); 
    $ratingData = @$result->fetch_assoc(); 
     
    $response = array( 
        'data' => $ratingData, 
        'status' => $status 
    );  
    echo json_encode($response); 
} 
?>