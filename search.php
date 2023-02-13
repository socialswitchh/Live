 <?php
    include('header.php');
    if (empty($_SESSION['is_login'])) {
        header("Location: https://switchh.in/");
        die();
    }
    ?>

 <div class="nain-div">
     <div class="switch-main switch-main-search" style="margin-top: 75px;">
         <ul uk-tab class="head-switch">
             <li><a href="#">Post</a></li>
             <li><a href="#">Users</a></li>
         </ul>

         <ul class="uk-switcher w-100 uk-margin">
             <section>
                 <div class="card is-post">
                     <?php
                        $key_search = trim($_GET['search_data']);
                        $sql_get_followers = mysqli_query($conn, "SELECT request_from_id, request_to_id FROM gt_friend_request WHERE request_from_id='" . $_SESSION['id'] . "' AND request_status='Accept'");
                        while ($row_followers = $sql_get_followers->fetch_assoc()) {
                            $res_followers_id[] = $row_followers['request_to_id'];
                        }
                        $sql_get_followers1 = mysqli_query($conn, "SELECT request_from_id, request_to_id FROM gt_friend_request WHERE request_from_id='" . $main_row['id'] . "' AND request_status='Accept'");
                        while ($row_followers1 = $sql_get_followers1->fetch_assoc()) {
                            $res_followers_id[] = $row_followers1['request_to_id'];
                        }
                        if (@$res_followers_id[0] == "") {
                            $allid = $_SESSION['id'] . ',' . $main_row['id'];
                        } else {
                            $ids = implode(',', $res_followers_id);
                            $allid = $ids . ',' . $_SESSION['id'] . ',' . $main_row['id'];
                        }
                        $i = 1;


                        $query = @mysqli_query($conn, "SELECT * FROM gt_posts WHERE title LIKE '%$key_search%' ORDER BY id DESC");
                        while ($row = $query->fetch_assoc()) {
                            $get_user_query = mysqli_query($conn, "SELECT * FROM gt_users WHERE id ='" . $row['user_id'] . "'");
                            while ($row_user_query = $get_user_query->fetch_assoc()) {
                                $queryR = "SELECT p.*, COUNT(r.rating_number) as rating_num, FORMAT((SUM(r.rating_number) / COUNT(r.rating_number)),1) as average_rating, COUNT(r.user_id) as total_user FROM gt_posts as p LEFT JOIN rating as r ON r.post_id = p.id WHERE p.id = '" . $row['id'] . "' GROUP BY (r.post_id)";
                                // echo  $queryR;
                                $resultR = $conn->query($queryR);
                                $postData = $resultR->fetch_assoc();

                                $badgesId = $row_user_query['badges'];
                                $bsql = mysqli_query($conn, "SELECT title from gt_badges where id='" . $badgesId . "'");
                                $brow = mysqli_fetch_array($bsql);

                                $sql_photo = "SELECT * FROM users_photo WHERE user_id = '" . $row_user_query["id"] . "' ORDER BY id DESC LIMIT 1"; 
                                $query_retrived_photo = mysqli_query($conn, $sql_photo) or die("Error:" . mysqli_error($conn));
                                $row_photo = mysqli_fetch_assoc($query_retrived_photo);
                                $result_photo = mysqli_num_rows($query_retrived_photo); 
                                if ($result_photo > 0){
                                     $user_photo = $row_photo['photo'];   
                                } else {
                                    $user_photo = './upload/user/male.jpeg';
                                } 


                        ?>

                             <div class="content-wrap">
                                 <div class="card-heading">
                                     <div class="user-block">
                                        <div class="image"> 
                                            <img src="<?php echo $user_photo; ?>" class="avatar-image" data-demo-src="assets/img/avatars/edward.jpeg" data-user-popover="5" alt=""> 
                                        </div>
                                        <?php if($row_user_query['dummy_id']== 0){?>
                                        <div class="user-info">
                                             <div style="display: flex;">
                                                 <a href="main_user_profile.php?id=<?php echo $row_user_query['id']; ?>"><?php echo $row_user_query['fname'] . ' ' . $row_user_query['lname']; ?></a>
                                             </div>
                                             <div style="display: flex;"> 
                                                     <span class="time has-text-weight-medium"><?php echo $row_user_query['unique_name']; ?></span> 
                                             </div>
                                        </div>
                                        <?php } else { ?>
                                        <div class="user-info">
                                             <div style="display: flex;">
                                                 <a href="dummy_user_profile.php?id=<?php echo $row_user_query['id']; ?>"><?php echo $row_user_query['fname']; ?>  <?php  echo  getProfileRating($conn, $row_user_query['id']);?>/5</a>
                                             </div>
                                             <div style="display: flex;">
                                                <?php
                                                    $sql_1 = mysqli_query($conn, "SELECT anonymous from gt_users where id='" . $row_user_query['id'] . "'");
                                                    $row_1 = mysqli_fetch_array($sql_1);
                                                    $anonymous_id_1 = $row_1['anonymous'];
                                                    $sql1_1 = mysqli_query($conn, "SELECT anonymous_name from gt_anonymous_name where id in (" . $anonymous_id_1 . ")");
                                                    while ($row1_1 = @mysqli_fetch_array($sql1_1)) {
                                                ?>
                                                     <span class="time has-text-weight-medium"><?php echo $row1_1['anonymous_name'].'&nbsp;'; ?></span> 
                                                <?php } ?>
                                             </div>
                                        </div>
                                        <?php } ?>
                                        
                                     </div>
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
                                                         <i data-feather="bookmark"></i>
                                                         <div class="media-content">
                                                             <h3>Bookmark</h3>
                                                             <small>Add this post to your bookmarks.</small>
                                                         </div>
                                                     </div>
                                                 </a>
                                                 <a class="dropdown-item">
                                                     <div class="media">
                                                         <i data-feather="bell"></i>
                                                         <div class="media-content">
                                                             <h3>Notify me</h3>
                                                             <small>Send me the updates.</small>
                                                         </div>
                                                     </div>
                                                 </a>
                                                 <hr class="dropdown-divider">
                                                 <a href="#" class="dropdown-item">
                                                     <div class="media">
                                                         <i data-feather="flag"></i>
                                                         <div class="media-content">
                                                             <h3>Flag</h3>
                                                             <small>In case of inappropriate content.</small>
                                                         </div>
                                                     </div>
                                                 </a>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="card-body">
                                     <div class="post-text">
                                         <span class="span-title"><?php echo $row['title'] ?></span>
                                         <p><?php echo $row['description'] ?>
                                         <p>
                                     </div>

                                     <?php if ($row['post_type'] == 'video') { ?>
                                         <div class="link-image">
                                             <div class="video-overlay"></div>
                                             <?php
                                                $sqlv = mysqli_query($conn, "SELECT * from post_image_video where post_id ='" . $row['id'] . "'");
                                                while ($row_v = @mysqli_fetch_array($sqlv)) { ?>
                                                 <a class="video-button" data-fancybox href="server/videos/<?php echo $row_v['image_video']; ?>">
                                                     <img src="assets/img/icons/video/play.svg" alt="">
                                                 </a>
                                             <?php } ?>
                                         </div>
                                     <?php } ?>
                                     <?php if ($row['post_type'] == 'image') { ?>
                                         <div class="masonry-column-left" style="display:flex; flex-wrap:wrap; justify-content:space-between;">
                                             <?php
                                                $sql_img = mysqli_query($conn, "SELECT * from post_image_video where post_id ='" . $row['id'] . "'");
                                                while ($row_i = @mysqli_fetch_array($sql_img)) {
                                                    if (file_exists('server/uploads/thumb200/' . $row_i['image_video'])) {
                                                ?>
                                                     <a data-fancybox="post3" data-lightbox-type="comments" data-thumb="assets/img/demo/unsplash/3.jpg" href="server/uploads/<?php echo $row_i['image_video']; ?>" data-demo-href="assets/img/demo/unsplash/3.jpg">
                                                         <img width="180" height="180" class="m-1" src="server/uploads/thumb200/<?php echo $row_i['image_video']; ?>" data-demo-src="assets/img/demo/unsplash/3.jpg" alt="">
                                                     </a>
                                             <?php }
                                                } ?>
                                         </div>
                                     <?php } ?>

                                     <div class="likers-text">
                                         <?php
                                            if ($postData['user_id'] == $_SESSION['id'] || $postData['user_id'] == $dummy_row['id']) {  ?>
                                             <div class="star-rating">
                                             <?php } else { ?>
                                                 <div class="star-rating cls_rating">
                                                     <div class="comment-stars-input" data-ruser_id="<?php echo $postData['user_id'] ?>"></div>
                                                 <?php  } ?>

                                                 <input class="" type="radio" name="rating" value="5" id="5-stars<?php echo $postData['id'] ?>" data-postid="<?php echo $postData['id'] ?>" <?php echo ($postData['average_rating'] == 5) ? 'checked="checked"' : ''; ?>>
                                                 <label for="5-stars<?php echo $postData['id'] ?>" class="star">&#9733;</label>

                                                 <input class="" type="radio" name="rating" value="4" id="4-stars<?php echo $postData['id'] ?>" data-postid="<?php echo $postData['id'] ?>" <?php echo ($postData['average_rating'] == 4) ? 'checked="checked"' : ''; ?>>
                                                 <label for="4-stars<?php echo $postData['id'] ?>" class="star">&#9733;</label>

                                                 <input class="" type="radio" name="rating" value="3" id="3-stars<?php echo $postData['id'] ?>" data-postid="<?php echo $postData['id'] ?>" <?php echo ($postData['average_rating'] == 3) ? 'checked="checked"' : ''; ?>>
                                                 <label for="3-stars<?php echo $postData['id'] ?>" class="star">&#9733;</label>

                                                 <input class="" type="radio" name="rating" value="2" id="2-stars<?php echo $postData['id'] ?>" data-postid="<?php echo $postData['id'] ?>" <?php echo ($postData['average_rating'] == 2) ? 'checked="checked"' : ''; ?>>
                                                 <label for="2-stars<?php echo $postData['id'] ?>" class="star">&#9733;</label>

                                                 <input class="" type="radio" name="rating" value="1" id="1-star<?php echo $postData['id'] ?>" data-postid="<?php echo $postData['id'] ?>" <?php echo ($postData['average_rating'] == 1) ? 'checked="checked"' : ''; ?>>
                                                 <label for="1-star<?php echo $postData['id'] ?>" class="star">&#9733;</label>

                                                 </div>
                                                 
                                                <div class="rating_box" uk-toggle="target: #create-post-modal_rating">
                                                    <div class="average_rating_show" style="display: none;"></div>
                                                    <h3 class="average_rating_hide"><?php  echo  getProfileRating($conn, $postData['user_id']);?>/5 </h3>
                                                    <small><?php echo $postData['total_user']; ?></small>
                                                </div> 
                                             </div>

                                     </div>
                                     <hr>


                             <?php }
                        } ?>
                                 </div>
             </section>
             <li>
                 <section>
                     <div class="card">
                         <div class="card-body" style="padding: 10px 20px; border:none;">
                             <!-- Suggested friend -->
                             <?php
                                $key_search = trim($_GET['search_data']);
                                $sql = "SELECT *  FROM `gt_users` WHERE CONCAT(fname,' ',lname) LIKE '%$key_search%' AND id NOT IN('" . $_SESSION['id'] . "', '" . $dummy_row['id'] . "') ORDER BY id DESC";
                                $result = $conn->query($sql);
                                $num_row = mysqli_num_rows($result);
                                if ($num_row > 0) {
                                    @$search_row = '';
                                    @$search_recent_id = '';
                                    while ($row = $result->fetch_assoc()) {
                                        @$search_row = $row['id'];
                                        @$search_recent_id = $row['recent_search'];

                                        $sql_badges = mysqli_query($conn, "SELECT * from gt_badges where id='" . $row["badges"] . "'");
                                        $row_badges = mysqli_fetch_array($sql_badges);
                                        $badges_name = $row_badges['title'];

                                        $sql_dummy_badges = mysqli_query($conn, "SELECT * from gt_badges where id='" . $dummy_row["badges"] . "'");
                                        $row_dummy_badges = mysqli_fetch_array($sql_dummy_badges);
                                        $badges_dummy_name = $row_dummy_badges['title'];
                                        
                                        $sql_photo = "SELECT * FROM users_photo WHERE user_id = '" . $row["id"] . "' ORDER BY id DESC LIMIT 1"; 
                                        $query_retrived_photo = mysqli_query($conn, $sql_photo) or die("Error:" . mysqli_error($conn));
                                        $row_photo = mysqli_fetch_assoc($query_retrived_photo);
                                        $result_photo = mysqli_num_rows($query_retrived_photo); 
                                        if ($result_photo > 0){
                                             $user_photo = $row_photo['photo'];   
                                        } else {
                                            $user_photo = './upload/user/male.jpeg';
                                        } 


                                ?>
                                     <div class="add-friend-block transition-block"> 
                                             <img src="<?php echo $user_photo; ?>" alt=""> 
                                         <div class="page-meta flex-center flex-sm-column" style="margin-top: 0 !important;">
                                             <?php if ($row['dummy_id'] == 0) { ?>
                                                 <input type="hidden" class="main_to_id" value="<?php echo $row['id'] ?>">
                                                 <span>
                                                    <a class="span-title" href="main_user_profile.php?id=<?php echo $row['id']; ?>" class="text-lg font-semibold"> <?php echo $row['fname'] . ' ' . $row['lname']; ?></a>
                                                </span>
                                                <span class="story-meta"><?php echo $row['unique_name'];?></span>
                                                <?php } else { ?>
                                                    <input type="hidden" class="dummy_to_id" value="<?php echo $row['id'] ?>">
                                                    <span class="rating_star" style="align-items:center;">
                                                        <a class="span-title" href="dummy_user_profile.php?id=<?php echo $row['id']; ?>" class="text-lg font-semibold"> <?php echo $row['fname']; ?></a>
                                                        <span class="star-text">
                                                            <?php  echo  getProfileRating($conn, $row_user_query['id']);?>/5
                                                            <label class="star-checked">★</label>
                                                        </span>
                                                    </span>
                                                    
                                                    <?php
                                    $sql_1 = mysqli_query($conn, "SELECT anonymous from gt_users where id='" . $row['id'] . "'");
                                    $row_1 = mysqli_fetch_array($sql_1);
                                    $anonymous_id_1 = $row_1['anonymous'];
                                    $sql1_1 = mysqli_query($conn, "SELECT anonymous_name from gt_anonymous_name where id in (" . $anonymous_id_1 . ")");
                                    while ($row1_1 = @mysqli_fetch_array($sql1_1)) {
                                    ?>
                                     <span class="story-meta"><?php echo $row1_1['anonymous_name']; ?></span>
                                 <?php } ?>
                                                    
                                                 
                                             <?php } ?>
                                             <!-- <span>Melbourne</span> -->
                                         </div>
                                         <?php
                                            $sql1 = "SELECT * FROM gt_friend_request WHERE request_to_id = '" . $row["id"] . "' and request_from_id='" . $_SESSION['id'] . "'";
                                            $result1 = $conn->query($sql1);
                                            $row1 = $result1->fetch_assoc();
                                            $sql2 = "SELECT * FROM gt_friend_request WHERE request_to_id = '" . $row["id"] . "' and request_from_id='" . $dummy_row['id'] . "'";
                                            $result2 = $conn->query($sql2);
                                            $row2 = $result2->fetch_assoc();


                                            ?>
                                         <?php
                                            if (@$row1['request_status'] == 'Accept' or @$row2['request_status'] == 'Accept') {
                                            ?>
                                             <div class="add-friend add-transition">
                                                 <div class="checkmark-wrapper">
                                                     <svg class="checkmark is-xs" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                                                         <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"></circle>
                                                         <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"></path>
                                                     </svg>
                                                 </div>
                                             </div>

                                         <?php } else if (@$row1['request_to_id'] == @$row['id'] or @$row2['request_to_id'] == @$row['id']) { ?>
                                             <?php if ($row['dummy_id'] == 0) { ?>
                                                 <input type="hidden" class="cancle_main_to_id" value="<?php echo $row['id'] ?>">
                                                 <div class="add-friend add-transition cancle_request_main">
                                                     <i data-feather="user-plus"></i>
                                                 </div>
                                             <?php } else { ?>
                                                 <input type="hidden" class="cancle_dummy_to_id" value="<?php echo $row['id'] ?>">
                                                 <div class="add-friend add-transition cancle_request_dummy">
                                                     <i data-feather="user-plus"></i>
                                                 </div>
                                             <?php } ?>

                                         <?php } else { ?>
                                             <?php if ($row['dummy_id'] == 0) { ?>
                                                 <div class="add-friend add-transition sending_follow_request" data-toggle="modal" data-userid="<?php echo $row["id"] ?>" data-privacy="<?php echo $row["is_privacy"] ?>" data-from="<?php echo $_SESSION['id']; ?>" data-fullname="<?php echo $row['fname'] . ' ' . $row['lname']; ?>">
                                                     <i data-feather="user-plus"></i>
                                                 </div>

                                             <?php } else { ?>
                                                 <div class="add-friend add-transition sending_follow_request" data-toggle="modal" data-userid="<?php echo $row["id"] ?>" data-from="<?php echo $dummy_row['id']; ?>" data-fullname="<?php echo $badges_dummy_name . ' ' . $row['lname']; ?>">
                                                     <i data-feather="user-plus"></i>
                                                 </div>

                                         <?php }
                                            } ?>
                                     </div>

                                 <?php }
                                } else { ?>


                                 <div class="flex items-center space-x-4 border-b">

                                     <div class="flex-1  pb-3">

                                         <a href="#" class="text-lg font-semibold">No Friends Found</a>

                                     </div>

                                 </div>
                             <?php } ?>




                             <!-- Suggested friend -->

                         </div>
                     </div>
                 </section>
             </li>
         </ul>
     </div>
 </div>

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
     });

     //Rating js
     $('.cls_rating').on('click', "input", function() {
         var postID = $(this).attr('data-postid'); 
         var ratingNum = $(this).val();
         var user_id = $(this).closest(".cls_rating").find(".comment-stars-input").attr('data-ruser_id');
         // alert(user_id);
         console.log($(this).val());
         $.ajax({
             type: 'POST',
             url: 'ajax/rating.php',
             data: 'user_id=' + user_id + '&postID=' + postID + '&ratingNum=' + ratingNum,
             dataType: 'json',
             success: function(resp) {
                 if (resp.status == 1) {
                     $('.average_rating_hide').hide();
                     $('.average_rating_show').show();
                     $('.average_rating_show').text(resp.data.average_rating + '/5');
                     $('#totalrat').text(resp.data.rating_num);
                 } else if (resp.status == 2) {
                     $('.average_rating_hide').hide();
                     $('.average_rating_show').show();
                     $('.average_rating_show').text(resp.data.average_rating + '/5');
                     $('#totalrat').text(resp.data.rating_num);
                 }
                 $(".cls_rating input").each(function() {
                     if ($(this).val() <= parseInt(resp.data.average_rating)) {
                         $(this).attr('checked', 'checked');
                     } else {
                         $(this).prop("checked", false);
                     }
                 });
             }
         });
     });


 /*    $(document).on('click', '.cr_click', "input", function() {
         var rcommentId = $(this).closest(".cls_comment_rating").find(".cr_click").attr('data-rcommentid');
         var rcommentuId = $(this).closest(".cls_comment_rating").find(".cr_click").attr('data-rcommentuid');
         var ratingNum = $("input[name=rating]:checked").val();
         var post_id = $(this).closest(".cls_comment_rating").find(".cr_click").attr('data-postid');
         //alert('comment_id='+rcommentId+'&rating='+ratingNum+'&user_id='+rcommentuId+'&post_id='+post_id);  
         $.ajax({
             type: 'POST',
             url: 'ajax/comment_rating.php',
             data: 'user_id=' + rcommentuId + '&post_id=' + post_id + '&rcommentId=' + rcommentId + '&ratingNum=' + ratingNum,
             dataType: 'json',
             success: function(resp) {
                 if (resp.status == 1) {
                     $('.average_rating_hide').hide();
                     $('.average_rating_show').show();
                     $('.average_rating_show').text(resp.data.average_rating + '/5');
                     $('#totalrat').text(resp.data.rating_num);
                     // alert('Thanks! You have rated '+ratingNum);  
                 } else if (resp.status == 2) {
                     $('.average_rating_hide').hide();
                     $('.average_rating_show').show();
                     $('.average_rating_show').text(resp.data.average_rating + '/5');
                     // alert('Thanks! You have updated rated '+ratingNum);  
                 }
                 $(".cls_comment_rating input").each(function() {
                     if ($(this).val() <= parseInt(resp.data.average_rating)) {
                         $(this).attr('checked', 'checked');
                     } else {
                         $(this).prop("checked", false);
                     }
                 });
             }
         });
     });*/
 </script>

 <style>
    .star-rating {
        display: flex;
        flex-direction: row-reverse;
        font-size: 1.3em;
        justify-content: space-around;
        padding: 0 0.2em;
        text-align: center;
        width: 5em;
        margin-left: -7px;
    }    

     .star-rating input {
         display: none;
     }

     .star-rating label {
         color: #ccc;
         cursor: pointer;
     }

     .star-rating :checked~label {
         color: #6ba4e9;
     }

     .star-rating label:hover,
     .star-rating label:hover~label {
         color: #6ba4e9;
     }

     /* explanation */

     article {
         background-color: #ffe;
         box-shadow: 0 0 1em 1px rgba(0, 0, 0, .25);
         color: #006;
         font-family: cursive;
         font-style: italic;
         margin: 4em;
         max-width: 30em;
         padding: 2em;
     }
 </style>

 <?php include('footer.php') ?>