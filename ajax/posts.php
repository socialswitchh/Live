<?php  
/*  print_r($_POST);
echo "<br>";*/   
print_r($_FILES['files']['name']); 
session_start();  
include_once('../config.php'); 
    $id 	 = $_SESSION['id'];  
	$header  = $_POST['header']; 
	$content = $_POST['content'];   
	$diary = 'Yes';  
	$current_date = date('Y-m-d H:i:s');  
	if($_FILES['files']['name']!=''){
		$type = 'image';
	}
	if($_FILES['video']['name']!=''){
		$type = 'video';
	}
	$sql = "INSERT INTO gt_posts(user_id, title, description, is_diary, post_type, created_at)VALUES('$id', '$header', '$content', '$diary', '$type', '$current_date')";  
	$result = $conn->query($sql); 
	$last_id = mysqli_insert_id($conn);

 if($last_id)
 { 
 	/* Video Upload code*/
	//$maxsize = 5242880; // 5MB
   	//if(isset($_FILES['video']['name']) && $_FILES['video']['name'] != ''){
       $video_name = $_FILES['video']['name'];
       $target_dir = "../server/videos/";
       $target_file = $target_dir . $_FILES["video"]["name"];  
       $extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); 
       $extensions_arr = array("mp4","avi","3gp","mov","mpeg");  
       if( in_array($extension,$extensions_arr) ){   
	            if(move_uploaded_file($_FILES['video']['tmp_name'],$target_file)){ 
	               $query = "INSERT INTO post_image_video(post_id, image_video, created_at, type) VALUES('".$last_id."','".$video_name."', '$current_date', 'video')"; 
	               mysqli_query($conn, $query);
	               $_SESSION['message'] = "Upload successfully.";
	            } 
       	}else{
          $_SESSION['message'] = "Invalid file extension.";
       }
    
   /*}else{
       $_SESSION['message'] = "Please select a file.";
   }*/
	/* Video Upload end */
 	 
		include_once("ak_php_img_lib_1.0.php");
		for ($i = 0; $i < count($_FILES["files"]["name"]); $i++) {
		if($_FILES["files"]["name"][$i]!=''){ 
			$org_fileName = $_FILES["files"]["name"][$i];
			$exp_fileName = explode(".", $org_fileName); 
			$fname = $exp_fileName['0'];
			$fextn = $exp_fileName['1'];
			$fileName = $fname.'.'.strtolower($fextn);

		}else{
			$fileName = 'nofile.jpg';
		}
		
		$fileTmpLoc = $_FILES["files"]["tmp_name"][$i];
		$fileType = $_FILES["files"]["type"][$i];
		$fileSize = $_FILES["files"]["size"][$i];
		$fileErrorMsg = $_FILES["files"]["error"][$i];
		$maxsize = 50 * 1024 * 1024;
		$kaboom = explode(".", $fileName);
		//$parent_sku = substr($kaboom[0], 0, -2);
		//print_r($parent_sku);die;
		$fileExt = end($kaboom); 
		if($fileSize > $maxsize) {
			echo "ERROR: Your file was larger than 5 Megabytes in size.";
			unlink($fileTmpLoc);
			//exit();
		} else if (!preg_match("/.(gif|jpg|png)$/i", $fileName) ) {
			 echo "ERROR: Your image was not .gif, .jpg, or .png.";
			 unlink($fileTmpLoc);
			// exit();
		} else if ($fileErrorMsg == 1) {
			echo "ERROR: An error occured while processing the file. Try again.";
			//exit();
		}
		$moveResult = move_uploaded_file($fileTmpLoc, "../server/uploads/$fileName"); 
		image_fix_orientation("../server/uploads/$fileName"); 
			if ($moveResult != true) {
				echo "ERROR: File not uploaded. Try again.";
				unlink($fileTmpLoc);
				//exit();
			} 
		@unlink($fileTmpLoc); 
		$target_file = "../server/uploads/$fileName";
		$resized_file = "../server/uploads/thumb200/$fileName";
		$wmax = 200;
		$hmax = 150;
		ak_img_resize($target_file, $resized_file, $wmax, $hmax, $fileExt);
		
		$resized_fileThumb = "../server/uploads/thumb/$fileName";
		$wmax = 50;
		$hmax = 45; 
		
		ak_img_resize($target_file, $resized_fileThumb, $wmax, $hmax, $fileExt);

		$sql1 = "INSERT INTO post_image_video(post_id, image_video, created_at, type)VALUES('$last_id', '".$fileName."', '$current_date', 'image')";  
				$conn->query($sql1); 


	}
	 
 	


	exit();
}  

?>