<?php 

session_start(); 

include_once('../config.php');

    $id = $_SESSION['id']; 

	$filetype = array('jpeg','jpg','png','gif','PNG','JPEG','JPG');  

		$name =time().$_FILES['upp_file']['name'];

		$path='./upload/user/'.$name;

		$file_ext =  pathinfo($name, PATHINFO_EXTENSION);

		if(in_array(strtolower($file_ext), $filetype)){ 

			if($_FILES['upp_file']['size'] < 10000000){ 

				$uploadimg = @move_uploaded_file($_FILES['upp_file']['tmp_name'],'../upload/user/'.$name);

				if($uploadimg){ 
					//echo "UPDATE users_details SET user_photo = '$path' WHERE id = '$id'";die;
					$date = date("Y-m-d H:i:s");
					$sql =  "INSERT INTO users_photo (user_id, photo, type, created_at) VALUES ('".$id."', '".$path."', 'main', '".$date."')"; 

					$result = $conn->query($sql); 

					if(isset($result)){

						$conn->close();

						echo "Profile pic changed.";

					}

				else {

					$conn->close(); 

				} 

				} 

			}else {

			   echo "FILE_SIZE_ERROR";

			}

		} else{

			echo "FILE_TYPE_ERROR";

		} 

	  

?>