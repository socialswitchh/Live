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
		case 'addAnonymousType':
		addAnonymousType();
		break;
		case 'getAnonymousType':
		getAnonymousType();
		break;
		case 'editAnonymousType':
		editAnonymousType();
		break;
		case 'addAnonymous':
		addAnonymous();
		break;
		case 'getAnonymous':
		getAnonymous();
		break;
		case 'editAnonymous':
		editAnonymous();
		break;
		case 'addBadges':
		addBadges();
		break;
		case 'getBadges':
		getBadges();
		break;
		case 'editBadges':
		editBadges();
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
	function addAnonymousType(){ 
	    $conn = db (); 
		$name = $_POST['name']; 
		$date = date('Y-m-d H:i:s');
      //echo "INSERT INTO gt_anonymous_type(name ,created_at)VALUES ('".$name."','".$date."')";die;
		$query = mysqli_query($conn, "INSERT INTO gt_anonymous_type(name ,created_at)VALUES ('".$name."','".$date."')");
		if($query){
			echo "Anonymous Type created successfully.";
		}
	}
	function getAnonymousType(){ 
	    $conn = db (); 
		$id = $_POST['id'];  
		$query = mysqli_query($conn, "SELECT * FROM gt_anonymous_type WHERE id = '".$id."'");
		$row = mysqli_fetch_array($query, MYSQLI_ASSOC); 
		echo json_encode($row);  
	}
	function editAnonymousType(){ 
	    $conn = db (); 
		$id = $_POST['id'];  
		$name = $_POST['name']; 
		$query = mysqli_query($conn, "UPDATE gt_anonymous_type SET name ='".$name."' WHERE id = '".$id."'"); 
		if($query){ 
			echo "Anonymous Type updated successfully."; 
		}		
	} 
	function addAnonymous(){ 
	    $conn = db (); 
		$anonymous_type = $_POST['anonymous_type']; 
		$anonymous_name = $_POST['anonymous_name']; 
		$date = date('Y-m-d H:i:s');
		$query = mysqli_query($conn, "INSERT INTO gt_anonymous_name(anonymous_type_id, anonymous_name, created_at)VALUES ('".$anonymous_type."','".$anonymous_name."','".$date."')"); 
		if($query){
			echo "Anonymous created successfully.";
		}
	}
	function getAnonymous(){ 
	    $conn = db (); 
		$id = $_POST['id'];  
		$query = mysqli_query($conn, "SELECT * FROM gt_anonymous_name WHERE id = '".$id."'");
		$row = mysqli_fetch_array($query, MYSQLI_ASSOC); 
		echo json_encode($row);  
	}
	function editAnonymous(){ 
	    $conn = db (); 
		$id = $_POST['id'];  
		$anonymous_type = $_POST['anonymous_type']; 
		$anonymous_name = $_POST['anonymous_name']; 
		//echo "UPDATE gt_anonymous_name SET anonymous_type_id ='".$anonymous_type."', anonymous_name ='".$anonymous_name."' WHERE id = '".$id."'";die;
		$query = mysqli_query($conn, "UPDATE gt_anonymous_name SET anonymous_type_id ='".$anonymous_type."', anonymous_name ='".$anonymous_name."' WHERE id = '".$id."'"); 
		if($query){ 
			echo "Anonymous updated successfully."; 
		}		
	} 

	function addBadges(){ 
	    $conn = db (); 
	    $image = $_POST['image']; 
		$title = $_POST['title']; 
		$date = date('Y-m-d H:i:s');
		$query = mysqli_query($conn, "INSERT INTO gt_badges(image, title, created_at)VALUES ('".$image."','".$title."','".$date."')"); 
		if($query){
			echo "Badges created successfully.";
		}
	}
	function getBadges(){ 
	    $conn = db (); 
		$id = $_POST['id'];  
		$query = mysqli_query($conn, "SELECT * FROM gt_badges WHERE id = '".$id."'");
		$row = mysqli_fetch_array($query, MYSQLI_ASSOC); 
		echo json_encode($row);  
	}
	function editBadges(){ 
	    $conn = db (); 
		$id = $_POST['id'];  
		$image = $_POST['image']; 
		$title = $_POST['title']; 
		//echo "UPDATE gt_anonymous_name SET anonymous_type_id ='".$anonymous_type."', title ='".$title."' WHERE id = '".$id."'";die;
		$query = mysqli_query($conn, "UPDATE gt_badges SET image ='".$image."', title ='".$title."' WHERE id = '".$id."'"); 
		if($query){ 
			echo "Badges updated successfully."; 
		}		
	} 
	
	 
?>
