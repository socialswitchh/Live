<?php  
include_once('../config.php');   
 
				$sql = mysqli_query($conn, "SELECT * FROM gt_anonymous_name WHERE anonymous_type_id = '".$_POST['id']."'"); 
				while ($rows=$sql->fetch_assoc()) {  
		$output='<div class="cat comedy">  
				<label>  
				    <input type="checkbox" class="anonymous_checkbox" id="anonymous_name" name="anonymous_name[]" value="'.$rows["id"].'"  aria-label="anonymous_name" aria-describedby="basic-addon1">
				    <span>'.$rows["anonymous_name"].'</span> 
				</label>  
			</div>'; 
			echo $output;
			}

 
	