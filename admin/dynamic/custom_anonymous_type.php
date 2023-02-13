<?php  
include 'database.php'; 
$action = $_POST['action'];
	switch($action)
	{
		case 'imageUpload':
		imageUpload();
		break;
		case 'imageRemove':
		imageRemove();
		break;
		case 'addTours':
		addTours();
		break;
		default:
		echo "No Data Available"; 
	} 
	function imageUpload(){
		$uploaded_images = array(); 
		foreach($_FILES['files']['name'] as $key=>$val){ 
			$upload_dir = "../tours_images/";
			$upload_file = $upload_dir.time().$_FILES['files']['name'][$key]; 
			$filename = $_FILES['files']['name'][$key];
			if(move_uploaded_file($_FILES['files']['tmp_name'][$key],$upload_file)){
			$uploaded_images[] = $upload_file; 
			}
		} 
		$output ='<div class="row">
			<div class="gallery">';
			if(!empty($uploaded_images)){
			$i=1;
			foreach($uploaded_images as $image){
		$output.='<div class="pip">
				<div class="content">  
				 <img class="imageThumb" id="img_'.$i.'" src="admin/'.$image.'" alt=""><br/>
				 <span class="remove" id="remove_'.$i.'">Remove</span>
				</div>
			</div>';
			$i++;} }
		$output.='</div>
		</div>';
		echo $output;
	}
	
	function imageRemove(){
		$imgPath = $_POST['imagePath'];
		$removeImg = '../tours_images/'.$imgPath;
		if(file_exists($removeImg)){
			unlink($removeImg);
			$msg = "Image has been deleted successfully";
		}else{
			$msg = "Something want wrong, try again !!";
		}
		echo $msg;
	} 
	
	function addTours(){ 
	   $conn = db ();
		$inclusions_exclusions 	= $_POST['inclusions_exclusions'];
		$title 					= $_POST['title'];
		$description  			= $_POST['description'];
		$price 					= $_POST['price'];
		$tours_code 			= $_POST['tours_code'];
		$place_name 			= $_POST['place_name'];
		//$departure_date 		= $_POST['departure_date'];
		//$arrivel_date 			= $_POST['arrivel_date']; 
		$restrictions 			= $_POST['restrictions'];
		$cancellation_policies 	= $_POST['cancellation_policies']; 
		$itinerary_details 		= $_POST['itinerary_details']; 
		//$imgName 				= $_POST['imgName'];
				/* $getImgName = explode(',',$imgName);
				$count = count($getImgName);
				echo $count;die; */
		 $query = mysqli_query($conn, "INSERT INTO tbl_tours(inc_exc_id, title, description, price, tours_code, place_name, departure_date, arrivel_date ,restrictions, cancellation_policies, itinerary_details,created_date)
				 VALUES ('".$inclusions_exclusions."','".$title."','".$description."','".$price."','".$tours_code."','".$place_name."',now(),now(),'".$restrictions."','".$cancellation_policies."','".$itinerary_details."',now())");
			if($query)
			{
				$last_id = $conn->insert_id; 
				$imgName 				= $_POST['imgName'];
				$getImgName = explode(',',$imgName); 
				foreach($getImgName as $key=>$val)
				{ 
					$imageName = $getImgName[$key];
					$imgQuery = mysqli_query($conn, "INSERT INTO tbl_images(tours_id,image_name,created_date)VALUES('".$last_id."','".$imageName."',now())");
				}
				echo "Data has been added";
			}  
			  
	} 
?>
