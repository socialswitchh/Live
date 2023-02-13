<?php
include('header.php');
if (empty($_SESSION['is_login'])) {
    header("Location: https://switchh.in/");
    die();
}
$sqll = mysqli_query($conn, "SELECT anonymous, badges from gt_users where dummy_id='" . $_SESSION['id'] . "'");
$roww = mysqli_fetch_array($sqll);
$anonymous_id = $roww['anonymous'];
$badges_id = $roww['badges'];
$b_sql = mysqli_query($conn, "SELECT title from gt_badges where id='" . $badges_id . "'");
$b_row = mysqli_fetch_array($b_sql);
$badges_title = $b_row['title'];

$sql = "SELECT * FROM gt_users WHERE id = '" . $dummy_row['id'] . "'";
$query_retrived = mysqli_query($conn, $sql) or die("Error:" . mysqli_error($conn));
$row = mysqli_fetch_assoc($query_retrived);
$result = mysqli_num_rows($query_retrived);

//Followers
$sql_followers = "SELECT * FROM gt_friend_request WHERE request_to_id = '" . @$row['id'] . "' AND request_status='Accept'";
$query_retrived_followers = mysqli_query($conn, $sql_followers) or die("Error:" . mysqli_error($conn));
$row_followers = mysqli_fetch_assoc($query_retrived_followers);

//Following
$sql_following = "SELECT * FROM gt_friend_request WHERE request_from_id='" . @$row['id'] . "' AND request_status='Accept'";
$query_retrived_following = mysqli_query($conn, $sql_following) or die("Error:" . mysqli_error($conn));
$row_following = mysqli_fetch_assoc($query_retrived_following);

$sql_photo = "SELECT * FROM users_photo WHERE user_id = '" . $dummy_row['id'] . "' AND type='dummy' ORDER BY id DESC LIMIT 1";
$query_retrived_photo = mysqli_query($conn, $sql_photo) or die("Error:" . mysqli_error($conn));
$row_photo = mysqli_fetch_assoc($query_retrived_photo);
$result_photo = mysqli_num_rows($query_retrived_photo);

