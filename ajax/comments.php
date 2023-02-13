<?php 
  include_once('../config.php');   
  if(!empty($_POST["comment"])){ 
    $currentDate = date('Y-m-d H:i:s'); 
    $post_id = $_POST['postId']; 
    $user_id = $_POST['userId']; 
  //  echo "INSERT INTO comment(reply_id, post_id, user_id, comment, created_at) VALUES ('".$_POST["commentId"]."', '".$_POST["postId"]."', '".$_POST["userId"]."', '".$_POST["comment"]."', '".$currentDate."')";die;
    // $insertComments = "INSERT INTO comment(reply_id, post_id, user_id, comment, created_at) VALUES ('".$_POST["commentId"]."', '".$_POST["postId"]."', '".$_POST["userId"]."', '".$_POST["comment"]."', '".$currentDate."')";
    $insertComments = "INSERT INTO comment(reply_id, post_id, user_id, comment, created_at) VALUES ('".$_POST["commentId"]."', '".$post_id."', '".$user_id."', '".$_POST["comment"]."', '".$currentDate."')";
    mysqli_query($conn, $insertComments) or die("database error: ". mysqli_error($conn));  
    $message = '<label class="text-success"></label>'; 
    $status = array( 
      'error'  => 0, 
      'message' => $message,
      'postid'=>$post_id, 
    );   
  } else { 
    $message = '<label class="text-danger">Error: Comment not posted.</label>'; 
    $status = array( 
      'error'  => 1, 
      'message' => $message,
      'postid'=>$post_id, 
    );   
  } 
  echo json_encode($status); 
?>