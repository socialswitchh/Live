<?php  

session_start(); 

include_once('../config.php');  

    $current_date = date('Y-m-d H:i:s'); 

    $id = $_SESSION['id']; 
 

        $sql = "UPDATE users_cover_photo SET status= 1 WHERE type ='main' AND user_id='".$id."'  ORDER BY id DESC LIMIT 1";  

        $result = $conn->query($sql);   

?>