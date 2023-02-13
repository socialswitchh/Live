<?php  
session_start(); 
include_once('../config.php'); 
$to_id = @$_POST['id'];
echo $to_id;
//$sql = "SELECT * FROM `gt_chatt` WHERE `from_id`='".$_SESSION['id']."' AND `to_id`='".$to_id."'";
$sql = "SELECT * FROM `gt_chatt` WHERE `from_id`='".$_SESSION['id']."'";  
    if($result = mysqli_query($conn, $sql)){ 
		 
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {   
	?>
		<div class="container_chat">
                  <img src="assets/images/avatars/avatar-4.jpg" alt="Avatar">
                  <p ><?php echo $row['message'];?></p>
                  <span class="time-right">11:00</span>
                </div>

<?php }  } ?>
  