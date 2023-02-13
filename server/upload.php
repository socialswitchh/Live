<?php
// Count total files
$countfiles = count($_FILES['fileToUpload']['name']);

// Upload Location
$upload_location = "../post_upload/";

// To store uploaded files path
$files_arr = array();

// Loop all files
for($index = 0;$index < $countfiles;$index++){

   if(isset($_FILES['fileToUpload']['name'][$index]) && $_FILES['fileToUpload']['name'][$index] != ''){
      // File name
      $filename = $_FILES['fileToUpload']['name'][$index];

      // Get extension
      $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

      // Valid image extension
      $valid_ext = array("png","jpeg","jpg");

      // Check extension
      if(in_array($ext, $valid_ext)){

         // File path
         $path = $upload_location.$filename;

         // Upload file
         if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'][$index],$path)){
            //$files_arr[] = $path;
            echo $filename;
         }
      }
   }
}

//echo json_encode($files_arr);
//die;