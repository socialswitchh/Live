<?php
$maxsize = 5242880; // 5MB
   	if(isset($_FILES['file-input']['name']) && $_FILES['file']['name'] != ''){
       $video_name = $_FILES['file-input']['name'];
       $target_dir = "../videos/";
       $target_file = $target_dir . $_FILES["file-input"]["name"];

       // Select file type
       $extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

       // Valid file extensions
       $extensions_arr = array("mp4","avi","3gp","mov","mpeg");

       // Check extension
       if( in_array($extension,$extensions_arr) ){
 
          // Check file size
          if(($_FILES['file-input']['size'] >= $maxsize) || ($_FILES["file-input"]["size"] == 0)) {
             $_SESSION['message'] = "File too large. File must be less than 5MB.";
          }else{
             // Upload
             if(move_uploaded_file($_FILES['vfileToUpload']['tmp_name'],$target_file)){
               // Insert record
               /*$query = "INSERT INTO videos(post_id, video) VALUES('".$last_id."','".$video_name."')";

               mysqli_query($con,$query);
               $_SESSION['message'] = "Upload successfully.";*/
             }
          }

       }else{
          $_SESSION['message'] = "Invalid file extension.";
       }
   }else{
       $_SESSION['message'] = "Please select a file.";
   }
?>