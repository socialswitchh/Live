 <?php

    $sql = mysqli_query($conn, "SELECT * from gt_users where id='" . $dummy_row['id'] . "'");
    $row = mysqli_fetch_array($sql);
    $anonymous_id = $row['anonymous'];
    $badges_id = $row['badges'];
    //echo  "SELECT title from gt_badges where id='".$badges_id."'";
    $b_sql = mysqli_query($conn, "SELECT title from gt_badges where id='" . $badges_id . "'");
    $b_row = mysqli_fetch_array($b_sql);
    $badges_title = $b_row['title'];

    $sql_photo = "SELECT * FROM users_photo WHERE user_id = '" . $main_row['id'] . "' AND type='main' ORDER BY id DESC LIMIT 1";
    $query_retrived_photo = mysqli_query($conn, $sql_photo) or die("Error:" . mysqli_error($conn));
    $row_photo = mysqli_fetch_assoc($query_retrived_photo);
    $result_photo = mysqli_num_rows($query_retrived_photo);


    $sql_dummy_photo = "SELECT * FROM users_photo WHERE user_id = '" . $dummy_row['id'] . "' AND type='dummy' ORDER BY id DESC LIMIT 1";
    $query_retrived_dummy_photo = mysqli_query($conn, $sql_dummy_photo) or die("Error:" . mysqli_error($conn));
    $row_dummy_photo = mysqli_fetch_assoc($query_retrived_dummy_photo);
    $result_dummy_photo = mysqli_num_rows($query_retrived_dummy_photo);


    ?>
 <div class="column is-3 is-hidden-mobile">

     <!-- Latest activities widget -->
     <!-- /partials/widgets/latest-activity-1-widget.html -->
     <div id="latest-activity-1" class="card">
         <div class="card-heading is-bordered">
             <h4>Profiles</h4>
             <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                 <div>
                     <div class="button">
                         <i data-feather="more-vertical"></i>
                     </div>
                 </div>
                 <div class="dropdown-menu" role="menu">
                     <div class="dropdown-content">
                         <a href="#" class="dropdown-item">
                             <div class="media">
                                 <i data-feather="list"></i>
                                 <div class="media-content">
                                     <h3>All updates</h3>
                                     <small>View my network's activity.</small>
                                 </div>
                             </div>
                         </a>
                         <a class="dropdown-item">
                             <div class="media">
                                 <i data-feather="settings"></i>
                                 <div class="media-content">
                                     <h3>Settings</h3>
                                     <small>Access widget settings.</small>
                                 </div>
                             </div>
                         </a>
                         <hr class="dropdown-divider">
                         <a href="#" class="dropdown-item">
                             <div class="media">
                                 <i data-feather="trash-2"></i>
                                 <div class="media-content">
                                     <h3>Remove</h3>
                                     <small>Removes this widget from your feed.</small>
                                 </div>
                             </div>
                         </a>
                     </div>
                 </div>
             </div>
         </div>
         <div class="card-body no-padding">
             <!-- Recommended Page -->
             <div class="page-block">
                 <?php
                    if ($row_photo['photo'] != "" && $row_photo['status'] == 0) { ?>
                     <img class="ml-2" src="<?php echo $row_photo['photo'] ?>" data-demo-src="assets/img/avatars/jenna.png" alt="">
                 <?php } else { ?>
                     <img class="mr-2" src="./upload/user/male.jpeg" alt="">
                 <?php } ?>
                 <div class="story-meta">
                     <a href="main_profile.php">
                        <span class="span-title d-flex-star" style="font-size: .85rem;color: #393a4f;font-weight: 500;">
                            <?php echo $main_row['fname'] . ' ' . $main_row['lname'] ?>
                        </span>
                    </a>
                     <span class="story-meta">
                        <?php echo $main_row['unique_name']; ?>
                    </span>
                 </div>
                 <div class="add-page">
                     <a href="main_profile.php"><i data-feather="eye"></i></a>
                 </div>
             </div>

             <!-- Recommended Page -->
             <div class="page-block">
                 <?php
                    if ($row_dummy_photo['photo'] != "" && $row_dummy_photo['status'] == 0) { ?>
                     <img class="ml-2" src="<?php echo $row_dummy_photo['photo'] ?>" data-demo-src="assets/img/avatars/jenna.png" alt="">
                 <?php } else { ?>
                     <img class="mr-2" src="./upload/user/male.jpeg" alt="">
                 <?php } ?>
                 <div class="story-meta">
                     <a href="dummy_profile.php">
                        <span class="span-title d-flex-star">
                            <span style="font-size: .85rem;color: #393a4f;font-weight: 500;"><?php echo $dummy_row['fname']; ?></span>
                            <span class="rating_star-m">
                                <span class="star-textm">
                                    <?php  echo  getProfileRating($conn, $dummy_row['id']);?>/5
                                    <label class="star-checked">★</label>
                                </span>
                            </span>
                        </span>    
                    </a> 
                     <?php

                        $sql1 = mysqli_query($conn, "SELECT anonymous_name from gt_anonymous_name where id in (" . $anonymous_id . ")");

                        while ($row1 = @mysqli_fetch_array($sql1)) {

                        ?>

                         <a href="dummy_profile.php">
                            <span class="story-meta"><?php echo $row1['anonymous_name']; ?></span></a>

                     <?php } ?>
                 </div>
                 <div class="add-page">
                     <a href="dummy_profile.php"><i data-feather="eye"></i></a>
                 </div>
             </div>
         </div>
     </div>


     <!-- Suggested friends Dummy account widget -->
     <!-- /partials/widgets/suggested-friends-1-widget.html -->
     <div class="card">
         <div class="card-heading is-bordered">
             <h4>Suggested Friends by Profession</h4>
             <div class="dropdown is-spaced is-right dropdown-trigger">
                 <div>
                     <div class="button">
                         <i data-feather="more-vertical"></i>
                     </div>
                 </div>
                 <div class="dropdown-menu" role="menu">
                     <div class="dropdown-content">
                         <a href="#" class="dropdown-item">
                             <div class="media">
                                 <i data-feather="users"></i>
                                 <div class="media-content">
                                     <h3>All Suggestions</h3>
                                     <small>View all friend suggestions.</small>
                                 </div>
                             </div>
                         </a>
                         <a class="dropdown-item">
                             <div class="media">
                                 <i data-feather="settings"></i>
                                 <div class="media-content">
                                     <h3>Settings</h3>
                                     <small>Access widget settings.</small>
                                 </div>
                             </div>
                         </a>
                         <hr class="dropdown-divider">
                         <a href="#" class="dropdown-item">
                             <div class="media">
                                 <i data-feather="trash-2"></i>
                                 <div class="media-content">
                                     <h3>Remove</h3>
                                     <small>Removes this widget from your feed.</small>
                                 </div>
                             </div>
                         </a>
                     </div>
                 </div>
             </div>
         </div>
         <div class="card-body no-padding">
             <!-- Suggested friend -->
             <?php   
                $anon_id = explode(',',$dummy_row['anonymous']); 
                $sql = "SELECT * FROM gt_users WHERE id NOT IN('" . $dummy_row['id'] . "') and  (FIND_IN_SET('" . $anon_id[0]. "', anonymous) != 0 OR FIND_IN_SET('" . $anon_id[1]. "', anonymous) != 0 OR FIND_IN_SET('" . $anon_id[2]. "', anonymous) != 0)";
                $result = $conn->query($sql); 
                $num_row = @mysqli_num_rows($result);
                if ($num_row > 0) {
                    while ($row = $result->fetch_assoc()) { 
                       // print_r($row);
                        $sql1 = "SELECT * FROM gt_friend_request WHERE request_from_id = '" . $dummy_row['id'] . "' and request_to_id ='" . $row["id"] . "'";
                    
                    $result1 = mysqli_query($conn, $sql1) or die("Error:" . mysqli_error($conn));
                    $row1 = mysqli_fetch_assoc($result1); 
                   // print_r( $row1);
                    $sql_photo = "SELECT * FROM users_photo WHERE user_id = '" . $row_suggestion_follow["id"] . "' ORDER BY id DESC LIMIT 1"; 
                    $query_retrived_photo = mysqli_query($conn, $sql_photo) or die("Error:" . mysqli_error($conn));
                    $row_photo = mysqli_fetch_assoc($query_retrived_photo);
                    $result_photo = mysqli_num_rows($query_retrived_photo); 
                    if ($result_photo > 0){
                         $comment_photo = $row_photo['photo'];   
                    } else {
                        $comment_photo = './upload/user/male.jpeg';
                    }
                    
                     if ($row["id"] == $row1['request_to_id']) {
                        $button = '<div class="checkmark-wrapper">
                                                <svg class="checkmark is-xs" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                                                    <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"></circle>
                                                    <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"></path>
                                                </svg>
                                            </div>';
                    } else { 
                        $button = '<div class="add-friend add-transition sending_follow_request" data-userid="' . $row['id'] . '" data-from="' . $dummy_row['id'] . '" data-fullname="' . $dummy_row['fname'] . '"> 
                                                <i data-feather="user-plus"></i> 
                                            </div>';
                    }
                     if ($row["id"] != $row1['request_to_id']) {
                        
            ?> 
                 <a href="#">
                     <div class="add-friend-block user-profile-cus transition-block">
                          
                             <img src="<?php echo $comment_photo ?>" data-demo-src="assets/img/avatars/nelly.png" data-user-popover="9" alt="">
                         
                         <a class="" href="dummy_user_profile.php?id=<?php echo  $row['id']; ?>">
                            <div class="story-meta">
                             <span class="span-title d-flex-star">
                                <span style="font-size: .85rem;color: #393a4f;font-weight: 500;"><?php echo $row['fname'] ?></span>
                                <span class="rating_star-m">
                                    <span class="star-textm">
                                        <?php  echo  getProfileRating($conn, $row['id']);?>/5
                                        \<label class="star-checked">★</label>
                                    </span>
                                </span>
                            </span>   
                             <span class="interest-span">
                                 <?php
                                    $sql_1 = mysqli_query($conn, "SELECT anonymous from gt_users where id='" . $row['id'] . "'");
                                    $row_1 = mysqli_fetch_array($sql_1);
                                    $anonymous_id_1 = $row_1['anonymous'];
                                    $sql1_1 = mysqli_query($conn, "SELECT anonymous_name from gt_anonymous_name where id in (" . $anonymous_id_1 . ")");
                                    while ($row1_1 = @mysqli_fetch_array($sql1_1)) {
                                    ?>
                                     <span><?php echo $row1_1['anonymous_name']; ?></span>
                                 <?php } ?>
                             </span>
                         </div></a>
                         <?php echo $button; ?>
                     </div>
                 </a>
             <?php }}}?>


         </div>
     </div>
 </div>

 <style>
     span {
         font-size: .8rem;
         color: #757a91;
     }

     .span-title {
         font-size: .85rem;
         color: #393a4f;
         font-weight: 500;
     }
 </style>
 <script>
     $(document).ready(function() {
         $(document).on('click', '.sending_follow_request', function(e) {  
		        var to_id = $(this).data("userid"); 
		        var from_id = $(this).data("from");  
		        var fullname = $(this).data("fullname");
		        var privacy = $(this).data("privacy");   
			        $.ajax({
			            url: 'ajax/send_follow_request_main.php',
			            type: 'POST', 
			            data:{ to_id:to_id, from_id:from_id, fullname:fullname, privacy:privacy},
			            success: function(response) { 
			            
			        }  
		    	});
        	}); 
        	
        $(document).on('click', '.sending_follow_request_mobile', function(e) {  
		        var to_id = $(this).data("userid"); 
		        var from_id = $(this).data("from");  
		        var fullname = $(this).data("fullname");
		        var privacy = $(this).data("privacy"); 
		        var sended = $( this ).hasClass( "following" );
			        $.ajax({
			            url: 'ajax/send_follow_request_main.php',
			            type: 'POST', 
			            data:{ to_id:to_id, from_id:from_id, fullname:fullname, privacy:privacy},
			            success: function(response) { 
			            $(this).closest('.item').hide();
			        }  
		    	});
        	}); 
     });
 </script>