<?php
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip'))
    ob_start("ob_gzhandler");
else ob_start();
include('header.php');
if (empty($_SESSION['is_login'])) {
    header("Location: https://switchh.in/");
}
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
include_once 'class/Post.php';
include_once 'config/Database.php';
?>
<!-- Container -->
<div id="main-feed" class="container">
    <!-- Content placeholders at page load -->
    <!-- this holds the animated content placeholders that show up before content -->
    <div id="shadow-dom" class="view-wrap">
         <?php include('shadow.php'); ?>
    </div>
    <!-- Feed page main wrapper -->
    <div id="activity-feed" class="view-wrap true-dom is-hidden">
        <div class="columns">
            <!-- Left side column -->
            <?php include('leftsidebar.php'); ?>
            <!-- /Left side column -->
            <!-- Middle column -->
            <div class="column is-6">
                <!-- Publishing Area -->
                <!-- /partials/pages/feed/compose-card.html -->
                <div id="compose-card" class="card is-new-content">
                    <!-- Top tabs -->

                    <form id="posts" name="posts" method="post" enctype="multipart/form-data" class="form_class">
                        <div class="lg:mx-0 p-2">
                            <div class="post_header">
                                <input type="text" name="header" id="header" class="form-control header_input header input mb-3" placeholder="Header" required="required">
                            </div>

                            <textarea name="content" id="content" placeholder="What's On Your Mind ?" class="bg-gray-100 hover:bg-gray-200 flex-1 h-10 content"></textarea>


                            <div class="loader" style="display: none;"></div>
                            <!-- <div class="row">
                                <div id="uploaded_images"></div>
                                <video id="video" width="150" height="150" controls></video>
                            </div> -->
                            <div class="row" style="display: flex; flex-wrap: wrap;font-size: 10px;">
                                <span id="selected-images"></span>
                            </div>
                            <div class="grid grid-flow-col pt-3 -mx-1 -mb-1 font-semibold text-sm" style="display: flex; justify-content: space-between; align-items: flex-start;">
                                <!-- <div>  
                                          Image<input type="file" class="fileToUpload" name="fileToUpload[]" id="fileToUpload" accept="image/x-png, image/gif, image/jpeg" multiple>
                                        </div> -->

                                <div class="compose-option mb-2 img_cls">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-camera">
                                        <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                                        <circle cx="12" cy="13" r="4"></circle>
                                    </svg>
                                    <span>Photo</span>
                                    <input style="opacity: 0; width:80px; float: left; position: absolute; " type="file" id="files" class="image-file" name="files[]" multiple />

                                </div>

                                <div class="compose-option vdo_cls">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-camera">
                                        <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                                        <circle cx="12" cy="13" r="4"></circle>
                                    </svg>
                                    <span>Video</span>
                                    <input style="opacity: 0; width:80px; float: left; position: absolute;" type="file" class="video" name="video" id="file-input">

                                </div>
                                <div class="flex items-center p-1.5 rounded-md cursor-pointer modal-trigger" data-modal="videos-help-modal1">
                                    <!-- <button class=" button savePost" type="button" data-modal="change-edit-profile">Post</button> -->
                                    <button type="submit" class="button savePost">Post</button>
                                    <!-- Image loader -->

                                    <!-- Image loader -->

                                </div>
                            </div>
                        </div>
                    </form>
                    
                    <div id="videos-help-modal" class="videos-help-modal is-xsmall has-light-bg popup_class" style="display: none;">
                        <div class="modal-content">
                            <div class="card">
                                <div class="card-heading" style="display: flex; justify-content:space-between;">
                                    <h3>Choose Account</h3>
                                    <span class="close-modal">
                                       <a href="feed.php"><i data-feather="x"></i></a>
                                    </span>

                                </div>
                                <div class="card-body">
                                    <div class="content-block is-active">
                                        <img src="assets/img/illustrations/cards/videotrip.svg" alt="">
                                        <div class="help-text">
                                            <h3>You have 2 Accounts</h3>
                                            <p>Choose directly right here from which account you want to make post</p>
                                        </div>
                                    </div>
                                    <div class="slide-dots">
                                        <div class="dot is-active"></div>
                                        <div class="dot"></div>
                                    </div>
                                    <div class="action">
                                        <button type="button" class="button is-solid accent-button raised main">Main Account</button>
                                    </div>
                                    <div class="action">
                                        <button type="button" class="button is-solid accent-button raised dummy">Dummy Account</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




                <!-- Mobile freind suggestion slider -->
                <!-- /partials/pages/feed/posts/feed-post1.html -->
                <!-- POST #1 -->
                <div id="feed-post-1" class="card is-post card-mobile-carousel">
                    <!-- Main wrap -->
                    <div class="content-wrap">
                        <!-- Post header -->
                        <div class="card-heading">
                            <!-- User meta -->
                            <div class="user-block">
                                <div class="user-info">
                                    <a href="#">Suggestions</a>
                                   
                                </div>
                            </div> 
                        </div>
                        <!-- /Post header -->
                        <!-- Post body -->
                        <div class="card-body">
                            <div class="container">
                                <div class="row"> 
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="nain-div">
                                            <div class="switch-main notification-head-main suggestion-tab" style="margin-top: 3px;">
                                                <ul uk-tab="" class="head-switch uk-tab">
                                                    <li class="uk-active"><a class="cu-list-item" href="#" aria-expanded="true">Dummy
                                                        <!-- <span class="suggestion-count">2</span> -->
                                                    </a></li>
                                                    <li><a class="cu-list-item" href="#" aria-expanded="false">Main
                                                        <!-- <span class="suggestion-count">1</span> -->
                                                    </a></li>
                                                </ul>
                                                <!-- First Account Notifications -->
                                                <ul class="uk-switcher uk-margin touch-none " style="width:100%;">
                                                    <li class="uk-active">
                                                        <div class="nav-drop-body is-notifications">
                                                            <div class="row">
                                                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                                                    <div class="custom-carousel hidescrollbar">
                                                                      <?php  
                                                                       /* $sql_dummy_mobile = "SELECT * FROM gt_friend_request WHERE request_from_id='".$dummy_row['id']."'"; 
                                                                        $sql_dummy_mobile_result = mysqli_query($conn, $sql_dummy_mobile) or die("Error:" . mysqli_error($conn));  
                                                                        $blank_dummy_mobile_array = array();
                                                                        $num_row1 = @mysqli_num_rows($sql_dummy_mobile_result);
                                                                        while ($dummy_row_fr = $sql_dummy_mobile_result->fetch_assoc()) {
                                                                            $blank_dummy_mobile_array[] = $dummy_row['id'].','.$dummy_row_fr['request_to_id'];
                                                                        } 
                                                                        $dummy_suggestion_ids = implode(',', $blank_dummy_mobile_array);
                                                                        if($num_row1>0){
                                                                            $sql = "SELECT * FROM gt_users WHERE id NOT IN(" . $dummy_suggestion_ids . ") AND anonymous IN (" . $dummy_row['anonymous'] . ") ORDER BY FIELD(anonymous, " . $dummy_row['anonymous'] . ") ASC";
                                                                        }else{
                                                                           $sql = "SELECT * FROM gt_users WHERE anonymous IN (" . $dummy_row['anonymous'] . ") ORDER BY FIELD(anonymous, " . $dummy_row['anonymous'] . ") ASC"; 
                                                                        } 
                                                                        $result = $conn->query($sql); 
                                                                        $num_row = @mysqli_num_rows($result);
                                                                        if ($num_row > 0) {
                                                                            while ($row = $result->fetch_assoc()) { */
                                                                            
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
                                                                            
                                                                            
                                                                          
                                                                             if ($row["id"] != $row1['request_to_id']) {
                                                                        ?>
                                                                                <div class="item">
                                                                                    <div class="pad15"> 
                                                                                        <a href="dummy_user_profile.php?id=<?php echo $row['id']; ?>">
                                                                                            <?php if ($row['photo'] != '') { ?>
                                                                                                <img src="<?php echo $row['photo'] ?>" alt="">
                                                                                            <?php } else { ?>
                                                                                                <img src="./upload/user/male.jpeg" alt="">
                                                                                            <?php } ?>
                                                                                            <div class="page-meta"> 
                                                                                                <span><?php echo $row['fname']; ?>
                                                                                                    <span class="star-textm"> 
                                                                                                       <?php echo getProfileRating($conn, $row['id']);?>/5
                                                                                                        <label class="star-checked">★</label>
                                                                                                    </span>
                                                                                                </span> 
                                                                                                 <span><?php
                                                                                                    $sql_1 = mysqli_query($conn, "SELECT anonymous from gt_users where id='" . $row['id'] . "'");
                                                                                                    $row_1 = mysqli_fetch_array($sql_1);
                                                                                                    $anonymous_id_1 = $row_1['anonymous'];
                                                                                                    $sql1_1 = mysqli_query($conn, "SELECT anonymous_name from gt_anonymous_name where id in (" . $anonymous_id_1 . ")");
                                                                                                    while ($row1_1 = @mysqli_fetch_array($sql1_1)) {
                                                                                                ?>
                                                                                                   <?php echo $row1_1['anonymous_name']; ?>
                                                                                                <?php } ?></span>
                                                                                            </div>
                                                                                        </a>    
                                                                                        <div class="add-friend add-transition sending_follow_request_mobile" data-userid="<?php echo $row['id']; ?>" data-from="<?php echo $dummy_row['id']; ?>" data-fullname="<?php echo $dummy_row['fname'];?>">
                                                                                            Follow
                                                                                        </div>
    
                                                                                    </div>
                                                                                </div>
                                                                        <?php } } }  ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <!-- Second Account Friend request -->
                                                    <li>
                                                        <div class="nav-drop-body is-notifications">
                                                            <div class="row">
                                                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                                                    <div class="custom-carousel hidescrollbar">
                                                                        <?php 
                                                                       /* $sql_fr = "SELECT * FROM gt_friend_request WHERE request_to_id='" . $_SESSION['id'] . "'"; 
                                                                        $result_fr = $conn->query($sql_fr);
                                                                        $num_row_fr = @mysqli_num_rows($result_fr);
                                                                        $blank_array = array();
                                                                        $main_blank_array = array();
                                                                        while ($row_fr = $result_fr->fetch_assoc()) {
                                                                            $blank_array[] = $row_fr['request_from_id'];
                                                                            $main_blank_array = $row_fr['request_to_id'];
                                                                        } 
                                                                        $suggestions_ids = implode(',', $blank_array); 
                                                                        $main_suggestions_ids = implode(',', $main_blank_array); 
                                                                        $sql = "SELECT gt_users.id as userid, gt_users.fname, gt_users.lname, gt_users.photo, gt_users.unique_name, gt_users.is_login, gt_friend_request.request_from_id, gt_friend_request.request_to_id FROM gt_friend_request INNER JOIN gt_users ON gt_friend_request.request_from_id=gt_users.id WHERE request_to_id IN ('" . $suggestions_ids . "') AND request_from_id !='" . $_SESSION['id'] . "'";
                                                                       
                                                                        $result = $conn->query($sql);
                                                                        $num_row = @mysqli_num_rows($result);
                                                                        if ($num_row > 0) {
                                                                            while ($row = $result->fetch_assoc()) { 
                                                                                $sql_photo = "SELECT * FROM users_photo WHERE user_id = '" . $row["userid"] . "' ORDER BY id DESC LIMIT 1"; 
                                                                                $query_retrived_photo = mysqli_query($conn, $sql_photo) or die("Error:" . mysqli_error($conn));
                                                                                $row_photo = mysqli_fetch_assoc($query_retrived_photo);
                                                                                $result_photo = mysqli_num_rows($query_retrived_photo); 
                                                                                if ($result_photo > 0){
                                                                                     $comment_photo = $row_photo['photo'];   
                                                                                } else {
                                                                                    $comment_photo = './upload/user/male.jpeg';
                                                                                } */
                                                                        $sql_fr = "SELECT * FROM gt_friend_request WHERE request_to_id='" . $_SESSION['id'] . "'";  
                                                                        $result_fr = $conn->query($sql_fr);
                                                                        $num_row_fr = @mysqli_num_rows($result_fr);
                                                                        $blank_array = array();
                                                                        while ($row_fr = $result_fr->fetch_assoc()) {
                                                                            $blank_array[] = $row_fr['request_from_id'];
                                                                        } 
                                                                        $suggestions_ids = implode(',', $blank_array);  
                                                                        
                                                                        $sql_fr2 = "SELECT * FROM gt_friend_request WHERE request_to_id='" . $suggestions_ids . "'";  
                                                                        $result_fr2 = $conn->query($sql_fr2);
                                                                        $num_row_fr2 = @mysqli_num_rows($result_fr2);
                                                                        $blank_array2 = array(); 
                                                                        while ($row_fr2 = $result_fr2->fetch_assoc()) {
                                                                            $blank_array2[] = $row_fr2['request_from_id'];
                                                                        } 
                                                                        $suggestions_ids2 = implode(',', $blank_array2);  
                                                                        
                                                                        
                                                                        $sql_fr3 = "SELECT * FROM gt_friend_request WHERE request_from_id='" . $_SESSION['id']  . "'";  
                                                                        $result_fr3 = $conn->query($sql_fr3);
                                                                        $num_row_fr3 = @mysqli_num_rows($result_fr3);
                                                                        $blank_array3 = array(); 
                                                                        while ($row_fr3 = $result_fr3->fetch_assoc()) {
                                                                            $blank_array3[] = $row_fr3['request_to_id'];
                                                                        } 
                                                                        $suggestions_ids3 = implode(',', $blank_array3);  
                                                                        $sql = "SELECT * FROM gt_users WHERE id !='" . $_SESSION['id'] . "' AND id IN(" . $suggestions_ids2 . ") AND id NOT IN(" . $suggestions_ids3 . ")"; 
                                                                        $result = $conn->query($sql);
                                                                        $num_row = @mysqli_num_rows($result);
                                                                        if ($num_row > 0) {
                                                                            while ($row = $result->fetch_assoc()) { 
                                                                                $sql_photo = "SELECT * FROM users_photo WHERE user_id = '" . $row["id"] . "' ORDER BY id DESC LIMIT 1"; 
                                                                                $query_retrived_photo = mysqli_query($conn, $sql_photo) or die("Error:" . mysqli_error($conn));
                                                                                $row_photo = mysqli_fetch_assoc($query_retrived_photo);
                                                                                $result_photo = mysqli_num_rows($query_retrived_photo); 
                                                                                if ($result_photo > 0){
                                                                                    $comment_photo = $row_photo['photo'];   
                                                                                } else {
                                                                                    $comment_photo = './upload/user/male.jpeg';
                                                                                }
                                                                        ?> 
                                                                                <div class="item">
                                                                                    <div class="pad15">
                                                                                        <a href="main_user_profile.php?id=<?php echo $row['id']; ?>">
                                                                                            <?php if ($row['photo'] != '') { ?>
                                                                                                <img src="<?php echo $row['photo'] ?>" alt="">
                                                                                            <?php } else { ?>
                                                                                                <img src="./upload/user/male.jpeg" alt="">
                                                                                            <?php } ?>
                                                                                            <div class="page-meta">
                                                                                                <span><?php echo $row['fname'] . ' ' . $row['lname']; ?></span>
                                                                                                
                                                                                                <span><?php echo $row['unique_name'];?></span>
                                                                                            </div>
                                                                                        </a>
                                                                                        <div class="add-friend add-transition sending_follow_request_mobile" data-userid="<?php echo $row['id']; ?>" data-from="<?php echo $_SESSION['id']; ?>" data-fullname="<?php echo $_SESSION['fname'];?>">
                                                                                            Follow
                                                                                        </div>
    
                                                                                    </div>
                                                                                </div>
                                                                        <?php }} ?>
                                                                          
                                                                        <?php 
                                                                        /*$sql = "SELECT * FROM gt_users WHERE id !='" . $_SESSION['id'] . "' AND dummy_id ='0' ORDER BY RAND() LIMIT 3";
                                                                        $result = $conn->query($sql);
                                                                        $num_row = @mysqli_num_rows($result);
                                                                        if ($num_row > 0) {
                                                                            while ($row = $result->fetch_assoc()) { 
                                                                                $sql_photo = "SELECT * FROM users_photo WHERE user_id = '" . $row["userid"] . "' ORDER BY id DESC LIMIT 1"; 
                                                                                $query_retrived_photo = mysqli_query($conn, $sql_photo) or die("Error:" . mysqli_error($conn));
                                                                                $row_photo = mysqli_fetch_assoc($query_retrived_photo);
                                                                                $result_photo = mysqli_num_rows($query_retrived_photo); 
                                                                                if ($result_photo > 0){
                                                                                     $comment_photo = $row_photo['photo'];   
                                                                                } else {
                                                                                    $comment_photo = './upload/user/male.jpeg';
                                                                                }*/ 
                                                                        $sql_frR = "SELECT * FROM gt_friend_request WHERE request_from_id='" . $_SESSION['id'] . "'"; 
                                                                        $result_frR = $conn->query($sql_frR);
                                                                        $num_row_frR = @mysqli_num_rows($result_frR);
                                                                        $blank_arrayR = array();
                                                                        while ($row_frR = $result_frR->fetch_assoc()) {
                                                                            $blank_arrayR[] = $row_frR['request_to_id'];
                                                                        } 
                                                                        $suggestions_idsR = implode(',', $blank_arrayR);  
                                                                        $sql = "SELECT * FROM gt_users WHERE id !='" . $_SESSION['id'] . "' AND id NOT IN (" . $suggestions_idsR . ") AND dummy_id ='0' ORDER BY RAND() LIMIT 3"; 
                                                                       // echo $sql;
                                                                        $result = $conn->query($sql);
                                                                        $num_row = @mysqli_num_rows($result);
                                                                        if ($num_row > 0) {
                                                                            while ($row = $result->fetch_assoc()) { 
                                                                                $sql_photo = "SELECT * FROM users_photo WHERE user_id = '" . $row["userid"] . "' ORDER BY id DESC LIMIT 1"; 
                                                                                $query_retrived_photo = mysqli_query($conn, $sql_photo) or die("Error:" . mysqli_error($conn));
                                                                                $row_photo = mysqli_fetch_assoc($query_retrived_photo);
                                                                                $result_photo = mysqli_num_rows($query_retrived_photo); 
                                                                                if ($result_photo > 0){
                                                                                     $comment_photo = $row_photo['photo'];   
                                                                                } else {
                                                                                    $comment_photo = './upload/user/male.jpeg';
                                                                                } 
                                                                        ?> 
                                                                                <div class="item">
                                                                                    <div class="pad15"> 
                                                                                        <a href="main_user_profile.php?id=<?php echo $row['id']; ?>">
                                                                                            <?php if ($row['photo'] != '') { ?>
                                                                                                <img src="<?php echo $row['photo'] ?>" alt="">
                                                                                            <?php } else { ?>
                                                                                                <img src="./upload/user/male.jpeg" alt="">
                                                                                            <?php } ?>
                                                                                            <div class="page-meta">
                                                                                                <span><?php echo $row['fname'] . ' ' . $row['lname']; ?></span>
                                                                                                
                                                                                                <span><?php echo $row['unique_name'];?></span>
                                                                                            </div>
                                                                                        </a>
                                                                                        <div class="add-friend add-transition sending_follow_request_mobile" data-userid="<?php echo $row['id']; ?>" data-from="<?php echo $_SESSION['id']; ?>" data-fullname="<?php echo $_SESSION['fname'];?>">
                                                                                            Follow
                                                                                        </div>
    
                                                                                    </div>
                                                                                </div>
                                                                        <?php }}
                                                                          ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="row">
                                    <div class="col-md-12 text-center">
                                        <br /><br /><br />
                                        <p>Settings</p>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <!-- /Post body -->
                    </div>
                    <!-- /Main wrap -->
                </div>
                <!-- Mobile freind suggestion slider -->





                <!-- Post 1 -->
                <!-- /partials/pages/feed/posts/feed-post1.html -->
                <!-- POST #1 -->
                <?php
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

                $query = @mysqli_query($conn, "SELECT * FROM gt_posts WHERE user_id in($allid) AND is_post='main' OR is_post='dummy' ORDER BY id DESC");
                
                 //$sql = "SELECT * FROM gt_users WHERE id NOT IN('" . $dummy_row['id'] . "') and  (FIND_IN_SET('" . $anon_id[0]. "', anonymous) != 0 OR FIND_IN_SET('" . $anon_id[1]. "', anonymous) != 0 OR FIND_IN_SET('" . $anon_id[2]. "', anonymous) != 0)";
                
                while ($row = $query->fetch_assoc()) {
                   // print_r($row);
                    $get_user_query = mysqli_query($conn, "SELECT * FROM gt_users WHERE id ='" . $row['user_id'] . "'");
                    while ($row_user_query = $get_user_query->fetch_assoc()) {
                       // print_r($row_user_query);
                        $queryR = "SELECT p.*, COUNT(r.rating_number) as rating_num, FORMAT((SUM(r.rating_number) / COUNT(r.rating_number)),1) as average_rating, COUNT(r.user_id) as total_user FROM gt_posts as p LEFT JOIN rating as r ON r.post_id = p.id WHERE p.id = '" . $row['id'] . "' GROUP BY (r.post_id)";
                        // echo  $queryR;
                        $resultR = $conn->query($queryR);
                        $postData = $resultR->fetch_assoc(); 
                        $badgesId = $row_user_query['badges'];
                        $bsql = mysqli_query($conn, "SELECT title from gt_badges where id='" . $badgesId . "'");
                        $brow = mysqli_fetch_array($bsql); 
                        
                        $user_profile_photo = mysqli_query($conn, "SELECT photo from users_photo where user_id='" . $postData['user_id'] . "' ORDER BY id DESC");
                        $row_profile_photo = mysqli_fetch_array($user_profile_photo);
                    

                ?>

                        <?php if ($row_user_query['dummy_id'] == 0) { ?>
                            <div class="card is-post">
                                <!-- Main wrap -->
                                <div class="content-wrap">
                                    <!-- Post header -->
                                    <div class="card-heading">
                                        <!-- User meta -->
                                        <div class="user-block">
                                            <div class="image">
                                                <?php
                                                if ($row_profile_photo['photo'] != "" && $row_profile_photo['status'] == 0) { ?>
                                                    <img src="<?php echo $row_profile_photo['photo'] ?>" class="avatar-image" data-demo-src="assets/img/avatars/edward.jpeg" data-user-popover="5" alt="">
                                                <?php } else { ?>
                                                    <img src="./upload/user/male.jpeg" alt="">
                                                <?php } ?>
                                            </div>
                                            <div class="user-info">
                                                <div style="display: flex;">
                                                    <?php if($row_user_query['id']== $main_row['id']){ ?>
                                                    <a href="main_profile.php" class="d-flex-star" style="display: flex;">
                                                        <?php echo $row_user_query['fname'] . ' ' . $row_user_query['lname']; ?>
                                                    </a>
                                                    <?php } else { ?>
                                                    <a href="main_user_profile.php?id=<?php echo $row_user_query['id']; ?>" class="d-flex-star">
                                                        <?php echo $row_user_query['fname'] . ' ' . $row_user_query['lname']; ?>
                                                    </a>
                                                     <?php } ?>
                                                    
                                                </div>
                                                <div style="display: flex;">
                                                    <span class="time has-text-weight-medium"><?php echo $row_user_query['unique_name']; ?></span>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- Right side dropdown -->
                                        <!-- /partials/pages/feed/dropdowns/feed-post-dropdown.html -->
                                        <!--<div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
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
                                        </div>-->
                                    </div>
                                    <!-- /Post header -->

                                    <!-- Post body -->
                                    <div class="card-body">
                                        <!-- Post body text -->
                                        <div class="post-text">
                                            <span class="span-title"><?php echo $row['title'] ?></span>
                                            <p><?php echo $row['description'] ?>
                                            <p>
                                        </div>
                                        <!-- Featured youtube video -->
                                        <div class="post-link is-video">
                                            <!-- Link image -->

                                            <?php if ($row['post_type'] == 'video') { ?>
                                                <div class="link-image">
                                                    <div class="video-overlay"></div>
                                                    <?php
                                                    $sqlv = mysqli_query($conn, "SELECT * from post_image_video where post_id ='" . $row['id'] . "'");
                                                    while ($row_v = @mysqli_fetch_array($sqlv)) {

                                                    ?>
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
                                            <!-- Link content -->

                                            <!-- Post actions -->
                                            <!-- /partials/pages/feed/buttons/feed-post-actions.html -->
                                            <div class="like-wrapper">
                                                <?php
                                                $query1 = mysqli_query($conn, "select * from `like_unlike` where post_id='" . $row['id'] . "' and user_id='" . $_SESSION['id'] . "'");
                                                $num_row = mysqli_num_rows($query1);
                                                if ($num_row > 0) {
                                                ?>
                                                    <button value="<?php echo $row['id']; ?>" class="like-button is-active unlike">
                                                        <i class="mdi mdi-heart not-liked bouncy"></i>
                                                        <i class="mdi mdi-heart is-liked bouncy"></i>
                                                        <span class="like-overlay"></span>
                                                    </button>
                                                <?php
                                                } else {
                                                ?>
                                                    <button value="<?php echo $row['id']; ?>" class="like-button like">
                                                        <i class="mdi mdi-heart not-liked bouncy"></i>
                                                        <i class="mdi mdi-heart is-liked bouncy"></i>
                                                        <span class="like-overlay"></span>
                                                    </button>
                                                <?php } ?>
                                            </div>

                                            <!-- <div class="fab-wrapper is-share">
                                                <a href="javascript:void(0);" class="small-fab share-fab modal-trigger" data-modal="share-modal">
                                                    <i data-feather="link-2"></i>
                                                </a>
                                            </div> -->

                                            <div class="fab-wrapper is-comment ispostId" data-postid="<?php echo $row['id'] ?>">
                                                <a href="javascript:void(0);" class="small-fab get_post_id">
                                                    <i data-feather="message-circle"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Post body -->

                                    <!-- Post footer -->
                                    <div class="card-footer">
                                        <!-- Followers text -->
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
                                                        <!--<div class="average_rating_show" style="display: none;"></div>-->
                                                         <div class="average_rating_show"></div>
                                                        <h3 class="average_rating_hide">
                                                            <span class="span-title d-flex-star">
                                                                <span class="rating_star-m">
                                                                    <span class="star-textm" style="font-size: 14px !important;">
                                                                    <?php if ($postData['average_rating'] != "") {
                                                                        echo $postData['average_rating'];
                                                                    } else {
                                                                        echo '0';
                                                                    } ?>/5 
                                                                        <label class="star-checked">★</label>
                                                                    </span>
                                                                </span>
                                                            </span> 
                                                        </h3>
                                                        <small><?php echo $postData['total_user']; ?></small>
                                                    </div>
                                                    <p><?php echo date("F d, Y h:mA", strtotime($postData['created_at'])); ?></p>
                                                </div>
                                                <!-- Post statistics -->
                                                <div class="social-count">
                                                    <div class="likes-count">
                                                        <i data-feather="heart"></i>
                                                        <span id="show_like<?php echo $row['id']; ?>">
                                                            <?php
                                                            $query3 = mysqli_query($conn, "select * from `like_unlike` where post_id='" . $row['id'] . "'");
                                                            echo mysqli_num_rows($query3);
                                                            ?>
                                                        </span>
                                                    </div>
                                                    <!-- <div class="shares-count">
                                                        <i data-feather="link-2"></i>
                                                        <span>9</span>
                                                    </div> -->
                                                    <div class="comments-count">
                                                        <i data-feather="message-circle"></i>
                                                        <span>
                                                            <?php
                                                                $query4 = mysqli_query($conn, "select * from `comment` where post_id='" . $postData['id'] . "'");
                                                                echo mysqli_num_rows($query4);
                                                            ?>
                                                        </span>
                                                    </div>
                                                </div>
                                        </div>
                                        <!-- /Post footer -->
                                    </div>
                                    <!-- /Main wrap -->

                                    <!-- Post #2 comments --> 
                                    <div class="comments-wrap is-hidden">
                                        <div class="comments-heading" id="mainForm">
                                            <h4>Comments</h4>
                                            <div class="close-comments">
                                                <i data-feather="x"></i>
                                            </div>
                                        </div>
                                        <?php
                                        $post_id = $postData['id']; 
                                        ?>
                                        <div class="card-footer">
                                            <div class="media post-comment has-emojis">
                                                <form method="POST" class="commentForm"> 
                                                    <div class="media-content">
                                                        <div class="field">
                                                            <p class="control fff">
                                                               
                                                              <textarea class="textarea comment-textarea commentt" name="comment" rows="5" placeholder="Write a comment..." value="" 
                                                              style="width: 340px; height: 31px;"></textarea>  
                                                               <!--  <textarea class="textarea comment-textarea commentt cls_comment" name="comment" rows="5" col="10" placeholder="Write a comment..." id="comment"></textarea>-->
                                                            </p>
                                                            <input type="hidden" name="postId" class="postId" value="<?php echo $post_id; ?>" />
                                                            <input type="hidden" name="userId" class="userId" value="<?php echo $main_row['id']; ?>" />
                                                            <input type="hidden" name="commentId" class="commentId" value="0" />
                                                        </div>
                                                        <div class="actions">
                                                            <div class="image is-32x32">
                                                                <img class="is-rounded" src="#" data-demo-src="assets/img/avatars/jenna.png" data-user-popover="0" alt="">
                                                            </div>
                                                            <div class="toolbar">
                                                               <!-- <div class="action is-auto">
                                                                    <i data-feather="at-sign"></i>
                                                                </div>-->
                                                                <div class="action is-emoji">
                                                                    <i data-feather="smile"></i>
                                                                </div>
                                                                <!--<div class="action is-upload">
                                                                    <i data-feather="camera"></i>
                                                                    <input type="file">
                                                                </div>-->
                                                                <button type="submit" class="button is-solid primary-button raised post_comment">Post Comment</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="showComments"> </div>

                                        
                                    </div>
                                    <!-- /Post #2 comments -->
                                </div>
                            <?php } else { ?>
                            <?php //print_r($row['user_id']);
                               /* $anon_id = explode(',',$dummy_row['anonymous']); 
                                $sqld = "SELECT * FROM gt_users WHERE id IN('" . $row['user_id'] . "') and  (FIND_IN_SET('" . $anon_id[0]. "', anonymous) != 0 OR FIND_IN_SET('" . $anon_id[1]. "', anonymous) != 0 OR FIND_IN_SET('" . $anon_id[2]. "', anonymous) != 0)";
                                $resultd = $conn->query($sqld);  
                                $rowd = $resultd->fetch_assoc();
                                print_r($rowd);*/
                            ?>
                                 <div class="card is-post">
                                <!-- Main wrap -->
                                <div class="content-wrap">
                                    <!-- Post header -->
                                    <div class="card-heading">
                                        <!-- User meta -->
                                        <div class="user-block">
                                            <div class="image">
                                                <?php
                                                if ($row_profile_photo['photo'] != "" && $row_profile_photo['status'] == 0) { ?>
                                                    <img src="<?php echo $row_profile_photo['photo'] ?>" class="avatar-image" data-demo-src="assets/img/avatars/edward.jpeg" data-user-popover="5" alt="">
                                                <?php } else { ?>
                                                    <img src="./upload/user/male.jpeg" alt="">
                                                <?php } ?> 
                                            </div>
                                            <div class="user-info">
                                                <div style="display: flex;">
                                                    <?php if($row_user_query['id']== $dummy_row['id']){ ?>
                                                        <a href="dummy_profile.php" class="d-flex-star" style="display: flex;">
                                                            <?php echo $row_user_query['fname']; ?>
                                                            <span class="span-title d-flex-star">
                                                                <span class="rating_star-m">
                                                                    <span class="star-textm"> 
                                                                       <?php echo getProfileRating($conn, $dummy_row['id']);?>/5
                                                                        <label class="star-checked">★</label>
                                                                    </span>
                                                                </span>
                                                            </span>  
                                                        </a>
                                                    <?php } else { ?>
                                                        <a href="dummy_user_profile.php?id=<?php echo $row_user_query['id']; ?>" class="d-flex-star" style="display: flex;">
                                                            <?php echo $row_user_query['fname']; ?>
                                                            <span class="span-title d-flex-star">
                                                                <span class="rating_star-m">
                                                                    <span class="star-textm">
                                                                        <?php echo getProfileRating($conn, $row_user_query['id']);?>/5
                                                                        <label class="star-checked">★ <?php //echo $row_user_query['id'];?></label>
                                                                    </span>
                                                                </span>
                                                            </span>  
                                                        </a>
                                                        <?php } ?>
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
                                        </div>
                                        <!-- Right side dropdown -->
                                        <!-- /partials/pages/feed/dropdowns/feed-post-dropdown.html -->
                                        <!--<div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
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
                                        </div>-->
                                    </div>
                                    <!-- /Post header -->

                                    <!-- Post body -->
                                    <div class="card-body">
                                        <!-- Post body text -->
                                        <div class="post-text">
                                            <span class="span-title"><?php echo $row['title'] ?></span>
                                            <p><?php echo $row['description'] ?>
                                            <p>
                                        </div>
                                        <!-- Featured youtube video -->
                                        <div class="post-link is-video">
                                            <!-- Link image -->

                                            <?php if ($row['post_type'] == 'video') { ?>
                                                <div class="link-image">
                                                    <div class="video-overlay"></div>
                                                    <?php
                                                    $sqlv = mysqli_query($conn, "SELECT * from post_image_video where post_id ='" . $row['id'] . "'");
                                                    while ($row_v = @mysqli_fetch_array($sqlv)) {

                                                    ?>
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
                                            <!-- Link content -->

                                            <!-- Post actions -->
                                            <!-- /partials/pages/feed/buttons/feed-post-actions.html -->
                                            <div class="like-wrapper">
                                                <?php
                                                $query1 = mysqli_query($conn, "select * from `like_unlike` where post_id='" . $row['id'] . "' and user_id='" . $_SESSION['id'] . "'");
                                                $num_row = mysqli_num_rows($query1);
                                                if ($num_row > 0) {
                                                ?>
                                                    <button value="<?php echo $row['id']; ?>" class="like-button is-active unlike">
                                                        <i class="mdi mdi-heart not-liked bouncy"></i>
                                                        <i class="mdi mdi-heart is-liked bouncy"></i>
                                                        <span class="like-overlay"></span>
                                                    </button>
                                                <?php
                                                } else {
                                                ?>
                                                    <button value="<?php echo $row['id']; ?>" class="like-button like">
                                                        <i class="mdi mdi-heart not-liked bouncy"></i>
                                                        <i class="mdi mdi-heart is-liked bouncy"></i>
                                                        <span class="like-overlay"></span>
                                                    </button>
                                                <?php } ?>
                                            </div>

                                            <!-- <div class="fab-wrapper is-share">
                                                <a href="javascript:void(0);" class="small-fab share-fab modal-trigger" data-modal="share-modal">
                                                    <i data-feather="link-2"></i>
                                                </a>
                                            </div> -->

                                            <div class="fab-wrapper is-comment ispostId" data-postid="<?php echo $row['id'] ?>">
                                                <a href="javascript:void(0);" class="small-fab get_post_id">
                                                    <i data-feather="message-circle"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Post body -->

                                    <!-- Post footer -->
                                    <div class="card-footer">
                                        <!-- Followers text -->
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
                                                        <div class="average_rating_show"></div>
                                                        <h3 class="average_rating_hide">
                                                             <span class="span-title d-flex-star">
                                                                <span class="rating_star-m">
                                                                    <span class="star-textm" style="font-size: 14px !important;">
                                                                    <?php if ($postData['average_rating'] != "") {
                                                                        echo $postData['average_rating'];
                                                                    } else {
                                                                        echo '0';
                                                                    } ?>/5 
                                                                        <label class="star-checked">★</label>
                                                                    </span>
                                                                </span>
                                                            </span>  
                                                        </h3>
                                                        <small><?php echo $postData['total_user']; ?></small>
                                                    </div>
                                                    <p><?php echo date("F d, Y h:mA", strtotime($postData['created_at'])); ?></p>
                                                </div>
                                                <!-- Post statistics -->
                                                <div class="social-count">
                                                    <div class="likes-count">
                                                        <i data-feather="heart"></i>
                                                        <span id="show_like<?php echo $row['id']; ?>">
                                                            <?php
                                                            $query3 = mysqli_query($conn, "select * from `like_unlike` where post_id='" . $row['id'] . "'");
                                                            echo mysqli_num_rows($query3);
                                                            ?>
                                                        </span>
                                                    </div>
                                                    <!-- <div class="shares-count">
                                                        <i data-feather="link-2"></i>
                                                        <span>9</span>
                                                    </div> -->
                                                    <div class="comments-count">
                                                        <i data-feather="message-circle"></i>
                                                        <span>
                                                            <?php
                                                                $query4 = mysqli_query($conn, "select * from `comment` where post_id='" . $postData['id'] . "'");
                                                                echo mysqli_num_rows($query4);
                                                            ?>
                                                        </span>
                                                    </div>
                                                </div>
                                        </div>
                                        <!-- /Post footer -->
                                    </div>
                                    <!-- /Main wrap -->

                                     <!-- Post #2 comments --> 
                                    <div class="comments-wrap is-hidden">
                                        <div class="comments-heading" id="mainForm">
                                            <h4>Comments</h4>
                                            <div class="close-comments">
                                                <i data-feather="x"></i>
                                            </div>
                                        </div>
                                        <?php
                                        $post_id = $postData['id']; 
                                        ?>
                                        <div class="card-footer">
                                            <div class="media post-comment has-emojis">
                                                <form method="POST" class="commentForm"> 
                                                    <div class="media-content">
                                                        <div class="field">
                                                            <p class="control fff">
                                                               
                                                              <textarea class="textarea comment-textarea commentt" name="comment" rows="5" placeholder="Write a comment..." value="" 
                                                              style="width: 340px; height: 31px;"></textarea>  
                                                               <!--  <textarea class="textarea comment-textarea commentt cls_comment" name="comment" rows="5" col="10" placeholder="Write a comment..." id="comment"></textarea>-->
                                                            </p>
                                                            <input type="hidden" name="postId" class="postId" value="<?php echo $post_id; ?>" />
                                                            <input type="hidden" name="userId" class="userId" value="<?php echo $dummy_row['id']; ?>" />
                                                            <input type="hidden" name="commentId" class="commentId" value="0" />
                                                        </div>
                                                        <div class="actions">
                                                            <div class="image is-32x32">
                                                                <img class="is-rounded" src="#" data-demo-src="assets/img/avatars/jenna.png" data-user-popover="0" alt="">
                                                            </div>
                                                            <div class="toolbar">
                                                               <!-- <div class="action is-auto">
                                                                    <i data-feather="at-sign"></i>
                                                                </div>-->
                                                                <div class="action is-emoji">
                                                                    <i data-feather="smile"></i>
                                                                </div>
                                                                <!--<div class="action is-upload">
                                                                    <i data-feather="camera"></i>
                                                                    <input type="file">
                                                                </div>-->
                                                                <button type="submit" class="button is-solid primary-button raised post_comment">Post Comment</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="showComments"> </div>

                                        
                                    </div>
                                    <!-- /Post #2 comments -->
                                </div>
                            <?php }  }  } ?>
                    <!-- Load more posts -->
                    <!-- <div class=" load-more-wrap narrow-top has-text-centered">
                    <a href="#" class="load-more-button">Load More</a>
                </div> -->
                    <!-- /Load more posts -->
                            </div>
                            <!-- /Middle column -->
                            <!-- Right side column -->
                            <?php include('rightsidebar.php'); ?>

                            <!-- /Right side column -->
            </div>
        </div>
        <!-- /Feed page main wrapper -->
    </div>
    <!-- Live video onboarding modal -->
    <!-- /partials/pages/feed/modals/videos-help-modal.html -->


    <!-- Emoji  -->
    <script type="text/javascript">
        $(document).ready(function() { 
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
                           // $('.average_rating_hide').hide();
                            $('.average_rating_show').show();
                            $('.average_rating_show').text(resp.data.average_rating + '/5');
                            $('#totalrat').text(resp.data.rating_num);
                        } else if (resp.status == 2) {
                            //$('.average_rating_hide').hide();
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


            $(document).on('click', '.cr_click', "input", function() {
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
            });

            //like unlike js
            $(document).on('click', '.like', function() {
                var id = $(this).val();
                var $this = $(this);
                $this.toggleClass('like');
                if ($this.hasClass('like')) {
                    //$this.text('Like'); 
                } else {
                    //$this.text('Unlike');
                    $this.addClass("unlike");
                }
                $.ajax({
                    type: "POST",
                    url: "ajax/like.php",
                    data: {
                        id: id,
                        like: 1,
                    },
                    success: function() {
                        showLike(id);
                    }
                });
            });

            $(document).on('click', '.unlike', function() {
                var id = $(this).val();
                var $this = $(this);
                $this.toggleClass('unlike');
                if ($this.hasClass('unlike')) {
                    // $this.text('Unlike');
                } else {
                    //$this.text('Like');
                    $this.addClass("like");
                }
                $.ajax({
                    type: "POST",
                    url: "ajax/like.php",
                    data: {
                        id: id,
                        like: 1,
                    },
                    success: function() {
                        showLike(id);
                    }
                });
            });

        });

        function showLike(id) {
            $.ajax({
                url: 'ajax/show_like.php',
                type: 'POST',
                async: false,
                data: {
                    id: id,
                    showlike: 1
                },
                success: function(response) {
                    $('#show_like' + id).html(response);

                }
            });
        }
    </script>
    <style>
        .star-rating { 
            display: flex;
            flex-direction: row-reverse;
            font-size: 1.3em;
            justify-content: space-around;
            padding: 0 .2em;
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
    <?php
    include('footer.php');
    ?>