<div class="column is-3">
    <!-- Stories widget -->
    <!-- /partials/widgets/stories-widget.html -->
    <div class="card">
        <div class="card-heading is-bordered">
            <h4>Stories</h4>
            <div class="dropdown is-spaced is-neutral is-right dropdown-trigger">
                <div>
                    <div class="button">
                        <i data-feather="more-vertical"></i>
                    </div>
                </div>
                <div class="dropdown-menu" role="menu">
                    <div class="dropdown-content">
                        <a href="#" class="dropdown-item">
                            <div class="media">
                                <i data-feather="tv"></i>
                                <div class="media-content">
                                    <h3>Browse stories</h3>
                                    <small>View all recent stories.</small>
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
            <!-- Story block -->
            <div class="story-block">
                <a id="add-story-button" href="#" class="add-story">
                    <i data-feather="plus"></i>
                </a>
                <div class="story-meta">
                    <span>Add a new Story</span>
                    <span>Share an image, a video or some text</span>
                </div>
            </div>
            <!-- Story block -->
            <div class="story-block">
                <div class="img-wrapper">
                    <img src="./upload/p2.jpg" data-demo-src="assets/img/avatars/dan.jpg" data-user-popover="1" alt="">
                </div>
                <div class="story-meta">
                    <span>Dan Walker</span>
                    <span>1 hour ago</span>
                </div>
            </div>
            <!-- Story block -->
            <div class="story-block">
                <div class="img-wrapper">
                    <img src="./upload/p2.jpg" data-demo-src="assets/img/avatars/bobby.jpg" data-user-popover="8" alt="">
                </div>
                <div class="story-meta">
                    <span>Bobby Brown</span>
                    <span>3 days ago</span>
                </div>
            </div>
            <!-- Story block -->
            <!-- <div class="story-block">
                                    <div class="img-wrapper">
                                        <img src="./upload/p2.jpg" data-demo-src="assets/img/avatars/elise.jpg" data-user-popover="6" alt="">
                                    </div>
                                    <div class="story-meta">
                                        <span>Elise Walker</span>
                                        <span>Last week</span>
                                    </div>
                                </div> -->
        </div>
    </div>

    <!-- Suggested friends main account widget -->
    <!-- /partials/widgets/suggested-friends-1-widget.html -->
    <div class="card">
        <div class="card-heading is-bordered">
            <h4>Suggested Friends by main</h4>
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
                    
                        <div class="add-friend-block user-profile-cus  transition-block"> 
                            <a href="main_user_profile.php?id=<?php echo $row['id']; ?>">
                                <img src="<?php echo $comment_photo; ?>" data-demo-src="assets/img/avatars/nelly.png" data-user-popover="9" alt=""> 
                                <a href="main_user_profile.php?id=<?php echo $row['id']; ?>">
                                    <div class="story-meta">
                                        <span class="span-title d-flex-star">
                                            <span style="font-size: .85rem;color: #393a4f;font-weight: 500;"><?php echo $row['fname'] . ' ' . $row['lname'] ?></span> 
                                        </span>   
                                        <span class="interest-span"><?php echo $row['unique_name'] ?></span>
                                    </div>
                                </a> 
                            </a> 
                            
                            
                            <div class="add-friend add-transition sending_follow_request_mobile" data-userid="<?php echo $row['id']; ?>" data-from="<?php echo $_SESSION['id']; ?>" data-fullname="<?php echo $_SESSION['fname'];?>">
                                <i data-feather="user-plus"></i>
                            </div>
                        </div>
                    
            <?php } } ?>
            
            <?php
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
                    
                        <div class="add-friend-block user-profile-cus  transition-block"> 
                        <a href="main_user_profile.php?id=<?php echo $row['id']; ?>">
                            <img src="<?php echo $comment_photo; ?>" data-demo-src="assets/img/avatars/nelly.png" data-user-popover="9" alt=""> 
                            <a href="main_user_profile.php?id=<?php echo $row['id']; ?>">
                                <div class="story-meta">
                                    <span class="span-title d-flex-star">
                                        <span style="font-size: .85rem;color: #393a4f;font-weight: 500;"><?php echo $row['fname'] . ' ' . $row['lname'] ?></span> 
                                    </span>   
                                    <span class="interest-span"><?php echo $row['unique_name'] ?></span>
                                </div>
                            </a>    
                        </a>    
                            
                            
                             <div class="add-friend add-transition sending_follow_request_mobile" data-userid="<?php echo $row['id']; ?>" data-from="<?php echo $_SESSION['id']; ?>" data-fullname="<?php echo $_SESSION['fname'];?>">
                                <i data-feather="user-plus"></i>
                            </div>
                        </div>
                    
            <?php } } ?>



        </div>
    </div>

</div>