$sql_cover_photo = "SELECT * FROM users_cover_photo WHERE user_id = '" . $dummy_row['id'] . "' AND type='dummy' ORDER BY id DESC LIMIT 1";
$query_retrived_cover_photo = mysqli_query($conn, $sql_cover_photo) or die("Error:" . mysqli_error($conn));
$row_cover_photo = mysqli_fetch_assoc($query_retrived_cover_photo);
$result_cover_photo = mysqli_num_rows($query_retrived_cover_photo);
?>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KQHJPZP" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) --> 
    <!-- Pageloader -->
    <div class="pageloader"></div>
    <div class="infraloader is-active"></div>
    <div class="app-overlay"></div> 
    <!-- Container -->
    <div class="container is-custom" style="margin-top:60px;"> 
        <!-- Profile page main wrapper -->
        <div id="profile-main" class="view-wrap is-headless">
            <div class="columns is-multiline no-margin">
                <!-- Left side column -->
                <div class="column is-paddingless">
                    <!-- Timeline Header -->
                    <!-- html/partials/pages/profile/timeline/timeline-header.html -->
                    <div class="cover-bg"> 
                        <?php if ($row_cover_photo['photo'] != "" && $row_cover_photo['status'] == 0) { ?> 
                            <img src="<?php echo $row_cover_photo['photo'] ?>" data-demo-src="<?php echo $row_cover_photo['photo'] ?>" alt=""> 
                        <?php } else { ?> 
                            <img src="./upload/user/cover/cover.jpg" data-demo-src="./upload/user/cover/cover.jpg" alt=""> 
                        <?php } ?> 
                        <div class="avatar"> 
                            <?php if ($row_photo['photo'] != "" && $row_photo['status'] == 0) { ?>
                                <img src="<?php echo $row_photo['photo'] ?>" class="avatar-image" data-demo-src="assets/img/avatars/jenna.png" alt="">
                            <?php } else { ?>
                                <img src="./upload/user/male.jpeg" alt="">
                            <?php } ?> 
                            <div class="avatar-button">
                                <div class="modal-trigger" data-modal="change-profile-modal">
                                    <i data-feather="camera"></i>
                                </div>
                            </div>
                        </div>
                        <div class="cover-overlay"></div>
                        <div class="cover-edit modal-trigger" data-modal="change-cover-modal">
                            <i class="mdi mdi-camera"></i>
                            <span>Edit cover image</span>
                        </div>
                        <!--/html/partials/pages/profile/timeline/dropdowns/timeline-mobile-dropdown.html-->
                        <div class="dropdown is-spaced is-right is-accent dropdown-trigger timeline-mobile-dropdown is-hidden-desktop">
                            <div>
                                <div class="button">
                                    <i data-feather="more-vertical"></i>
                                </div>
                            </div>
                            <div class="dropdown-menu" role="menu">
                                <div class="dropdown-content">
                                    <a href="/profile-main.html" class="dropdown-item">
                                        <div class="media">
                                            <i data-feather="activity"></i>
                                            <div class="media-content">
                                                <h3>Timeline</h3>
                                                <small>Open Timeline.</small>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="/profile-about.html" class="dropdown-item">
                                        <div class="media">
                                            <i data-feather="align-right"></i>
                                            <div class="media-content">
                                                <h3>About</h3>
                                                <small>See about info.</small>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="/profile-friends.html" class="dropdown-item">
                                        <div class="media">
                                            <i data-feather="heart"></i>
                                            <div class="media-content">
                                                <h3>Friends</h3>
                                                <small>See friends.</small>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="/profile-photos.html" class="dropdown-item">
                                        <div class="media">
                                            <i data-feather="image"></i>
                                            <div class="media-content">
                                                <h3>Photos</h3>
                                                <small>See all photos.</small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="profile-menu is-hidden-mobile">
                        <div class="menu-start">
                            <a href="profile-main.html" class="button has-min-width">Timeline</a>
                            <a href="profile-about.html" class="button has-min-width">About</a>
                        </div>
                        <div class="menu-end">
                            <a id="profile-friends-link" href="profile-friends.html" class="button has-min-width">Friends</a>
                            <a href="profile-photos.html" class="button has-min-width">Photos</a>
                        </div>
                    </div>

                    <div class="profile-subheader">
                        <div class="subheader-start">
                            <span><?php echo mysqli_num_rows($query_retrived_following); ?></span>
                            <span><a href="dummy_following.php?id=<?php echo $row['id'];?>">Following</a></span>
                        </div>
                        <div class="subheader-middle">
                            <h2 class="header-w-r">
                                <?php echo $row['fname'] ?>
                                <span class="rating_star">
                                    <span class="star-text">
                                        <?php  echo  getProfileRating($conn, $dummy_row['id']);?>/5
                                        <label class="star-checked">★</label>
                                    </span>
                                </span>
                            </h2>
                            <span>
                                <?php
                                $sq = mysqli_query($conn, "SELECT anonymous from gt_users where dummy_id='" . $_SESSION['id'] . "'");
                                $ro = mysqli_fetch_array($sq);
                                $anonymous_id = $ro['anonymous'];
                                $sql1 = mysqli_query($conn, "SELECT anonymous_name from gt_anonymous_name where id in (" . $anonymous_id . ")");
                                while ($row1 = @mysqli_fetch_array($sql1)) {
                                ?>
                                    <?php echo $row1['anonymous_name']; ?>
                                <?php } ?>
                            </span>
                            <span><a href="<?php echo $_SERVER['basename']; ?>" target="_blank"><?php echo $row['website']; ?></a></span>
                            <span><?php echo preg_replace("/[\n\r]/", "<br />", $row['bio']); ?></span> 
                        </div>
                        <div class="subheader-end subheader-start">
                            <span><?php echo mysqli_num_rows($query_retrived_followers); ?></span>
                            <span><a href="dummy_followers.php?id=<?php echo $row['id'];?>">Followers</a></span>
                        </div>
                    </div>
                </div>

            </div>

            <div class="columns">
                <div id="profile-timeline-widgets" class="column is-4">

                    <!-- Basic Infos widget -->
                    <!-- html/partials/pages/profile/timeline/widgets/basic-infos-widget.html -->
                    <div class="box-heading">
                        <h4><a href="change_interest.php" class="button is-active">Change Interest</a></h4>
                        <!-- <div class="button-wrap">
                                <button type="button" class="button is-active">Edit Profile</button> 
                            </div>  -->

                        <div class="cover-overlay"></div>
                        <div class="cover-edit modal-trigger edit_profile" data-modal="change-edit-profile">
                            <button type="button" class="button is-active">Edit Profile</button>
                        </div>



                    </div>

                     
                </div>

                <div class="column is-8">
                    <div id="profile-timeline-posts" class="box-heading">
                        <h4>Posts</h4>
                        <div class="button-wrap">
                            <button type="button" class="button is-active">Recent</button>
                            <button type="button" class="button">Popular</button>
                        </div>
                    </div>

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

                    $query = @mysqli_query($conn, "SELECT * FROM gt_posts WHERE user_id ='" . $dummy_row['id'] . "' AND  is_post='dummy'  ORDER BY id DESC");
                    while ($row = $query->fetch_assoc()) {
                        $get_user_query = mysqli_query($conn, "SELECT * FROM gt_users WHERE id ='" . $row['user_id'] . "'");
                        while ($row_user_query = $get_user_query->fetch_assoc()) {
                            $queryR = "SELECT p.*, COUNT(r.rating_number) as rating_num, FORMAT((SUM(r.rating_number) / COUNT(r.rating_number)),1) as average_rating, COUNT(r.user_id) as total_user FROM gt_posts as p LEFT JOIN rating as r ON r.post_id = p.id WHERE p.id = '" . $row['id'] . "' GROUP BY (r.post_id)";
                            $resultR = $conn->query($queryR);
                            $postData = $resultR->fetch_assoc();
                            $badgesId = $row_user_query['badges'];
                            $bsql = mysqli_query($conn, "SELECT title from gt_badges where id='" . $badgesId . "'");
                            $brow = mysqli_fetch_array($bsql);
                    ?>

                            <div class="card is-post">
                                <div class="content-wrap">
                                    <div class="card-heading">
                                        <div class="user-block">
                                            <div class="image">
                                                <?php
                                                if ($row_photo['photo'] != "" && $row_photo['status'] == 0) { ?>
                                                    <img src="<?php echo $row_photo['photo'] ?>" class="avatar-image" data-demo-src="assets/img/avatars/edward.jpeg" data-user-popover="5" alt="">
                                                <?php } else { ?>
                                                    <img src="./upload/user/male.jpeg" alt="">
                                                <?php } ?>
                                            </div>
                                            <div class="user-info">
                                                <div style="display: flex;">
                                                    <a href="main_user_profile.php?user_id=<?php echo $row_user_query['id']; ?>" class="d-flex-star" style="display: flex;">
                                                        <?php echo $row_user_query['fname']; ?> 
                                                        <span class="span-title d-flex-star">
                                                            <span class="rating_star-m">
                                                                <span class="star-textm">
                                                                    <?php  echo  getProfileRating($conn, $row_user_query['id']);?>/5
                                                                    <label class="star-checked">★</label>
                                                                </span>
                                                            </span>
                                                        </span>  
                                                    </a>
                                                </div>
                                                <div style="display: flex;">
                                                   
                                                        <?php
                                                            $sq = mysqli_query($conn, "SELECT anonymous from gt_users where id='" . $row_user_query['id'] . "'");
                                                            $ro = mysqli_fetch_array($sq);
                                                            $anonymous_id = $ro['anonymous'];
                                                            $sql1 = mysqli_query($conn, "SELECT anonymous_name from gt_anonymous_name where id in (" . $anonymous_id . ")");
                                                            while ($row1 = @mysqli_fetch_array($sql1)) {
                                                        ?>
                                                          <span class="time has-text-weight-medium">   <?php echo $row1['anonymous_name']; ?></span>
                                                          
                                                        <?php } ?>
                                                   

                                                </div>
                                            </div>
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
                                        <div class="post-link is-video">
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

                                            <div class="fab-wrapper is-share">
                                                <a href="javascript:void(0);" class="small-fab share-fab modal-trigger" data-modal="share-modal">
                                                    <i data-feather="link-2"></i>
                                                </a>
                                            </div>

                                            <div class="fab-wrapper is-comment ispostId" data-postid="<?php echo $row['id'] ?>">
                                                <a href="javascript:void(0);" class="small-fab get_post_id">
                                                    <i data-feather="message-circle"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer"> 
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
                                    </div> 
                                    <div class="comments-wrap is-hidden">
                                        <div class="comments-heading">
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
                                                            <p class="control">
                                                                <textarea class="textarea comment-textarea commentt" name="comment" rows="5" placeholder="Write a comment..." value="" 
                                                              style="width: 340px; height: 31px;"></textarea>
                                                            </p>
                                                            <input type="hidden" name="postId" class="postId" value="<?php echo $post_id; ?>" />
                                                            <input type="hidden" name="userId" class="userId" value="<?php echo $dummy_row['id']; ?>" />
                                                            <input type="hidden" name="commentId" class="commentId" value="0" />
                                                        </div>
                                                        <div class="actions">
                                                            <div class="image is-32x32">
                                                                <img class="is-rounded" src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" data-user-popover="0" alt="">
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
                                </div>
                        <?php }
                    } ?>

                            </div>
                </div>
            </div>
        </div>
        <!-- /Profile page main wrapper -->

    </div>
    <!-- /Container -->

    <!-- Change cover edit profile modal -->
    <!--html/partials/pages/profile/timeline/modals/change-cover-modal.html-->
    <div id="change-edit-profile" class="modal change-cover-modal is-medium has-light-bg">
        <div class="modal-background"></div>
        <div class="modal-content">

            <div class="card">
                <div class="card-heading">
                    <h3>Edit Profile</h3>
                    <!-- Close X button -->
                    <div class="close-wrap">
                        <span class="close-modal">
                            <i data-feather="x"></i>
                        </span>
                    </div>
                </div>
                <div id="signup-panel-1" class="process-panel-wrap is-active step1" style="padding: 20px 25px;">

                    <div class="form-panel">
                        <div class="field">
                            <!-- <label>First Name</label> -->
                            <div class="control">
                                <input type="hidden" class="input previous_name" name="firstname" value="<?php echo $dummy_row['fname'];?>"> 
                                <select name="cool_name" class="input edit_fname">  
                                    <?php
                                        $query = mysqli_query($conn, "SELECT * FROM cool_name WHERE status='0' OR name='".$dummy_row['fname']."'");
                                        $i = 0;
                                        while ($row = $query->fetch_assoc()) {
                                    ?>
                                    <option class="badges_checkbox" value="<?php echo $row['name']; ?>" <?php if($dummy_row['fname']==$row['name']) { echo 'selected'; } ?>><?php echo $row['name']; ?></option>
                                    <?php $i++; } ?>
                                </select>
                            </div>
                        </div> 
                        <div class="field">
                            <!-- <label>Website</label> -->
                            <div class="control">
                                <input type="text" class="input edit_website" name="web" id="web" placeholder="Enter Website Url">
                            </div>
                        </div>
                        <!-- <div class="field"> 
                                <div class="control">
                                    <input type="text" class="input" name="location" id="location" placeholder="Enter location">
                                </div>
                            </div>
                            <div class="field">
                                 
                                <div class="control">
                                    <input type="text" class="input" name="email"  id="reg_email" placeholder="Enter your email address">
                                </div>
                            </div> -->
                        <div class="field">
                            <!-- <label>Bio</label> -->
                            <div class="control">
                                <textarea type="text" class="input edit_bio" name="bio" placeholder="Enter Bio" style="width: 673px; height: 86px;"></textarea>
                            </div>
                        </div>

                        <div class="field">
                            <!-- <label>Bio</label> -->
                            <div class="control">
                                <a href="#" class="bg-blue-600 flex h-9 items-center justify-center rounded-md text-white px-5 font-medium save_profile">
                            </div>
                        </div> 
                        Save </a>
                    </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- Change cover image modal -->
    <!--html/partials/pages/profile/timeline/modals/change-cover-modal.html-->
    <div id="change-cover-modal" class="modal change-cover-modal is-medium has-light-bg">
        <div class="modal-background"></div>
        <div class="modal-content">

            <div class="card">
                <div class="card-heading">
                    <h3>Update Cover</h3>
                    <!-- Close X button -->
                    <div class="close-wrap">
                        <span class="close-modal">
                            <i data-feather="x"></i>
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Placeholder -->
                    <div class="selection-placeholder">
                        <div class="columns">
                            <div class="column is-6">
                                <!-- Selection box -->
                                <div class="selection-box modal-trigger">
                                    <div class="box-content">
                                        <img src="assets/img/illustrations/profile/upload-cover.svg" alt="">
                                        <div class="box-text">
                                            <span>Upload</span>
                                            <span>From your computer</span>
                                            <input type="hidden" name="ucp_id" id="ucp_id" value="<?php echo $dummy_row['id']; ?>">
                                            <input type="file" id="cover_file" name="cover_file" onChange=" return uploadDummyCoverPhoto();">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-6">
                                <!-- Selection box -->
                                <div class="selection-box modal-trigger">
                                    <div class="box-content">
                                        <img src="assets/img/illustrations/profile/change-cover.svg" alt="">
                                        <div class="box-text remove_cover_picture">
                                            <span>Remove</span>
                                            <span>Cover Photo</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Change profile pic modal -->
    <!--html/partials/pages/profile/timeline/modals/change-profile-pic-modal.html-->
    <div id="change-profile-modal" class="modal change-cover-modal is-medium has-light-bg">
        <div class="modal-background"></div>
        <div class="modal-content">

            <div class="card">
                <div class="card-heading">
                    <h3>Update Profile Photo</h3>
                    <!-- Close X button -->
                    <div class="close-wrap">
                        <span class="close-modal">
                            <i data-feather="x"></i>
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Placeholder -->
                    <div class="selection-placeholder">
                        <div class="columns">
                            <div class="column is-6">
                                <!-- Selection box -->
                                <div class="selection-box modal-trigger">
                                    <div class="box-content">
                                        <img src="assets/img/illustrations/profile/upload-cover.svg" alt="">
                                        <div class="box-text">
                                            <span>Upload</span>
                                            <span>From your computer</span>
                                            <input type="hidden" name="upp_id" id="upp_id" value="<?php echo $dummy_row['id']; ?>">
                                            <input type="file" id="upp_file" name='upp_file' onChange=" return uploadProfilePic();">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-6">
                                <!-- Selection box -->
                                <div class="selection-box modal-trigger">
                                    <div class="box-content">
                                        <img src="assets/img/illustrations/profile/change-cover.svg" alt="">
                                        <div class="box-text remove_profile_picture">
                                            <span>Remove</span>
                                            <span>Profile Photo</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- User photos and albums -->
    <!--html/partials/pages/profile/timeline/modals/user-photos-modal.html-->
    <div id="user-photos-modal" class="modal user-photos-modal is-medium has-light-bg">
        <div class="modal-background"></div>
        <div class="modal-content">
            <!-- Card -->
            <div class="card">
                <div class="card-heading">
                    <h3>Choose a picture</h3>
                    <!-- Close X button -->
                    <div class="close-wrap">
                        <span class="close-modal">
                            <i data-feather="x"></i>
                        </span>
                    </div>
                </div>
                <!-- Card body -->
                <div class="card-body">
                    <!-- Tabs -->
                    <div class="nav-tabs-wrapper">
                        <div class="tabs">
                            <ul class="is-faded">
                                <li class="is-active" data-tab="recent-photos"><a>Recent</a></li>
                                <li data-tab="all-photos"><a>Photos</a></li>
                                <li data-tab="photo-albums"><a>Albums</a></li>
                            </ul>
                        </div>

                        <!-- Recent Photos -->
                        <div id="recent-photos" class="tab-content has-slimscroll-md is-active">
                            <!-- Grid -->
                            <div class="image-grid">
                                <div class="columns is-multiline">
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/3.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/4.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/9.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/2.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/13.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/11.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/17.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/22.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/8.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/18.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/20.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/21.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- All photos -->
                        <div id="all-photos" class="tab-content has-slimscroll-md">
                            <!-- Grid -->
                            <div class="image-grid">
                                <div class="columns is-multiline">
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/19.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/25.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/23.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/28.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/34.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/27.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/18.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/30.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/26.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/29.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/20.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/17.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/11.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/24.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/32.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/31.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/33.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/35.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Load more images -->
                            <div class=" load-more-wrap has-text-centered">
                                <a href="#" class="load-more-button">Load More</a>
                            </div>
                            <!-- /Load more images -->
                        </div>

                        <!-- Albums -->
                        <div id="photo-albums" class="tab-content has-slimscroll-md">
                            <!-- Grid -->
                            <div class="albums-grid">
                                <div class="columns is-multiline">
                                    <!-- Album item -->
                                    <div class="column is-6">
                                        <div class="album-wrapper" data-album="album-photos-1">
                                            <div class="album-image">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/35.jpg" alt="">
                                            </div>
                                            <div class="album-meta">
                                                <div class="album-title">
                                                    <span>Design and Colors</span>
                                                    <span>Added on sep 06 2018</span>
                                                </div>
                                                <div class="image-count">
                                                    <i data-feather="image"></i>
                                                    <span>8</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Album item -->
                                    <div class="column is-6">
                                        <div class="album-wrapper" data-album="album-photos-2">
                                            <div class="album-image">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/19.jpg" alt="">
                                            </div>
                                            <div class="album-meta">
                                                <div class="album-title">
                                                    <span>Friends and Family</span>
                                                    <span>Added on jun 10 2016</span>
                                                </div>
                                                <div class="image-count">
                                                    <i data-feather="image"></i>
                                                    <span>29</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Album item -->
                                    <div class="column is-6">
                                        <div class="album-wrapper" data-album="album-photos-3">
                                            <div class="album-image">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/4.jpg" alt="">
                                            </div>
                                            <div class="album-meta">
                                                <div class="album-title">
                                                    <span>Trips and Travel</span>
                                                    <span>Added on feb 14 2017</span>
                                                </div>
                                                <div class="image-count">
                                                    <i data-feather="image"></i>
                                                    <span>12</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Album item -->
                                    <div class="column is-6">
                                        <div class="album-wrapper" data-album="album-photos-4">
                                            <div class="album-image">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/3.jpg" alt="">
                                            </div>
                                            <div class="album-meta">
                                                <div class="album-title">
                                                    <span>Summer 2017</span>
                                                    <span>Added on aug 23 2017</span>
                                                </div>
                                                <div class="image-count">
                                                    <i data-feather="image"></i>
                                                    <span>32</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Album item -->
                                    <div class="column is-6">
                                        <div class="album-wrapper" data-album="album-photos-5">
                                            <div class="album-image">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/20.jpg" alt="">
                                            </div>
                                            <div class="album-meta">
                                                <div class="album-title">
                                                    <span>Winter 2017</span>
                                                    <span>Added on jan 07 2017</span>
                                                </div>
                                                <div class="image-count">
                                                    <i data-feather="image"></i>
                                                    <span>7</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Album item -->
                                    <div class="column is-6">
                                        <div class="album-wrapper" data-album="album-photos-6">
                                            <div class="album-image">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/2.jpg" alt="">
                                            </div>
                                            <div class="album-meta">
                                                <div class="album-title">
                                                    <span>Thanksgiving 2017</span>
                                                    <span>Added on nov 30 2017</span>
                                                </div>
                                                <div class="image-count">
                                                    <i data-feather="image"></i>
                                                    <span>6</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Hidden Grid | Design and colors -->
                            <div id="album-photos-1" class="album-image-grid is-hidden">
                                <div class="album-info">
                                    <h4>Design and Colors | <small>8 photo(s)</small></h4>
                                    <a class="close-nested-photos">Go Back</a>
                                </div>
                                <div class="columns is-multiline">
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/35.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/17.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/30.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/28.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/32.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/27.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/18.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/26.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Load more images -->
                                <div class=" load-more-wrap has-text-centered">
                                    <a href="#" class="load-more-button">Load More</a>
                                </div>
                                <!-- /Load more images -->
                            </div>

                            <!-- Hidden Grid | Friends and Family -->
                            <div id="album-photos-2" class="album-image-grid is-hidden">
                                <div class="album-info">
                                    <h4>Friends and Family | <small>29 photo(s)</small></h4>
                                    <a class="close-nested-photos">Go Back</a>
                                </div>
                                <div class="columns is-multiline">
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/23.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/22.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/19.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/20.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/2.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/21.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/38.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/36.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/37.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Load more images -->
                                <div class=" load-more-wrap has-text-centered">
                                    <a href="#" class="load-more-button">Load More</a>
                                </div>
                                <!-- /Load more images -->
                            </div>

                            <!-- Hidden Grid | Trips and Travel -->
                            <div id="album-photos-3" class="album-image-grid is-hidden">
                                <div class="album-info">
                                    <h4>Trips and Travel | <small>12 photo(s)</small></h4>
                                    <a class="close-nested-photos">Go Back</a>
                                </div>
                                <div class="columns is-multiline">
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/4.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/6.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/5.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/38.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/37.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/18.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/19.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/3.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/32.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Hidden Grid | Summer 2017 -->
                            <div id="album-photos-4" class="album-image-grid is-hidden">
                                <div class="album-info">
                                    <h4>Summer 2017 | <small>32 photo(s)</small></h4>
                                    <a class="close-nested-photos">Go Back</a>
                                </div>
                                <div class="columns is-multiline">
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/4.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/6.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/5.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/38.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/37.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/18.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/19.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/3.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/32.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Load more images -->
                                <div class=" load-more-wrap has-text-centered">
                                    <a href="#" class="load-more-button">Load More</a>
                                </div>
                                <!-- /Load more images -->
                            </div>

                            <!-- Hidden Grid | Winter 2017 -->
                            <div id="album-photos-5" class="album-image-grid is-hidden">
                                <div class="album-info">
                                    <h4>Winter 2017 | <small>7 photo(s)</small></h4>
                                    <a class="close-nested-photos">Go Back</a>
                                </div>
                                <div class="columns is-multiline">
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/22.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/24.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/36.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/25.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/2.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/8.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/12.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Hidden Grid | Thanksgiving 2017 -->
                            <div id="album-photos-6" class="album-image-grid is-hidden">
                                <div class="album-info">
                                    <h4>Thanksgiving 2017 | <small>6 photo(s)</small></h4>
                                    <a class="close-nested-photos">Go Back</a>
                                </div>
                                <div class="columns is-multiline">
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/23.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/22.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/19.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/20.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/2.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Grid item -->
                                    <div class="column is-4">
                                        <div class="grid-image">
                                            <input type="radio" name="selected_photos">
                                            <div class="inner">
                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/21.jpg" alt="">
                                                <div class="inner-overlay"></div>
                                                <div class="indicator gelatine">
                                                    <i data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="button is-solid accent-button replace-button is-disabled">Use Picture</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Profile picture crop modal -->
    <!--html/partials/pages/profile/timeline/modals/upload-crop-profile-modal.html-->
    <div id="upload-crop-profile-modal" class="modal upload-crop-profile-modal is-xsmall has-light-bg">
        <div class="modal-background"></div>
        <div class="modal-content">

            <div class="card">
                <div class="card-heading">
                    <h3>Upload Picture</h3>
                    <!-- Close X button -->
                    <div class="close-wrap">
                        <span class="close-modal">
                            <i data-feather="x"></i>
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <label class="profile-uploader-box" for="upload-profile-picture">
                        <span class="inner-content">
                            <img src="assets/img/illustrations/profile/add-profile.svg" alt="">
                            <span>Click here to <br>upload a profile picture</span>
                        </span>
                        <input type="file" id="upload-profile-picture" accept="image/*">
                    </label>
                    <div class="upload-demo-wrap is-hidden">
                        <div id="upload-profile"></div>
                        <div class="upload-help">
                            <a id="profile-upload-reset" class="profile-reset is-hidden">Reset Picture</a>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button id="submit-profile-picture" class="button is-solid accent-button is-fullwidth raised is-disabled">Use Picture</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Cover image crop modal -->
    <!--html/partials/pages/profile/timeline/modals/upload-crop-cover-modal.html-->
    <div id="upload-crop-cover-modal" class="modal upload-crop-cover-modal is-large has-light-bg">
        <div class="modal-background"></div>
        <div class="modal-content">

            <div class="card">
                <div class="card-heading">
                    <h3>Upload Cover</h3>
                    <!-- Close X button -->
                    <div class="close-wrap">
                        <span class="close-modal">
                            <i data-feather="x"></i>
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <label class="cover-uploader-box" for="upload-cover-picture">
                        <span class="inner-content">
                            <img src="assets/img/illustrations/profile/add-cover.svg" alt="">
                            <span>Click here to <br>upload a cover image</span>
                        </span>
                        <input type="file" id="upload-cover-picture" accept="image/*">
                    </label>
                    <div class="upload-demo-wrap is-hidden">
                        <div id="upload-cover"></div>
                        <div class="upload-help">
                            <a id="cover-upload-reset" class="cover-reset is-hidden">Reset Picture</a>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button id="submit-cover-picture" class="button is-solid accent-button is-fullwidth raised is-disabled">Use
                        Picture</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Share modal -->
    <!-- /partials/pages/feed/modals/share-modal.html -->
    <div id="share-modal" class="modal share-modal is-xsmall has-light-bg">
        <div class="modal-background"></div>
        <div class="modal-content">

            <div class="card">
                <div class="card-heading">
                    <div class="dropdown is-primary share-dropdown">
                        <div>
                            <div class="button">
                                <i class="mdi mdi-format-float-left"></i> <span>Share in your feed</span> <i data-feather="chevron-down"></i>
                            </div>
                        </div>
                        <div class="dropdown-menu" role="menu">
                            <div class="dropdown-content">
                                <div class="dropdown-item" data-target-channel="feed">
                                    <div class="media">
                                        <i class="mdi mdi-format-float-left"></i>
                                        <div class="media-content">
                                            <h3>Share in your feed</h3>
                                            <small>Share this publication on your feed.</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-item" data-target-channel="friend">
                                    <div class="media">
                                        <i class="mdi mdi-account-heart"></i>
                                        <div class="media-content">
                                            <h3>Share in a friend's feed</h3>
                                            <small>Share this publication on a friend's feed.</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-item" data-target-channel="group">
                                    <div class="media">
                                        <i class="mdi mdi-account-group"></i>
                                        <div class="media-content">
                                            <h3>Share in a group</h3>
                                            <small>Share this publication in a group.</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-item" data-target-channel="page">
                                    <div class="media">
                                        <i class="mdi mdi-file-document-box"></i>
                                        <div class="media-content">
                                            <h3>Share in a page</h3>
                                            <small>Share this publication in a page.</small>
                                        </div>
                                    </div>
                                </div>
                                <hr class="dropdown-divider">
                                <div class="dropdown-item" data-target-channel="private-message">
                                    <div class="media">
                                        <i class="mdi mdi-email-plus"></i>
                                        <div class="media-content">
                                            <h3>Share in message</h3>
                                            <small>Share this publication in a private message.</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Close X button -->
                    <div class="close-wrap">
                        <span class="close-modal">
                            <i data-feather="x"></i>
                        </span>
                    </div>
                </div>
                <div class="share-inputs">
                    <div class="field is-autocomplete">
                        <div id="share-to-friend" class="control share-channel-control is-hidden">
                            <input id="share-with-friend" type="text" class="input is-sm no-radius share-input simple-users-autocpl" placeholder="Your friend's name">
                            <div class="input-heading">
                                Friend :
                            </div>
                        </div>
                    </div>

                    <div class="field is-autocomplete">
                        <div id="share-to-group" class="control share-channel-control is-hidden">
                            <input id="share-with-group" type="text" class="input is-sm no-radius share-input simple-groups-autocpl" placeholder="Your group's name">
                            <div class="input-heading">
                                Group :
                            </div>
                        </div>
                    </div>

                    <div id="share-to-page" class="control share-channel-control no-border is-hidden">
                        <div class="page-controls">
                            <div class="page-selection">

                                <div class="dropdown is-accent page-dropdown">
                                    <div>
                                        <div class="button page-selector">
                                            <img src="https://via.placeholder.com/150x150" data-demo-src="assets/img/avatars/hanzo.svg" alt=""> <span>Css Ninja</span> <i data-feather="chevron-down"></i>
                                        </div>
                                    </div>
                                    <div class="dropdown-menu" role="menu">
                                        <div class="dropdown-content">
                                            <div class="dropdown-item">
                                                <div class="media">
                                                    <img src="https://via.placeholder.com/150x150" data-demo-src="assets/img/avatars/hanzo.svg" alt="">
                                                    <div class="media-content">
                                                        <h3>Css Ninja</h3>
                                                        <small>Share on Css Ninja.</small>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="dropdown-item">
                                                <div class="media">
                                                    <img src="https://via.placeholder.com/150x150" data-demo-src="assets/img/icons/logos/nuclearjs.svg" alt="">
                                                    <div class="media-content">
                                                        <h3>NuclearJs</h3>
                                                        <small>Share on NuclearJs.</small>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="dropdown-item">
                                                <div class="media">
                                                    <img src="https://via.placeholder.com/150x150" data-demo-src="assets/img/icons/logos/slicer.svg" alt="">
                                                    <div class="media-content">
                                                        <h3>Slicer</h3>
                                                        <small>Share on Slicer.</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="alias">
                                <img src="https://via.placeholder.com/150x150" data-demo-src="assets/img/avatars/jenna.png" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="field is-autocomplete">
                        <div id="share-to-private-message" class="control share-channel-control is-hidden">
                            <input id="share-with-private-message" type="text" class="input is-sm no-radius share-input simple-users-autocpl" placeholder="Message a friend">
                            <div class="input-heading">
                                To :
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="control">
                        <textarea class="textarea comment-textarea" rows="1" placeholder="Say something about this ..."></textarea>
                        <button class="emoji-button">
                            <i data-feather="smile"></i>
                        </button>
                    </div>
                    <div class="shared-publication">
                        <div class="featured-image">
                            <img id="share-modal-image" src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/1.jpg" alt="">
                        </div>
                        <div class="publication-meta">
                            <div class="inner-flex">
                                <img id="share-modal-avatar" src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/dan.jpg" data-user-popover="1" alt="">
                                <p id="share-modal-text">Yesterday with <a href="#">@Karen Miller</a> and <a href="#">@Marvin Stemperd</a> at the
                                    <a href="#">#Rock'n'Rolla</a> concert in LA. Was totally fantastic! People were really
                                    excited about this one!
                                </p>
                            </div>
                            <div class="publication-footer">
                                <div class="stats">
                                    <div class="stat-block">
                                        <i class="mdi mdi-earth"></i>
                                        <small>Public</small>
                                    </div>
                                    <div class="stat-block">
                                        <i class="mdi mdi-eye"></i>
                                        <small>163 views</small>
                                    </div>
                                </div>
                                <div class="publication-origin">
                                    <small>Friendkit.io</small>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="bottom-share-inputs">

                    <div id="action-place" class="field is-autocomplete is-dropup is-hidden">
                        <div id="share-place" class="control share-bottom-channel-control">
                            <input type="text" class="input is-sm no-radius share-input simple-locations-autocpl" placeholder="Where are you?">
                            <div class="input-heading">
                                Location :
                            </div>
                        </div>
                    </div>

                    <div id="action-tag" class="field is-autocomplete is-dropup is-hidden">
                        <div id="share-tags" class="control share-bottom-channel-control">
                            <input id="share-friend-tags-autocpl" type="text" class="input is-sm no-radius share-input" placeholder="Who are you with">
                            <div class="input-heading">
                                Friends :
                            </div>
                        </div>
                        <div id="share-modal-tag-list" class="tag-list no-margin"></div>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="action-wrap">
                        <div class="footer-action" data-target-action="tag">
                            <i class="mdi mdi-account-plus"></i>
                        </div>
                        <div class="footer-action" data-target-action="place">
                            <i class="mdi mdi-map-marker"></i>
                        </div>
                        <div class="footer-action dropdown is-spaced is-neutral dropdown-trigger is-up" data-target-action="permissions">
                            <div>
                                <i class="mdi mdi-lock-clock"></i>
                            </div>
                            <div class="dropdown-menu" role="menu">
                                <div class="dropdown-content">
                                    <a href="#" class="dropdown-item">
                                        <div class="media">
                                            <i data-feather="globe"></i>
                                            <div class="media-content">
                                                <h3>Public</h3>
                                                <small>Anyone can see this publication.</small>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item">
                                        <div class="media">
                                            <i data-feather="users"></i>
                                            <div class="media-content">
                                                <h3>Friends</h3>
                                                <small>only friends can see this publication.</small>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item">
                                        <div class="media">
                                            <i data-feather="user"></i>
                                            <div class="media-content">
                                                <h3>Specific friends</h3>
                                                <small>Don't show it to some friends.</small>
                                            </div>
                                        </div>
                                    </a>
                                    <hr class="dropdown-divider">
                                    <a class="dropdown-item">
                                        <div class="media">
                                            <i data-feather="lock"></i>
                                            <div class="media-content">
                                                <h3>Only me</h3>
                                                <small>Only me can see this publication.</small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="button-wrap">
                        <button type="button" class="button is-solid dark-grey-button close-modal">Cancel</button>
                        <button type="button" class="button is-solid primary-button close-modal">Publish</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>

    <div class="chat-wrapper">
        <div class="chat-inner">

            <!-- Chat top navigation -->
            <div class="chat-nav">
                <div class="nav-start">
                    <div class="recipient-block">
                        <div class="avatar-container">
                            <img class="user-avatar" src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/dan.jpg" alt="">
                        </div>
                        <div class="username">
                            <span>Dan Walker</span>
                            <span><i data-feather="star"></i> <span>| Online</span></span>
                        </div>
                    </div>
                </div>
                <div class="nav-end">

                    <!-- Settings icon dropdown -->
                    <div class="dropdown is-spaced is-neutral is-right dropdown-trigger">
                        <div>
                            <a class="chat-nav-item is-icon">
                                <i data-feather="settings"></i>
                            </a>
                        </div>
                        <div class="dropdown-menu" role="menu">
                            <div class="dropdown-content">
                                <a href="#" class="dropdown-item">
                                    <div class="media">
                                        <i data-feather="message-square"></i>
                                        <div class="media-content">
                                            <h3>Details</h3>
                                            <small>View this conversation's details.</small>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item">
                                    <div class="media">
                                        <i data-feather="settings"></i>
                                        <div class="media-content">
                                            <h3>Preferences</h3>
                                            <small>Define your preferences.</small>
                                        </div>
                                    </div>
                                </a>
                                <hr class="dropdown-divider">
                                <a class="dropdown-item">
                                    <div class="media">
                                        <i data-feather="bell"></i>
                                        <div class="media-content">
                                            <h3>Notifications</h3>
                                            <small>Set notifications settings.</small>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item">
                                    <div class="media">
                                        <i data-feather="bell-off"></i>
                                        <div class="media-content">
                                            <h3>Silence</h3>
                                            <small>Disable notifications.</small>
                                        </div>
                                    </div>
                                </a>
                                <hr class="dropdown-divider">
                                <a class="dropdown-item">
                                    <div class="media">
                                        <i data-feather="box"></i>
                                        <div class="media-content">
                                            <h3>Archive</h3>
                                            <small>Archive this conversation.</small>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item">
                                    <div class="media">
                                        <i data-feather="trash-2"></i>
                                        <div class="media-content">
                                            <h3>Delete</h3>
                                            <small>Delete this conversation.</small>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="chat-search">
                        <div class="control has-icon">
                            <input type="text" class="input" placeholder="Search messages">
                            <div class="form-icon">
                                <i data-feather="search"></i>
                            </div>
                        </div>
                    </div>
                    <a class="chat-nav-item is-icon is-hidden-mobile">
                        <i data-feather="at-sign"></i>
                    </a>
                    <a class="chat-nav-item is-icon is-hidden-mobile">
                        <i data-feather="star"></i>
                    </a>

                    <!-- More dropdown -->
                    <div class="dropdown is-spaced is-neutral is-right dropdown-trigger">
                        <div>
                            <a class="chat-nav-item is-icon no-margin">
                                <i data-feather="more-vertical"></i>
                            </a>
                        </div>
                        <div class="dropdown-menu" role="menu">
                            <div class="dropdown-content">
                                <a href="#" class="dropdown-item">
                                    <div class="media">
                                        <i data-feather="file-text"></i>
                                        <div class="media-content">
                                            <h3>Files</h3>
                                            <small>View all your files.</small>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item">
                                    <div class="media">
                                        <i data-feather="users"></i>
                                        <div class="media-content">
                                            <h3>Users</h3>
                                            <small>View all users you're talking to.</small>
                                        </div>
                                    </div>
                                </a>
                                <hr class="dropdown-divider">
                                <a class="dropdown-item">
                                    <div class="media">
                                        <i data-feather="gift"></i>
                                        <div class="media-content">
                                            <h3>Daily bonus</h3>
                                            <small>Get your daily bonus.</small>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item">
                                    <div class="media">
                                        <i data-feather="download-cloud"></i>
                                        <div class="media-content">
                                            <h3>Downloads</h3>
                                            <small>See all your downloads.</small>
                                        </div>
                                    </div>
                                </a>
                                <hr class="dropdown-divider">
                                <a class="dropdown-item">
                                    <div class="media">
                                        <i data-feather="life-buoy"></i>
                                        <div class="media-content">
                                            <h3>Support</h3>
                                            <small>Reach our support team.</small>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <a class="chat-nav-item is-icon close-chat">
                        <i data-feather="x"></i>
                    </a>
                </div>
            </div>
            <!-- Chat sidebar -->
            <div id="chat-sidebar" class="users-sidebar">
                <!-- Header -->
                <div class="header-item">
                    <img class="light-image" src="assets/img/logo/friendkit-bold.svg" alt="">
                    <img class="dark-image" src="assets/img/logo/friendkit-white.svg" alt="">
                </div>
                <!-- User list -->
                <div class="conversations-list has-slimscroll-xs">
                    <!-- User -->
                    <div class="user-item is-active" data-chat-user="dan" data-full-name="Dan Walker" data-status="Online">
                        <div class="avatar-container">
                            <img class="user-avatar" src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/dan.jpg" alt="">
                            <div class="user-status is-online"></div>
                        </div>
                    </div>
                    <!-- User -->
                    <div class="user-item" data-chat-user="stella" data-full-name="Stella Bergmann" data-status="Busy">
                        <div class="avatar-container">
                            <img class="user-avatar" src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/stella.jpg" alt="">
                            <div class="user-status is-busy"></div>
                        </div>
                    </div>
                    <!-- User -->
                    <div class="user-item" data-chat-user="daniel" data-full-name="Daniel Wellington" data-status="Away">
                        <div class="avatar-container">
                            <img class="user-avatar" src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/daniel.jpg" alt="">
                            <div class="user-status is-away"></div>
                        </div>
                    </div>
                    <!-- User -->
                    <div class="user-item" data-chat-user="david" data-full-name="David Kim" data-status="Busy">
                        <div class="avatar-container">
                            <img class="user-avatar" src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/david.jpg" alt="">
                            <div class="user-status is-busy"></div>
                        </div>
                    </div>
                    <!-- User -->
                    <div class="user-item" data-chat-user="edward" data-full-name="Edward Mayers" data-status="Online">
                        <div class="avatar-container">
                            <img class="user-avatar" src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/edward.jpeg" alt="">
                            <div class="user-status is-online"></div>
                        </div>
                    </div>
                    <!-- User -->
                    <div class="user-item" data-chat-user="elise" data-full-name="Elise Walker" data-status="Away">
                        <div class="avatar-container">
                            <img class="user-avatar" src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/elise.jpg" alt="">
                            <div class="user-status is-away"></div>
                        </div>
                    </div>
                    <!-- User -->
                    <div class="user-item" data-chat-user="nelly" data-full-name="Nelly Schwartz" data-status="Busy">
                        <div class="avatar-container">
                            <img class="user-avatar" src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/nelly.png" alt="">
                            <div class="user-status is-busy"></div>
                        </div>
                    </div>
                    <!-- User -->
                    <div class="user-item" data-chat-user="milly" data-full-name="Milly Augustine" data-status="Busy">
                        <div class="avatar-container">
                            <img class="user-avatar" src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/milly.jpg" alt="">
                            <div class="user-status is-busy"></div>
                        </div>
                    </div>
                </div>
                <!-- Add Conversation -->
                <div class="footer-item">
                    <div class="add-button modal-trigger" data-modal="add-conversation-modal"><i data-feather="user"></i></div>
                </div>
            </div>

            <!-- Chat body -->
            <div id="chat-body" class="chat-body is-opened">
                <!-- Conversation with Dan -->
                <div id="dan-conversation" class="chat-body-inner has-slimscroll">
                    <div class="date-divider">
                        <hr class="date-divider-line">
                        <span class="date-divider-text">Today</span>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/dan.jpg" alt="">
                        <div class="message-block">
                            <span>8:03am</span>
                            <div class="message-text">Hi Jenna! I made a new design, and i wanted to show it to you.</div>
                        </div>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/dan.jpg" alt="">
                        <div class="message-block">
                            <span>8:03am</span>
                            <div class="message-text">It's quite clean and it's inspired from Bulkit.</div>
                        </div>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>8:12am</span>
                            <div class="message-text">Oh really??! I want to see that.</div>
                        </div>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/dan.jpg" alt="">
                        <div class="message-block">
                            <span>8:13am</span>
                            <div class="message-text">FYI it was done in less than a day.</div>
                        </div>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>8:17am</span>
                            <div class="message-text">Great to hear it. Just send me the PSD files so i can have a look at it.</div>
                        </div>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>8:18am</span>
                            <div class="message-text">And if you have a prototype, you can also send me the link to it.</div>
                        </div>
                    </div>
                </div>
                <!-- Conversation with Stella -->
                <div id="stella-conversation" class="chat-body-inner has-slimscroll is-hidden">
                    <div class="date-divider">
                        <hr class="date-divider-line">
                        <span class="date-divider-text">Today</span>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>10:34am</span>
                            <div class="message-text">Hey Stella! Aren't we supposed to go the theatre after work?.</div>
                        </div>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>10:37am</span>
                            <div class="message-text">Just remembered it.</div>
                        </div>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/stella.jpg" alt="">
                        <div class="message-block">
                            <span>11:22am</span>
                            <div class="message-text">Yeah you always do that, forget about everything.</div>
                        </div>
                    </div>
                </div>
                <!-- Conversation with Daniel -->
                <div id="daniel-conversation" class="chat-body-inner has-slimscroll is-hidden">
                    <div class="date-divider">
                        <hr class="date-divider-line">
                        <span class="date-divider-text">Yesterday</span>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>3:24pm</span>
                            <div class="message-text">Daniel, Amanda told me about your issue, how can I help?</div>
                        </div>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/daniel.jpg" alt="">
                        <div class="message-block">
                            <span>3:42pm</span>
                            <div class="message-text">Hey Jenna, thanks for answering so quickly. Iam stuck, i need a car.</div>
                        </div>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/daniel.jpg" alt="">
                        <div class="message-block">
                            <span>3:43pm</span>
                            <div class="message-text">Can i borrow your car for a quick ride to San Fransisco? Iam running behind and
                                there' no train in sight.</div>
                        </div>
                    </div>
                </div>
                <!-- Conversation with David -->
                <div id="david-conversation" class="chat-body-inner has-slimscroll is-hidden">
                    <div class="date-divider">
                        <hr class="date-divider-line">
                        <span class="date-divider-text">Today</span>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>12:34pm</span>
                            <div class="message-text">Damn you! Why would you even implement this in the game?.</div>
                        </div>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>12:32pm</span>
                            <div class="message-text">I just HATE aliens.</div>
                        </div>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/david.jpg" alt="">
                        <div class="message-block">
                            <span>13:09pm</span>
                            <div class="message-text">C'mon, you just gotta learn the tricks. You can't expect aliens to behave like
                                humans. I mean that's how the mechanics are.</div>
                        </div>
                    </div>
                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/david.jpg" alt="">
                        <div class="message-block">
                            <span>13:11pm</span>
                            <div class="message-text">I checked the replay and for example, you always get supply blocked. That's not
                                the right thing to do.</div>
                        </div>
                    </div>
                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>13:12pm</span>
                            <div class="message-text">I know but i struggle when i have to decide what to make from larvas.</div>
                        </div>
                    </div>
                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/david.jpg" alt="">
                        <div class="message-block">
                            <span>13:17pm</span>
                            <div class="message-text">Join me in game, i'll show you.</div>
                        </div>
                    </div>
                </div>
                <!-- Conversation with Edward -->
                <div id="edward-conversation" class="chat-body-inner has-slimscroll">
                    <div class="date-divider">
                        <hr class="date-divider-line">
                        <span class="date-divider-text">Monday</span>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/edward.jpeg" alt="">
                        <div class="message-block">
                            <span>4:55pm</span>
                            <div class="message-text">Hey Jenna, what's up?</div>
                        </div>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/edward.jpeg" alt="">
                        <div class="message-block">
                            <span>4:56pm</span>
                            <div class="message-text">Iam coming to LA tomorrow. Interested in having lunch?</div>
                        </div>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>5:21pm</span>
                            <div class="message-text">Hey mate, it's been a while. Sure I would love to.</div>
                        </div>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/edward.jpeg" alt="">
                        <div class="message-block">
                            <span>5:27pm</span>
                            <div class="message-text">Ok. Let's say i pick you up at 12:30 at work, works?</div>
                        </div>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>5:43pm</span>
                            <div class="message-text">Yup, that works great.</div>
                        </div>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>5:44pm</span>
                            <div class="message-text">And yeah, don't forget to bring some of my favourite cheese cake.</div>
                        </div>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/edward.jpeg" alt="">
                        <div class="message-block">
                            <span>5:27pm</span>
                            <div class="message-text">No worries</div>
                        </div>
                    </div>
                </div>
                <!-- Conversation with Edward -->
                <div id="elise-conversation" class="chat-body-inner has-slimscroll is-hidden">
                    <div class="date-divider">
                        <hr class="date-divider-line">
                        <span class="date-divider-text">September 28</span>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>11:53am</span>
                            <div class="message-text">Elise, i forgot my folder at your place yesterday.</div>
                        </div>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>11:53am</span>
                            <div class="message-text">I need it badly, it's work stuff.</div>
                        </div>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/elise.jpg" alt="">
                        <div class="message-block">
                            <span>12:19pm</span>
                            <div class="message-text">Yeah i noticed. I'll drop it in half an hour at your office.</div>
                        </div>
                    </div>
                </div>
                <!-- Conversation with Nelly -->
                <div id="nelly-conversation" class="chat-body-inner has-slimscroll is-hidden">
                    <div class="date-divider">
                        <hr class="date-divider-line">
                        <span class="date-divider-text">September 17</span>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>8:22pm</span>
                            <div class="message-text">So you watched the movie?</div>
                        </div>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>8:22pm</span>
                            <div class="message-text">Was it scary?</div>
                        </div>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/nelly.png" alt="">
                        <div class="message-block">
                            <span>9:03pm</span>
                            <div class="message-text">It was so frightening, i felt my heart was about to blow inside my chest.</div>
                        </div>
                    </div>
                </div>
                <!-- Conversation with Milly -->
                <div id="milly-conversation" class="chat-body-inner has-slimscroll">
                    <div class="date-divider">
                        <hr class="date-divider-line">
                        <span class="date-divider-text">Today</span>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/milly.jpg" alt="">
                        <div class="message-block">
                            <span>2:01pm</span>
                            <div class="message-text">Hello Jenna, did you read my proposal?</div>
                        </div>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/milly.jpg" alt="">
                        <div class="message-block">
                            <span>2:01pm</span>
                            <div class="message-text">Didn't hear from you since i sent it.</div>
                        </div>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>2:02pm</span>
                            <div class="message-text">Hello Milly, Iam really sorry, Iam so busy recently, but i had the time to read
                                it.</div>
                        </div>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/milly.jpg" alt="">
                        <div class="message-block">
                            <span>2:04pm</span>
                            <div class="message-text">And what did you think about it?</div>
                        </div>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>2:05pm</span>
                            <div class="message-text">Actually it's quite good, there might be some small changes but overall it's
                                great.</div>
                        </div>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>2:07pm</span>
                            <div class="message-text">I think that i can give it to my boss at this stage.</div>
                        </div>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/milly.jpg" alt="">
                        <div class="message-block">
                            <span>2:09pm</span>
                            <div class="message-text">Crossing fingers then</div>
                        </div>
                    </div>
                </div>
                <!-- Compose message area -->
                <div class="chat-action">
                    <div class="chat-action-inner">
                        <div class="control">
                            <textarea class="textarea comment-textarea" rows="1"></textarea>
                            <div class="dropdown compose-dropdown is-spaced is-accent is-up dropdown-trigger">
                                <div>
                                    <div class="add-button">
                                        <div class="button-inner">
                                            <i data-feather="plus"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-menu" role="menu">
                                    <div class="dropdown-content">
                                        <a href="#" class="dropdown-item">
                                            <div class="media">
                                                <i data-feather="code"></i>
                                                <div class="media-content">
                                                    <h3>Code snippet</h3>
                                                    <small>Add and paste a code snippet.</small>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item">
                                            <div class="media">
                                                <i data-feather="file-text"></i>
                                                <div class="media-content">
                                                    <h3>Note</h3>
                                                    <small>Add and paste a note.</small>
                                                </div>
                                            </div>
                                        </a>
                                        <hr class="dropdown-divider">
                                        <a class="dropdown-item">
                                            <div class="media">
                                                <i data-feather="server"></i>
                                                <div class="media-content">
                                                    <h3>Remote file</h3>
                                                    <small>Add a file from a remote drive.</small>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item">
                                            <div class="media">
                                                <i data-feather="monitor"></i>
                                                <div class="media-content">
                                                    <h3>Local file</h3>
                                                    <small>Add a file from your computer.</small>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div id="chat-panel" class="chat-panel is-opened">
                <div class="panel-inner">
                    <div class="panel-header">
                        <h3>Details</h3>
                        <div class="panel-close">
                            <i data-feather="x"></i>
                        </div>
                    </div>

                    <!-- Dan details -->
                    <div id="dan-details" class="panel-body is-user-details">
                        <div class="panel-body-inner">

                            <div class="subheader">
                                <div class="action-icon">
                                    <i class="mdi mdi-video"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-camera"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-microphone"></i>
                                </div>
                                <div class="dropdown details-dropdown is-spaced is-neutral is-right dropdown-trigger ml-auto">
                                    <div>
                                        <div class="action-icon">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </div>
                                    </div>
                                    <div class="dropdown-menu" role="menu">
                                        <div class="dropdown-content">
                                            <a href="#" class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="user"></i>
                                                    <div class="media-content">
                                                        <h3>View profile</h3>
                                                        <small>View this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="mail"></i>
                                                    <div class="media-content">
                                                        <h3>Send message</h3>
                                                        <small>Send a message to the user's inbox.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <hr class="dropdown-divider">
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="share-2"></i>
                                                    <div class="media-content">
                                                        <h3>Share profile</h3>
                                                        <small>Share this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="x"></i>
                                                    <div class="media-content">
                                                        <h3>Block user</h3>
                                                        <small>Block this user permanently.</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="details-avatar">
                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/dan.jpg" alt="">
                                <div class="call-me">
                                    <i class="mdi mdi-phone"></i>
                                </div>
                            </div>

                            <div class="user-meta has-text-centered">
                                <h3>Dan Walker</h3>
                                <h4>IOS Developer</h4>
                            </div>

                            <div class="user-badges">
                                <div class="hexagon is-red">
                                    <div>
                                        <i class="mdi mdi-heart"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-green">
                                    <div>
                                        <i class="mdi mdi-dog"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-accent">
                                    <div>
                                        <i class="mdi mdi-flash"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-blue">
                                    <div>
                                        <i class="mdi mdi-briefcase"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="user-about">
                                <label>About Me</label>
                                <div class="about-block">
                                    <i class="mdi mdi-domain"></i>
                                    <div class="about-text">
                                        <span>Works at</span>
                                        <span><a class="is-inverted" href="#">WebSmash Inc.</a></span>
                                    </div>
                                </div>
                                <div class="about-block">
                                    <i class="mdi mdi-school"></i>
                                    <div class="about-text">
                                        <span>Studied at</span>
                                        <span><a class="is-inverted" href="#">Riverdale University</a></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Stella details -->
                    <div id="stella-details" class="panel-body is-user-details is-hidden">
                        <div class="panel-body-inner">

                            <div class="subheader">
                                <div class="action-icon">
                                    <i class="mdi mdi-video"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-camera"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-microphone"></i>
                                </div>
                                <div class="dropdown details-dropdown is-spaced is-neutral is-right dropdown-trigger ml-auto">
                                    <div>
                                        <div class="action-icon">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </div>
                                    </div>
                                    <div class="dropdown-menu" role="menu">
                                        <div class="dropdown-content">
                                            <a href="#" class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="user"></i>
                                                    <div class="media-content">
                                                        <h3>View profile</h3>
                                                        <small>View this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="mail"></i>
                                                    <div class="media-content">
                                                        <h3>Send message</h3>
                                                        <small>Send a message to the user's inbox.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <hr class="dropdown-divider">
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="share-2"></i>
                                                    <div class="media-content">
                                                        <h3>Share profile</h3>
                                                        <small>Share this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="x"></i>
                                                    <div class="media-content">
                                                        <h3>Block user</h3>
                                                        <small>Block this user permanently.</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="details-avatar">
                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/stella.jpg" alt="">
                                <div class="call-me">
                                    <i class="mdi mdi-phone"></i>
                                </div>
                            </div>

                            <div class="user-meta has-text-centered">
                                <h3>Stella Bergmann</h3>
                                <h4>Shop Owner</h4>
                            </div>

                            <div class="user-badges">
                                <div class="hexagon is-purple">
                                    <div>
                                        <i class="mdi mdi-bomb"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-red">
                                    <div>
                                        <i class="mdi mdi-check-decagram"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-accent">
                                    <div>
                                        <i class="mdi mdi-flash"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="user-about">
                                <label>About Me</label>
                                <div class="about-block">
                                    <i class="mdi mdi-domain"></i>
                                    <div class="about-text">
                                        <span>Works at</span>
                                        <span><a class="is-inverted" href="#">Trending Fashions</a></span>
                                    </div>
                                </div>
                                <div class="about-block">
                                    <i class="mdi mdi-map-marker"></i>
                                    <div class="about-text">
                                        <span>From</span>
                                        <span><a class="is-inverted" href="#">Oklahoma City</a></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Daniel details -->
                    <div id="daniel-details" class="panel-body is-user-details is-hidden">
                        <div class="panel-body-inner">

                            <div class="subheader">
                                <div class="action-icon">
                                    <i class="mdi mdi-video"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-camera"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-microphone"></i>
                                </div>
                                <div class="dropdown details-dropdown is-spaced is-neutral is-right dropdown-trigger ml-auto">
                                    <div>
                                        <div class="action-icon">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </div>
                                    </div>
                                    <div class="dropdown-menu" role="menu">
                                        <div class="dropdown-content">
                                            <a href="#" class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="user"></i>
                                                    <div class="media-content">
                                                        <h3>View profile</h3>
                                                        <small>View this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="mail"></i>
                                                    <div class="media-content">
                                                        <h3>Send message</h3>
                                                        <small>Send a message to the user's inbox.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <hr class="dropdown-divider">
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="share-2"></i>
                                                    <div class="media-content">
                                                        <h3>Share profile</h3>
                                                        <small>Share this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="x"></i>
                                                    <div class="media-content">
                                                        <h3>Block user</h3>
                                                        <small>Block this user permanently.</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="details-avatar">
                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/daniel.jpg" alt="">
                                <div class="call-me">
                                    <i class="mdi mdi-phone"></i>
                                </div>
                            </div>

                            <div class="user-meta has-text-centered">
                                <h3>Daniel Wellington</h3>
                                <h4>Senior Executive</h4>
                            </div> 
                            <div class="user-badges">
                                <div class="hexagon is-accent">
                                    <div>
                                        <i class="mdi mdi-google-cardboard"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-blue">
                                    <div>
                                        <i class="mdi mdi-pizza"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-accent">
                                    <div>
                                        <i class="mdi mdi-linux"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-red">
                                    <div>
                                        <i class="mdi mdi-puzzle"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="user-about">
                                <label>About Me</label>
                                <div class="about-block">
                                    <i class="mdi mdi-domain"></i>
                                    <div class="about-text">
                                        <span>Works at</span>
                                        <span><a class="is-inverted" href="#">Peelman & Sons</a></span>
                                    </div>
                                </div>
                                <div class="about-block">
                                    <i class="mdi mdi-map-marker"></i>
                                    <div class="about-text">
                                        <span>From</span>
                                        <span><a class="is-inverted" href="#">Los Angeles</a></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- David details -->
                    <div id="david-details" class="panel-body is-user-details is-hidden">
                        <div class="panel-body-inner"> 
                            <div class="subheader">
                                <div class="action-icon">
                                    <i class="mdi mdi-video"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-camera"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-microphone"></i>
                                </div>
                                <div class="dropdown details-dropdown is-spaced is-neutral is-right dropdown-trigger ml-auto">
                                    <div>
                                        <div class="action-icon">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </div>
                                    </div>
                                    <div class="dropdown-menu" role="menu">
                                        <div class="dropdown-content">
                                            <a href="#" class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="user"></i>
                                                    <div class="media-content">
                                                        <h3>View profile</h3>
                                                        <small>View this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="mail"></i>
                                                    <div class="media-content">
                                                        <h3>Send message</h3>
                                                        <small>Send a message to the user's inbox.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <hr class="dropdown-divider">
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="share-2"></i>
                                                    <div class="media-content">
                                                        <h3>Share profile</h3>
                                                        <small>Share this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="x"></i>
                                                    <div class="media-content">
                                                        <h3>Block user</h3>
                                                        <small>Block this user permanently.</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="details-avatar">
                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/david.jpg" alt="">
                                <div class="call-me">
                                    <i class="mdi mdi-phone"></i>
                                </div>
                            </div>

                            <div class="user-meta has-text-centered">
                                <h3>David Kim</h3>
                                <h4>Senior Developer</h4>
                            </div>

                            <div class="user-badges">
                                <div class="hexagon is-red">
                                    <div>
                                        <i class="mdi mdi-heart"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-green">
                                    <div>
                                        <i class="mdi mdi-dog"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-accent">
                                    <div>
                                        <i class="mdi mdi-flash"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-blue">
                                    <div>
                                        <i class="mdi mdi-briefcase"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="user-about">
                                <label>About Me</label>
                                <div class="about-block">
                                    <i class="mdi mdi-domain"></i>
                                    <div class="about-text">
                                        <span>Works at</span>
                                        <span><a class="is-inverted" href="#">Frost Entertainment</a></span>
                                    </div>
                                </div>
                                <div class="about-block">
                                    <i class="mdi mdi-map-marker"></i>
                                    <div class="about-text">
                                        <span>From</span>
                                        <span><a class="is-inverted" href="#">Chicago</a></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Edward details -->
                    <div id="edward-details" class="panel-body is-user-details is-hidden">
                        <div class="panel-body-inner">

                            <div class="subheader">
                                <div class="action-icon">
                                    <i class="mdi mdi-video"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-camera"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-microphone"></i>
                                </div>
                                <div class="dropdown details-dropdown is-spaced is-neutral is-right dropdown-trigger ml-auto">
                                    <div>
                                        <div class="action-icon">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </div>
                                    </div>
                                    <div class="dropdown-menu" role="menu">
                                        <div class="dropdown-content">
                                            <a href="#" class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="user"></i>
                                                    <div class="media-content">
                                                        <h3>View profile</h3>
                                                        <small>View this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="mail"></i>
                                                    <div class="media-content">
                                                        <h3>Send message</h3>
                                                        <small>Send a message to the user's inbox.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <hr class="dropdown-divider">
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="share-2"></i>
                                                    <div class="media-content">
                                                        <h3>Share profile</h3>
                                                        <small>Share this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="x"></i>
                                                    <div class="media-content">
                                                        <h3>Block user</h3>
                                                        <small>Block this user permanently.</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="details-avatar">
                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/edward.jpeg" alt="">
                                <div class="call-me">
                                    <i class="mdi mdi-phone"></i>
                                </div>
                            </div>

                            <div class="user-meta has-text-centered">
                                <h3>Edward Mayers</h3>
                                <h4>Financial analyst</h4>
                            </div>

                            <div class="user-badges">
                                <div class="hexagon is-red">
                                    <div>
                                        <i class="mdi mdi-heart"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-green">
                                    <div>
                                        <i class="mdi mdi-dog"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-accent">
                                    <div>
                                        <i class="mdi mdi-flash"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="user-about">
                                <label>About Me</label>
                                <div class="about-block">
                                    <i class="mdi mdi-domain"></i>
                                    <div class="about-text">
                                        <span>Works at</span>
                                        <span><a class="is-inverted" href="#">Brettmann Bank</a></span>
                                    </div>
                                </div>
                                <div class="about-block">
                                    <i class="mdi mdi-map-marker"></i>
                                    <div class="about-text">
                                        <span>From</span>
                                        <span><a class="is-inverted" href="#">Santa Fe</a></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Elise details -->
                    <div id="elise-details" class="panel-body is-user-details is-hidden">
                        <div class="panel-body-inner">

                            <div class="subheader">
                                <div class="action-icon">
                                    <i class="mdi mdi-video"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-camera"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-microphone"></i>
                                </div>
                                <div class="dropdown details-dropdown is-spaced is-neutral is-right dropdown-trigger ml-auto">
                                    <div>
                                        <div class="action-icon">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </div>
                                    </div>
                                    <div class="dropdown-menu" role="menu">
                                        <div class="dropdown-content">
                                            <a href="#" class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="user"></i>
                                                    <div class="media-content">
                                                        <h3>View profile</h3>
                                                        <small>View this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="mail"></i>
                                                    <div class="media-content">
                                                        <h3>Send message</h3>
                                                        <small>Send a message to the user's inbox.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <hr class="dropdown-divider">
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="share-2"></i>
                                                    <div class="media-content">
                                                        <h3>Share profile</h3>
                                                        <small>Share this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="x"></i>
                                                    <div class="media-content">
                                                        <h3>Block user</h3>
                                                        <small>Block this user permanently.</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="details-avatar">
                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/elise.jpg" alt="">
                                <div class="call-me">
                                    <i class="mdi mdi-phone"></i>
                                </div>
                            </div>

                            <div class="user-meta has-text-centered">
                                <h3>Elise Walker</h3>
                                <h4>Social influencer</h4>
                            </div>

                            <div class="user-badges">
                                <div class="hexagon is-red">
                                    <div>
                                        <i class="mdi mdi-heart"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-accent">
                                    <div>
                                        <i class="mdi mdi-flash"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="user-about">
                                <label>About Me</label>
                                <div class="about-block">
                                    <i class="mdi mdi-domain"></i>
                                    <div class="about-text">
                                        <span>Works at</span>
                                        <span><a class="is-inverted" href="#">Social Media</a></span>
                                    </div>
                                </div>
                                <div class="about-block">
                                    <i class="mdi mdi-map-marker"></i>
                                    <div class="about-text">
                                        <span>From</span>
                                        <span><a class="is-inverted" href="#">London</a></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Nelly details -->
                    <div id="nelly-details" class="panel-body is-user-details is-hidden">
                        <div class="panel-body-inner">

                            <div class="subheader">
                                <div class="action-icon">
                                    <i class="mdi mdi-video"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-camera"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-microphone"></i>
                                </div>
                                <div class="dropdown details-dropdown is-spaced is-neutral is-right dropdown-trigger ml-auto">
                                    <div>
                                        <div class="action-icon">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </div>
                                    </div>
                                    <div class="dropdown-menu" role="menu">
                                        <div class="dropdown-content">
                                            <a href="#" class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="user"></i>
                                                    <div class="media-content">
                                                        <h3>View profile</h3>
                                                        <small>View this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="mail"></i>
                                                    <div class="media-content">
                                                        <h3>Send message</h3>
                                                        <small>Send a message to the user's inbox.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <hr class="dropdown-divider">
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="share-2"></i>
                                                    <div class="media-content">
                                                        <h3>Share profile</h3>
                                                        <small>Share this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="x"></i>
                                                    <div class="media-content">
                                                        <h3>Block user</h3>
                                                        <small>Block this user permanently.</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="details-avatar">
                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/nelly.png" alt="">
                                <div class="call-me">
                                    <i class="mdi mdi-phone"></i>
                                </div>
                            </div>

                            <div class="user-meta has-text-centered">
                                <h3>Nelly Schwartz</h3>
                                <h4>HR Manager</h4>
                            </div>

                            <div class="user-badges">
                                <div class="hexagon is-red">
                                    <div>
                                        <i class="mdi mdi-heart"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-green">
                                    <div>
                                        <i class="mdi mdi-dog"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-accent">
                                    <div>
                                        <i class="mdi mdi-flash"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-blue">
                                    <div>
                                        <i class="mdi mdi-briefcase"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="user-about">
                                <label>About Me</label>
                                <div class="about-block">
                                    <i class="mdi mdi-domain"></i>
                                    <div class="about-text">
                                        <span>Works at</span>
                                        <span><a class="is-inverted" href="#">Carrefour</a></span>
                                    </div>
                                </div>
                                <div class="about-block">
                                    <i class="mdi mdi-map-marker"></i>
                                    <div class="about-text">
                                        <span>From</span>
                                        <span><a class="is-inverted" href="#">Melbourne</a></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Milly details -->
                    <div id="milly-details" class="panel-body is-user-details is-hidden">
                        <div class="panel-body-inner">

                            <div class="subheader">
                                <div class="action-icon">
                                    <i class="mdi mdi-video"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-camera"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-microphone"></i>
                                </div>
                                <div class="dropdown details-dropdown is-spaced is-neutral is-right dropdown-trigger ml-auto">
                                    <div>
                                        <div class="action-icon">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </div>
                                    </div>
                                    <div class="dropdown-menu" role="menu">
                                        <div class="dropdown-content">
                                            <a href="#" class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="user"></i>
                                                    <div class="media-content">
                                                        <h3>View profile</h3>
                                                        <small>View this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="mail"></i>
                                                    <div class="media-content">
                                                        <h3>Send message</h3>
                                                        <small>Send a message to the user's inbox.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <hr class="dropdown-divider">
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="share-2"></i>
                                                    <div class="media-content">
                                                        <h3>Share profile</h3>
                                                        <small>Share this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="x"></i>
                                                    <div class="media-content">
                                                        <h3>Block user</h3>
                                                        <small>Block this user permanently.</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="details-avatar">
                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/milly.jpg" alt="">
                                <div class="call-me">
                                    <i class="mdi mdi-phone"></i>
                                </div>
                            </div>

                            <div class="user-meta has-text-centered">
                                <h3>Milly Augustine</h3>
                                <h4>Sales Manager</h4>
                            </div>

                            <div class="user-badges">
                                <div class="hexagon is-red">
                                    <div>
                                        <i class="mdi mdi-heart"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-green">
                                    <div>
                                        <i class="mdi mdi-dog"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-accent">
                                    <div>
                                        <i class="mdi mdi-flash"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-blue">
                                    <div>
                                        <i class="mdi mdi-briefcase"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="user-about">
                                <label>About Me</label>
                                <div class="about-block">
                                    <i class="mdi mdi-domain"></i>
                                    <div class="about-text">
                                        <span>Works at</span>
                                        <span><a class="is-inverted" href="#">Salesforce</a></span>
                                    </div>
                                </div>
                                <div class="about-block">
                                    <i class="mdi mdi-map-marker"></i>
                                    <div class="about-text">
                                        <span>From</span>
                                        <span><a class="is-inverted" href="#">Seattle</a></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="add-conversation-modal" class="modal add-conversation-modal is-xsmall has-light-bg">
        <div class="modal-background"></div>
        <div class="modal-content">

            <div class="card">
                <div class="card-heading">
                    <h3>New Conversation</h3>
                    <!-- Close X button -->
                    <div class="close-wrap">
                        <span class="close-modal">
                            <i data-feather="x"></i>
                        </span>
                    </div>
                </div>
                <div class="card-body">

                    <img src="assets/img/icons/chat/bubbles.svg" alt="">

                    <div class="field is-autocomplete">
                        <div class="control has-icon">
                            <input type="text" class="input simple-users-autocpl" placeholder="Search a user">
                            <div class="form-icon">
                                <i data-feather="search"></i>
                            </div>
                        </div>
                    </div>

                    <div class="help-text">
                        Select a user to start a new conversation. You'll be able to add other users later.
                    </div>

                    <div class="action has-text-centered">
                        <button type="button" class="button is-solid accent-button raised">Start conversation</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="explorer-menu">
        <div class="explorer-inner">
            <div class="explorer-container">
                <!--Header-->
                <div class="explorer-header">
                    <h3>Explore</h3>
                    <div class="control">
                        <input type="text" class="input is-rounded is-fade" placeholder="Filter">
                        <div class="form-icon">
                            <i data-feather="filter"></i>
                        </div>
                    </div>
                </div>
                <!--List-->
                <div class="explore-list has-slimscroll">
                    <!--item-->
                    <a href="/navbar-v1-feed.html" class="explore-item">
                        <img src="assets/img/icons/explore/clover.svg" alt="">
                        <h4>Feed</h4>
                    </a>
                    <!--item-->
                    <a href="/navbar-v1-profile-friends.html" class="explore-item">
                        <img src="assets/img/icons/explore/friends.svg" alt="">
                        <h4>Friends</h4>
                    </a>
                    <!--item-->
                    <a href="/navbar-v1-videos-home.html" class="explore-item">
                        <img src="assets/img/icons/explore/videos.svg" alt="">
                        <h4>Videos</h4>
                    </a>
                    <!--item-->
                    <a href="/navbar-v1-pages-main.html" class="explore-item">
                        <img src="assets/img/icons/explore/tag-euro.svg" alt="">
                        <h4>Pages</h4>
                    </a>
                    <!--item-->
                    <a href="/navbar-v1-ecommerce-products.html" class="explore-item">
                        <img src="assets/img/icons/explore/cart.svg" alt="">
                        <h4>Commerce</h4>
                    </a>
                    <!--item-->
                    <a href="/navbar-v1-groups.html" class="explore-item">
                        <img src="assets/img/icons/explore/house.svg" alt="">
                        <h4>Interests</h4>
                    </a>
                    <!--item-->
                    <a href="/navbar-v1-stories-main.html" class="explore-item">
                        <img src="assets/img/icons/explore/chrono.svg" alt="">
                        <h4>Stories</h4>
                    </a>
                    <!--item-->
                    <a href="/navbar-v1-questions-home.html" class="explore-item">
                        <img src="assets/img/icons/explore/question.svg" alt="">
                        <h4>Questions</h4>
                    </a>
                    <!--item-->
                    <a href="news.html" class="explore-item">
                        <img src="assets/img/icons/explore/news.svg" alt="">
                        <h4>News</h4>
                    </a>
                    <!--item-->
                    <a href="/navbar-v1-groups.html" class="explore-item">
                        <img src="assets/img/icons/explore/cake.svg" alt="">
                        <h4>Groups</h4>
                    </a>
                    <!--item-->
                    <a href="https://envato.com" class="explore-item">
                        <img src="assets/img/icons/explore/envato.svg" alt="">
                        <h4>Envato</h4>
                    </a>
                    <!--item-->
                    <a href="/navbar-v1-events.html" class="explore-item">
                        <img src="assets/img/icons/explore/calendar.svg" alt="">
                        <h4>Events</h4>
                    </a>
                    <!--item-->
                    <a href="https://cssninja.io" target="_blank" class="explore-item">
                        <img src="assets/img/icons/explore/pin.svg" alt="">
                        <h4>Css Ninja</h4>
                    </a>
                    <!--item-->
                    <a href="/elements.html" class="explore-item">
                        <img src="assets/img/icons/explore/idea.svg" alt="">
                        <h4>Elements</h4>
                    </a>
                    <!--item-->
                    <a href="/navbar-v1-settings.html" class="explore-item">
                        <img src="assets/img/icons/explore/settings.svg" alt="">
                        <h4>Settings</h4>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div id="end-tour-modal" class="modal end-tour-modal is-xsmall has-light-bg">
        <div class="modal-background"></div>
        <div class="modal-content">

            <div class="card">
                <div class="card-heading">
                    <h3></h3>
                    <!-- Close X button -->
                    <div class="close-wrap">
                        <span class="close-modal">
                            <i data-feather="x"></i>
                        </span>
                    </div>
                </div>
                <div class="card-body has-text-centered">

                    <div class="image-wrap">
                        <img src="assets/img/logo/friendkit.svg" alt="">
                    </div>

                    <h3>That's all folks!</h3>
                    <p>Thanks for taking the friendkit tour. There are still tons of other features for you to discover!</p>

                    <div class="action">
                        <a href="/#demos-section" class="button is-solid accent-button raised is-fullwidth">Explore</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function(window, document, undefined) {
            'use strict';
            if (!('localStorage' in window)) return;
            var nightMode = localStorage.getItem('gmtNightMode');
            if (nightMode) {
                document.documentElement.className += ' night-mode';
            }
        })(window, document);
        (function(window, document, undefined) {
            'use strict';
            // Feature test 
            if (!('localStorage' in window)) return;
            // Get our newly insert toggle 
            var nightMode = document.querySelector('#night-mode');
            if (!nightMode) return;
            // When clicked, toggle night mode on or off 
            nightMode.addEventListener('click', function(event) {
                event.preventDefault();
                document.documentElement.classList.toggle('dark');
                if (document.documentElement.classList.contains('dark')) {
                    localStorage.setItem('gmtNightMode', true);
                    return;
                }
                localStorage.removeItem('gmtNightMode');
            }, false);

        })(window, document);
        $(document).ready(function() {
            var first = true;
            // Hide menu once we know its width 
            $('#showupload').click(function() {
                var $menu = $('.profile_image');
                if ($menu.is(':visible')) {
                    // Slide away 
                    $menu.animate({
                        left: -($menu.outerWidth() + 10)
                    }, function() {
                        $menu.hide();
                    });
                } else {
                    // Slide in 
                    $menu.show().css("left", -($menu.outerWidth() + 10)).animate({
                        left: 0
                    });
                }
            });
            //cover photo 
            var first = true;
            // Hide menu once we know its width 
            $('.show_cover_photo').click(function() {
                var $menu1 = $('.cover_photo');
                if ($menu1.is(':visible')) {
                    // Slide away 
                    $menu1.animate({
                        left: -($menu1.outerWidth() + 10)
                    }, function() {
                        $menu1.hide();
                    });
                } else {
                    // Slide in 
                    $menu1.show().css("left", -($menu1.outerWidth() + 10)).animate({
                        left: 0
                    });
                }

            });


            $('.cancle_request_follow').click(function() {
                var strconfirm = confirm("Are you sure?");
                if (strconfirm == true) {
                    var to_id = $(this).attr('to-id');
                    var from_id = '<?php echo $_SESSION['id'] ?>';
                    //  alert(to_id+'-'+from_id); 
                    $.ajax({
                        url: 'ajax/cancle_request_follow.php',
                        type: 'POST',
                        data: {
                            to_id: to_id,
                            from_id: from_id
                        },
                        success: function(response) {
                            location.reload();
                        }
                    });
                }
            });

            $('.send_follow_request').click(function() {
                var to_id = $(this).attr('follow_request_to-id');
                var from_id = $(this).attr('follow_request_from-id');
                var fullname = $(this).attr('follow_request_fullname');
                //alert(to_id+''+from_id+''+fullname); 
                $.ajax({
                    url: 'ajax/send_follow_request_main.php',
                    type: 'POST',
                    data: {
                        to_id: to_id,
                        from_id: from_id,
                        fullname: fullname
                    },
                    success: function(response) {
                        $('.msg').html("Friend request has been send");
                        window.setTimeout(function() {
                            location.reload()
                        }, 1000);
                    }
                });
            });

            $('.remove_follower').click(function() {
                var to_id = $(this).attr('remove_request_to-id');
                var from_id = $(this).attr('remove_request_from-id');
                //alert(to_id);  
                $.ajax({
                    url: 'ajax/remove_follower.php',
                    type: 'POST',
                    data: {
                        to_id: to_id,
                        from_id: from_id
                    },
                    success: function(response) {
                        location.reload();
                    }
                });
            });

            $('.remove_profile_picture').click(function() {
                var strconfirm = confirm("Are you sure you want to delete?");
                if (strconfirm == true) {
                    var dummy_id = '<?php echo $dummy_row['id']; ?>';
                    $.ajax({
                        url: 'ajax/remove_dummy_profile_picture.php',
                        type: 'POST',
                        data: {
                            id: dummy_id
                        },
                        success: function(response) {
                            window.setTimeout(function() {
                                location.assign("dummy_profile.php")
                            }, 1000);
                        }
                    });
                }
            });

            $('.remove_cover_picture').click(function() {
                var strconfirm = confirm("Are you sure you want to delete?");
                if (strconfirm == true) {
                    var dummy_id = '<?php echo $dummy_row['id']; ?>';
                    $.ajax({
                        url: 'ajax/remove_dummy_cover_picture.php',
                        type: 'POST',
                        data: {
                            id: dummy_id
                        },
                        success: function(response) {
                            window.setTimeout(function() {
                                location.assign("dummy_profile.php")
                            }, 1000);
                        }
                    });
                }
            });

            // Edit Profile //  
            $('.save_profile').click(function() {
                var id = $('.id').val();
                var fname = $('.edit_fname').val(); 
                var previous_name = $('.previous_name').val();
                var bio = $('.edit_bio').val();
                var website = $('.edit_website').val();
                $.ajax({
                    url: "ajax/edit_dummy_profile.php",
                    type: "POST",
                    data: 'fname=' + fname + '&previous_name=' + previous_name + '&bio=' + bio + '&website=' + website,
                    success: function(data) {
                        $("#msg").html(data);
                        window.setTimeout(function() {
                            location.assign("dummy_profile.php")
                        }, 2000);
                    }
                });
            });
            // Get Profile //  
            $('.edit_profile').click(function() {
                // var id = $(this).attr("data-id");  
                $.ajax({
                    url: "ajax/get_dummy_profile.php",
                    type: "POST",
                    //data:'id='+id, 
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        $(".id").val(data.id);
                        $(".edit_fname").val(data.fname);
                        $(".edit_lname").val(data.lname);
                        $(".edit_bio").val(data.bio);
                        $(".edit_website").val(data.website);
                    }
                });
            });
        });




        function uploadDummyCoverPhoto() {
            var imgclean = $('#cover_file');
            data = new FormData();
            data.append("ucp_id", $("#ucp_id").val());
            data.append('cover_file', $('#cover_file')[0].files[0]);
            var imgname = $('#cover_file').val();
            var size = $('#cover_file')[0].files[0].size;
            var ext = imgname.substr((imgname.lastIndexOf('.') + 1));
            if (ext == 'jpg' || ext == 'jpeg' || ext == 'png' || ext == 'gif' || ext == 'PNG' || ext == 'JPG' || ext == 'JPEG')

            {
                if (size <= 100000000000) {
                    $.ajax({
                        url: "ajax/dummy_uploadcoverphoto.php",
                        type: "POST",
                        data: data,
                        enctype: 'multipart/form-data',
                        processData: false, // tell jQuery not to process the data 
                        contentType: false // tell jQuery not to set contentType 
                    }).done(function(data) {
                        //alert("successfully upload"); 
                        if (window.location.reload()) {
                            $("#uploadmsg").html(data);
                        }
                    });
                    return false;
                } //end size 
                else {
                    imgclean.replaceWith(imgclean = imgclean.clone(true)); //Its for reset the value of file type 
                    alert('Sorry File size exceeding from 1 Mb');
                }
            } //end FILETYPE 
            else {
                imgclean.replaceWith(imgclean = imgclean.clone(true));
                alert('Sorry Only you can uplaod JPEG|JPG|PNG|GIF file type ');
            }
        }



        function uploadProfilePic() {
            var imgclean = $('#upp_file');
            data = new FormData();
            data.append("upp_id", $("#upp_id").val());
            data.append('upp_file', $('#upp_file')[0].files[0]);
            var imgname = $('#upp_file').val();
            var size = $('#upp_file')[0].files[0].size;
            var ext = imgname.substr((imgname.lastIndexOf('.') + 1));
            if (ext == 'jpg' || ext == 'jpeg' || ext == 'png' || ext == 'gif' || ext == 'PNG' || ext == 'JPG' || ext == 'JPEG')

            {
                if (size <= 100000000000) {
                    $.ajax({
                        url: "ajax/dummy_uploadprofilepic.php",
                        type: "POST",
                        data: data,
                        enctype: 'multipart/form-data',
                        processData: false, // tell jQuery not to process the data 
                        contentType: false // tell jQuery not to set contentType 
                    }).done(function(data) {
                        //alert("successfully upload"); 
                        if (window.location.reload()) {
                            $("#uploadmsg").html(data);
                        }
                    });
                    return false;
                } //end size 
                else {
                    imgclean.replaceWith(imgclean = imgclean.clone(true)); //Its for reset the value of file type 
                    alert('Sorry File size exceeding from 1 Mb');
                }
            } //end FILETYPE 
            else {
                imgclean.replaceWith(imgclean = imgclean.clone(true));
                alert('Sorry Only you can uplaod JPEG|JPG|PNG|GIF file type ');
            }
        }
    </script>
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
    <script src="assets/js/app.js"></script>
    <script src="assets/data/tipuedrop_content.js"></script>
    <script src="assets/js/global.js"></script>
    <script src="assets/js/navbar-v1.js"></script>
    <script src="assets/js/navbar-v2.js"></script>
    <script src="assets/js/navbar-mobile.js"></script>
    <script src="assets/js/navbar-options.js"></script>
    <script src="assets/js/sidebar-v1.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/chat.js"></script>
    <script src="assets/js/touch.js"></script>
    <script src="assets/js/tour.js"></script>
    <script src="assets/js/explorer.js"></script>
    <script src="assets/js/widgets.js"></script>
    <script src="assets/js/modal-uploader.js"></script>
    <script src="assets/js/popovers-users.js"></script>
    <script src="assets/js/popovers-pages.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/feed.js"></script>
    <script src="assets/js/profile.js"></script>
</body>

</html>