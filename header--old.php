<?php  
ob_start(); 
session_start();  
include('config.php'); 
$query = "SELECT *  FROM gt_users WHERE dummy_id = '".$_SESSION['id']."'";  
$query_retrived = mysqli_query($conn, $query) or die("Error:".mysqli_error($conn)); 
$dummy_row = mysqli_fetch_assoc($query_retrived);  
$result = mysqli_num_rows($query_retrived); 





$main_query = "SELECT *  FROM gt_users WHERE id = '".$_SESSION['id']."'"; 

$main_query_retrived = mysqli_query($conn, $main_query) or die("Error:".mysqli_error($conn));

$main_row = mysqli_fetch_assoc($main_query_retrived); 

$result = mysqli_num_rows($main_query_retrived);

/* Average Rating for profile */

$queryR = "SELECT p.*, COUNT(r.rating_number) as rating_num, FORMAT((SUM(r.rating_number) / COUNT(r.rating_number)),1) as average_rating, COUNT(r.user_id) as total_user FROM gt_posts as p LEFT JOIN rating as r ON r.post_id = p.id WHERE r.user_id = '".$rows['id']."' GROUP BY (r.post_id)";  
        $resultR = mysqli_query($conn, $queryR) or die("Error:".mysqli_error($conn));
        $postData = mysqli_fetch_assoc($resultR); 
        $p_n_r = mysqli_num_rows($resultR);
// print_r($postData);die;
$queryCR = "SELECT c.*, COUNT(cr.rating_number) as rating_num, FORMAT((SUM(cr.rating_number) / COUNT(cr.rating_number)),1) as average_rating, COUNT(cr.user_id) as total_user FROM comment as c LEFT JOIN comment_rating as cr ON cr.comment_id = c.id WHERE cr.user_id = '".$rows['id']."' AND rating_number != 'undefined'  GROUP BY (cr.post_id)"; 
    $resultCR = mysqli_query($conn, $queryCR) or die("Error:".mysqli_error($conn)); 
    $commentDataCR = mysqli_fetch_assoc($resultCR);
    $c_n_r = mysqli_num_rows($resultCR); 
 
    $post_average_rating = @$postData['average_rating'];
    $comment_average_rating = @$commentDataCR['average_rating']; 
    if($p_n_r != 0 AND $c_n_r == 0){
        $profile_ratig = $post_average_rating;
        if ($profile_ratig) {
            mysqli_query($conn, "UPDATE gt_users SET profile_rating='".$profile_ratig."' WHERE dummy_id = '".$_SESSION['id']."'");
        } 
    }else if ($c_n_r != 0 AND $p_n_r == 0) {
        $profile_ratig = $comment_average_rating;
        if ($profile_ratig) {
            mysqli_query($conn, "UPDATE gt_users SET profile_rating='".$profile_ratig."' WHERE dummy_id = '".$_SESSION['id']."'");
        } 
    } else{
        $c = $comment_average_rating/1.5; 
        $p = $post_average_rating + $c;
        $p1 = $p/10;
        $profile_ratig = $p1 * 6; 
        if ($profile_ratig) {
            mysqli_query($conn, "UPDATE gt_users SET profile_rating='".$profile_ratig."' WHERE dummy_id = '".$_SESSION['id']."'");
        } 
    }
 

//print_r($_SESSION);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> Friendkit | Feed</title>
    <link rel="icon" type="image/png" href="assets/img/favicon.png" /> 
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-KQHJPZP');
    </script>
    <!-- End Google Tag Manager -->
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/fontisto@v3.0.4/css/fontisto/fontisto-brands.min.css" rel="stylesheet">

    <!-- UIkit CSS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.15.1/dist/css/uikit.min.css" />

    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.1/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.1/dist/js/uikit-icons.min.js"></script>
    <!-- <script src="assets/js/tinymce-old/jquery.tinymce.min.js"></script>

    <script src="assets/js/tinymce-old/tinymce.min.js"></script> -->
    <script src="assets/js/jquery.min.js"></script>

    <script src="assets/js/tinymce-old/init-tinymce.js"></script> 
    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/css/core.css">
    <link rel="stylesheet" href="assets/css/custom.css">

</head>
<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KQHJPZP" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <!-- Pageloader -->
    <div class="pageloader"></div>
    <div class="infraloader is-active"></div>
    <div class="app-overlay"></div>
    <div id="main-navbar" class="navbar navbar-v1 is-inline-flex is-transparent no-shadow is-hidden-mobile">
        <div class="container is-fluid">
            <div class="navbar-brand">
                <a href="/" class="navbar-item">
                    <img class="logo light-image" src="assets/img/logo/friendkit-bold.svg" width="112" height="28" alt="">
                    <img class="logo dark-image" src="assets/img/logo/friendkit-white.svg" width="112" height="28" alt="">
                </a>
            </div>
            <div class="navbar-menu">
                <div class="navbar-start">
                    <!-- Navbar Search -->

<!---------------------- Friend requests Section --------------------> 
                    

<!---------------------- Notifications Section -------------------->
                    <?php  
                        $sql_noti_count = "SELECT *  FROM gt_notification WHERE request_to_id='".$main_row['id']."' AND status='1'";  
                        $result_noti_count = $conn->query($sql_noti_count); 
                        $num_row_noti_count = @mysqli_num_rows($result_noti_count); 

                        $sql_dnoti_count = "SELECT *  FROM gt_dummy_notification WHERE request_to_id='".$dummy_row['id']."' AND status='1'"; 
                        $result_dnoti_count = $conn->query($sql_dnoti_count);
                        $num_row_dnoti_count = @mysqli_num_rows($result_dnoti_count); 
                    ?> 
                    <div class="navbar-item is-icon drop-trigger">
                        <a class="icon-link  <?php if($num_row_noti_count>0 OR $num_row_dnoti_count>0){ echo 'is-active'; } else{ echo ''; }?> hide_count_main_and_dummy" href="javascript:void(0);">
                            <i data-feather="bell"></i>
                            <span class="indicator"></span>
                        </a>
                      <!--   <a class="icon-link is-active" href="javascript:void(0);">
                            <i data-feather="mail"></i>
                            <span class="indicator"></span>
                        </a> -->
                        <div class="nav-drop">
                            <div class="inner">
                                <div class="nav-drop-header">
                                    <span>Notifications</span>
                                    <a href="#">
                                        <i data-feather="bell"></i>
                                    </a>
                                </div>  
                                <div class="nain-div">
                                    <div class="switch-main notification-head-main" style="margin-top: 3px;">
                                        <ul uk-tab class="head-switch">
                                            <li><a href="#">Dummy</a></li>
                                            <li><a href="#">Main</a></li> 
                                        </ul>
                                        <!-- First Account Notifications -->
                                        <ul class="uk-switcher uk-margin">
                                            <li>  
                                                <div class="nav-drop-body is-notifications">
                                                    <!-- Notification -->
                                                    <?php 
                                                        $sql =  "SELECT *  FROM gt_notification
                                                        WHERE request_to_id='".$dummy_row['id']."' ORDER BY id DESC";
                                                       // echo $sql;
                                                        $result = $conn->query($sql);
                                                        $num_row = @mysqli_num_rows($result);
                                                        if ($num_row>0) {
                                                        while ($row = $result->fetch_assoc()) { 
                                                    ?> 
                                                    <div class="media">
                                                        <figure class="media-left">
                                                            <p class="image">
                                                            <?php if(!empty($row['user_image'])){?>  
                                                                <img src="./upload/p2.jpg" data-demo-src="assets/img/avatars/david.jpg" alt="">
                                                            <?php }else{?>
                                                                <img src="./image/male.jpeg" alt="">
                                                            <?php } ?>
                                                            </p>
                                                        </figure>
                                                        <div class="media-content">
                                                            <span><?php echo $row['message'];?></span>
                                                        </div>
                                                        <!-- <div class="media-right">
                                                            <div class="added-icon">
                                                                <i data-feather="message-square"></i>
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                    <!-- Notification -->
                                                    <?php } } ?>   
                                                </div> 
                                            </li> 
                                                <!-- Second Account Friend request --> 
                                            <li>  
                                                <div class="nav-drop-body is-notifications"> 
                                                <?php  
                                                    $sql =  "SELECT *  FROM gt_notification WHERE request_to_id='".$main_row['id']."' ORDER BY id DESC"; 
                                                    //echo $sql; 
                                                    $result = $conn->query($sql); 
                                                    $num_row = @mysqli_num_rows($result); 
                                                    if ($num_row>0) { 
                                                    while ($row = $result->fetch_assoc()) {  
                                                ?>    
                                                     
                                                        <div class="media">
                                                            <figure class="media-left">
                                                                <p class="image">
                                                                    <?php if(!empty($row['user_image'])){?>
                                                                        <img src="<?php echo $row['user_image'];?>" data-demo-src="assets/img/avatars/david.jpg" alt="">
                                                                    <?php }else {?>
                                                                        <img src="./image/male.jpeg" alt=""> 
                                                                    <?php } ?>
                                                                </p>
                                                            </figure>
                                                            <div class="media-content">
                                                                <span><?php echo $row['message'];?></span>
                                                            </div>
                                                            <!-- <div class="media-right">
                                                                <div class="added-icon">
                                                                    <i data-feather="message-square"></i>
                                                                </div>
                                                            </div> -->
                                                        </div>
                                                    
                                                <?php } } ?>  
                                                </div> 
                                            </li> 
                                        </ul>
                                    </div>
                                </div>   
                                <div class="nav-drop-footer">
                                    <a href="#">View All</a>
                                </div>
                            </div>
                        </div>
                    </div>


<!---------------------- Message Section -------------------->
                    <?php  
                        $sql_noti_count_msg = "SELECT *  FROM chat WHERE reciever_userid='".$_SESSION['id']."' GROUP BY sender_userid";  
                        $result_noti_count_msg = $conn->query($sql_noti_count_msg); 
                        $num_row_noti_count_msg = @mysqli_num_rows($result_noti_count_msg);  
                    ?>
                    <div class="navbar-item is-icon drop-trigger">
                        <a class="icon-link <?php if($num_row_noti_count_msg > 0){ echo 'is-active'; } else { echo ''; }?> " href="javascript:void(0);">
                            <i data-feather="mail"></i>
                            <span class="indicator"></span>
                        </a>
                        <div class="nav-drop">
                            <div class="inner">
                                <div class="nav-drop-header">
                                    <span>Messages</span>
                                    <!-- <a href="messages-inbox.html">Inbox</a> -->
                                </div> 

                                <div class="nain-div">
                                <div class="switch-main notification-head-main" style="margin-top: 3px;">
                                    <ul uk-tab class="head-switch">
                                    <li><a href="#">Dummy</a></li>
                                    <li><a href="#">Main</a></li> 
                                    </ul>
                                <!-- First Account Messages -->
                                    <ul class="uk-switcher uk-margin">
                                    
                                    <li>  
                                        <div class="nav-drop-body is-friend-requests"> 
                                            <?php 
                                         
                                        $sql_msg =  "SELECT chat.chatid, chat.sender_userid, count(chat.reciever_userid) as msg_count, chat.message, gt_users.fname, gt_users.lname, gt_users.photo FROM chat INNER JOIN gt_users ON gt_users.id = chat.sender_userid WHERE reciever_userid='".$dummy_row['id']."' GROUP BY sender_userid ORDER BY chatid DESC";
                                       // echo $sql_msg;
                                        $result_msg = $conn->query($sql_msg); 
                                        $num_row_msg = @mysqli_num_rows($result_msg);
                                            if ($num_row_msg>0) {
                                            while ($row_msg = $result_msg->fetch_assoc()) {
                                    ?>
                                            <div class="media">
                                                <figure class="media-left">
                                                    <p class="image">
                                                        <?php if(!empty($row_msg['photo'])){?>
                                                            <img src="<?php echo $row_msg['photo'];?>" data-demo-src="assets/img/avatars/david.jpg" alt="">
                                                        <?php } else { ?>
                                                            <img src="./image/male.jpeg" alt=""> 
                                                        <?php } ?> 
                                                    </p>
                                                </figure>
                                                <div class="media-content">
                                                    <a href="#"><?php echo $row_msg['fname'].' '.$row_msg['lname'];?></a>
                                                    <span><?php echo $row_msg['message'];?></span>
                                                    <!-- <span class="time">Yesterday</span> -->
                                                </div>
                                                 <div class="media-right is-centered">
                                                    <div class="added-icon">
                                                        <i data-feather="message-square"></i>
                                                    </div>
                                                </div> 
                                            </div> 
                                        <?php } } ?> 
                                        </div>    
                                    </li>
                                    
                                <!-- Second Account Messages --> 

                                    <li>  
                                    <div class="nav-drop-body is-friend-requests">
                                <!-- Message -->
                                 <?php 
                                    $sql_msg =  "SELECT chat.chatid, chat.sender_userid, count(chat.reciever_userid) as msg_count, chat.message, gt_users.fname, gt_users.lname, gt_users.photo FROM chat INNER JOIN gt_users ON gt_users.id = chat.sender_userid WHERE reciever_userid='".$main_row['id']."' GROUP BY sender_userid ORDER BY chatid DESC";
                                   // echo $sql_msg;
                                    $result_msg = $conn->query($sql_msg); 
                                    $num_row_msg = @mysqli_num_rows($result_msg);
                                        if ($num_row_msg>0) {
                                        while ($row_msg = $result_msg->fetch_assoc()) {
                                ?> 
                                <div class="media">
                                    <figure class="media-left">
                                    <p class="image">
                                        <?php if(!empty($row_msg['photo'])){?>
                                            <img src="<?php echo $row_msg['photo'];?>" data-demo-src="assets/img/avatars/david.jpg" alt="">
                                        <?php } else { ?>
                                            <img src="./image/male.jpeg" alt=""> 
                                        <?php } ?>
                                    </p>
                                    </figure>
                                    <div class="media-content">
                                    <a href="#"><?php echo $row_msg['fname'].' '.$row_msg['lname'];?></a>
                                    <span><?php echo $row_msg['message'];?></span>
                                    <!-- <span class="time">Yesterday</span> -->
                                    </div>
                                     <div class="media-right is-centered">
                                        <div class="added-icon">
                                            <i data-feather="message-square"></i>
                                        </div>
                                    </div>  
                                </div>
                                 <?php } } ?> 
                                
                         </div>     
                                    </li> 
                                    </ul>
                                </div>
                                </div> 


                                <div class="nav-drop-footer">
                                    <a href="#">Clear All</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="navbar-item is-icon open-chat">
                        <a class="icon-link is-primary" href="javascript:void(0);">
                            <i data-feather="message-square"></i>
                            <span class="indicator"></span>
                        </a>
                    </div>
                    <div id="explorer-trigger" class="navbar-item is-icon">
                        <a class="icon-link is-primary">
                            <i class="mdi mdi-apps"></i>
                        </a>
                    </div>
                </div>
                <div class="navbar-end">
                    <div class="navbar-item">
                        <div id="global-search" class="control">
                            <form action="search.php" method="get">
                                <input id="tipue_drop_input" name="search_data" class="input is-rounded" type="text" placeholder="Search" required>
                                <span id="clear-search" class="reset-search">
                                    <i data-feather="x"></i>
                                </span>
                                <span class="search-icon">
                                    <i data-feather="search"></i>
                                </span>
                                <div id="tipue_drop_content" class="tipue-drop-content"></div>
                            </form>
                        </div>
                    </div>
                    <div class="navbar-item is-cart">
                        <!-- <div class="cart-button">
                            <i data-feather="shopping-cart"></i>
                            <div class="cart-count">
                            </div>
                        </div> -->
                        <!-- Cart dropdown -->
                        <div class="shopping-cart">
                            <div class="cart-inner">
                                <!--Loader-->
                                <div class="navbar-cart-loader is-active">
                                    <div class="loader is-loading"></div>
                                </div>
                                <div class="shopping-cart-header">
                                    <a href="/ecommerce-cart.html" class="cart-link">View Cart</a>
                                    <div class="shopping-cart-total">
                                        <span class="lighter-text">Total:</span>
                                        <span class="main-color-text">$193.00</span>
                                    </div>
                                </div>
                                <!--end shopping-cart-header -->
                                <ul class="shopping-cart-items">
                                    <li class="cart-row">
                                        <img src="assets/img/products/2.svg" alt="" />
                                        <span class="item-meta">
                                            <span class="item-name">Cool Shirt</span>
                                            <span class="meta-info">
                                                <span class="item-price">$29.00</span>
                                                <span class="item-quantity">Qty: 01</span>
                                            </span>
                                        </span>
                                    </li>
                                    <li class="cart-row">
                                        <img src="assets/img/products/3.svg" alt="" />
                                        <span class="item-meta">
                                            <span class="item-name">Military Short</span>
                                            <span class="meta-info">
                                                <span class="item-price">$39.00</span>
                                                <span class="item-quantity">Qty: 01</span>
                                            </span>
                                        </span>
                                    </li>
                                    <li class="cart-row">
                                        <img src="assets/img/products/4.svg" alt="" />
                                        <span class="item-meta">
                                            <span class="item-name">Cool Backpack</span>
                                            <span class="meta-info">
                                                <span class="item-price">$125.00</span>
                                                <span class="item-quantity">Qty: 01</span>
                                            </span>
                                        </span>
                                    </li>
                                </ul>
                                <a href="#" class="button primary-button is-raised">Checkout</a>
                            </div>
                        </div>
                    </div>
                    <div id="account-dropdown" class="navbar-item is-account drop-trigger has-caret">
                        <div class="user-image">
                            <img src="./upload/p1.jpg" data-demo-src="assets/img/avatars/jenna.png" alt="">
                            <span class="indicator"></span>
                        </div>
                        <div class="nav-drop is-account-dropdown">
                            <div class="inner">
                                <div class="nav-drop-header">
                                    <span class="username">Jenna Davis</span>
                                    <label class="theme-toggle">
                                        <input type="checkbox">
                                        <span class="toggler">
                                            <span class="dark">
                                                <i data-feather="moon"></i>
                                            </span>
                                            <span class="light">
                                                <i data-feather="sun"></i>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <div class="nav-drop-body account-items">
                                    <a id="profile-link" href="/profile-main.html" class="account-item">
                                        <div class="media">
                                            <div class="media-left">
                                                <div class="image">
                                                    <img src="https://via.placeholder.com/400x400" data-demo-src="assets/img/avatars/jenna.png" alt="">
                                                </div>
                                            </div>
                                            <div class="media-content">
                                                <h3>Jenna Davis</h3>
                                                <small>Main account</small>
                                            </div>
                                            <div class="media-right">
                                                <i data-feather="check"></i>
                                            </div>
                                        </div>
                                    </a>
                                    <hr class="account-divider">
                                    <a href="/pages-main.html" class="account-item">
                                        <div class="media">
                                            <div class="media-left">
                                                <div class="image">
                                                    <img src="./upload/p2.jpg" data-demo-src="assets/img/avatars/hanzo.svg" alt="">
                                                </div>
                                            </div>
                                            <div class="media-content">
                                                <h3>Css Ninja</h3>
                                                <small>Company page</small>
                                            </div>
                                            <div class="media-right is-hidden">
                                                <i data-feather="check"></i>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="/pages-main.html" class="account-item">
                                        <div class="media">
                                            <div class="media-left">
                                                <div class="image">
                                                    <img src="./upload/p2.jpg" data-demo-src="assets/img/icons/logos/fastpizza.svg" alt="">
                                                </div>
                                            </div>
                                            <div class="media-content">
                                                <h3>Fast Pizza</h3>
                                                <small>Company page</small>
                                            </div>
                                            <div class="media-right is-hidden">
                                                <i data-feather="check"></i>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="/pages-main.html" class="account-item">
                                        <div class="media">
                                            <div class="media-left">
                                                <div class="image">
                                                    <img src="./upload/p2.jpg" data-demo-src="assets/img/icons/logos/slicer.svg" alt="">
                                                </div>
                                            </div>
                                            <div class="media-content">
                                                <h3>Slicer</h3>
                                                <small>Company page</small>
                                            </div>
                                            <div class="media-right is-hidden">
                                                <i data-feather="check"></i>
                                            </div>
                                        </div>
                                    </a>
                                    <hr class="account-divider">
                                    <a href="/options-settings.html" class="account-item">
                                        <div class="media">
                                            <div class="icon-wrap">
                                                <i data-feather="settings"></i>
                                            </div>
                                            <div class="media-content">
                                                <h3>Settings</h3>
                                                <small>Access widget settings.</small>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="account-item">
                                        <div class="media">
                                            <div class="icon-wrap">
                                                <i data-feather="life-buoy"></i>
                                            </div>
                                            <div class="media-content">
                                                <h3>Help</h3>
                                                <small>Contact our support.</small>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="account-item" href="logout.php">
                                        <div class="media">
                                            <div class="icon-wrap">
                                                <i data-feather="power"></i>
                                            </div>
                                            <div class="media-content">
                                                <h3>Log out</h3>
                                                <small>Log out from your account.</small>
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
    </div>
    <nav class="navbar mobile-navbar is-hidden-desktop" aria-label="main navigation">
        <!-- Brand -->
        <div class="navbar-brand">
            <a class="navbar-item" href="/">
                <img class="light-image" src="assets/img/logo/friendkit-bold.svg" alt="">
                <img class="dark-image" src="assets/img/logo/friendkit-white.svg" alt="">
            </a>

<!---------------------- Friend requests Section --------------------> 
            

<!---------------------- Notifications Section -------------------->           
            <div class="navbar-item is-icon drop-trigger">
                <a class="icon-link" href="javascript:void(0);">
                    <i data-feather="bell"></i>
                    <span class="indicator"></span>
                </a>
                <div class="nav-drop">
                    <div class="inner">
                        <div class="nav-drop-header">
                            <span>Notifications</span>
                            <a href="#">
                                <i data-feather="bell"></i>
                            </a>
                        </div>
                        <div class="nain-div">
                                <div class="switch-main notification-head-main" style="margin-top: 3px;">
                                    <ul uk-tab class="head-switch">
                                    <li><a href="#">Dummy</a></li>
                                    <li><a href="#">Main</a></li> 
                                    </ul>
                                <!-- First Account Notifications -->
                                    <ul class="uk-switcher uk-margin">
                                    <li>  
                                        <div class="nav-drop-body is-notifications">
                                            <?php 
                                                $sql =  "SELECT *  FROM gt_notification
                                                WHERE request_to_id='".$rows['id']."' ORDER BY id DESC";
                                               // echo $sql;
                                                $result = $conn->query($sql);
                                                $num_row = @mysqli_num_rows($result);
                                                if ($num_row>0) {
                                                while ($row = $result->fetch_assoc()) { 
                                            ?>  
                                            <div class="media">
                                                <figure class="media-left">
                                                    <p class="image">
                                                        <?php if(!empty($row['user_image'])){?>
                                                            <img src="<?php echo $row['user_image'];?>" data-demo-src="assets/img/avatars/david.jpg" alt="">
                                                        <?php }else{?>
                                                            <img src="./image/male.jpeg" alt="">
                                                        <?php } ?>
                                                    </p>
                                                </figure>
                                                <div class="media-content">
                                                    <span><?php echo $row['message'];?></span>
                                                </div>
                                                <!-- <div class="media-right">
                                                    <div class="added-icon">
                                                        <i data-feather="message-square"></i>
                                                    </div>
                                                </div> -->
                                            </div>
                                            <?php } } ?> 
                                        </div> 
                                    </li>

                                <!-- Second Account Friend request --> 
                                    <li>  
                                    <div class="nav-drop-body is-notifications">
                                    <!-- Notification -->
                                    <?php 
                                        $sql =  "SELECT *  FROM gt_notification
                                        WHERE request_to_id='".$rows['id']."' ORDER BY id DESC";
                                       // echo $sql;
                                        $result = $conn->query($sql);
                                        $num_row = @mysqli_num_rows($result);
                                        if ($num_row>0) {
                                        while ($row = $result->fetch_assoc()) { 
                                    ?>  
                                    <div class="media">
                                        <figure class="media-left">
                                            <p class="image">
                                                <?php if(!empty($row['user_image'])){?>
                                                <img src="<?php echo $row['user_image'];?>" data-demo-src="assets/img/avatars/david.jpg" alt="">
                                                <?php }else{?>
                                                <img src="./image/male.jpeg" alt="">
                                                <?php } ?>
                                            </p>
                                        </figure>
                                        <div class="media-content">
                                            <span><?php echo $row['message'];?></span>
                                        </div>
                                       <!--  <div class="media-right">
                                            <div class="added-icon">
                                                <i data-feather="message-square"></i>
                                            </div>
                                        </div> -->
                                    </div>
                                    <?php } } ?>  
                                </div>
                                    
                                    </li> 
                                    </ul>
                                </div>
                                </div>   
                        <div class="nav-drop-footer">
                            <a href="#">View All</a>
                        </div>
                    </div>
                </div>
            </div>

<!---------------------- Messages Section -------------------->        
            <div class="navbar-item is-icon drop-trigger">
                <a class="icon-link is-active" href="javascript:void(0);">
                    <i data-feather="mail"></i>
                    <span class="indicator"></span>
                </a> 
                <div class="nav-drop">
                    <div class="inner">
                        <div class="nav-drop-header">
                            <span>Messages</span>
                            <a href="messages-inbox.html">Inbox</a>
                        </div>
                        <div class="nain-div">
                                <div class="switch-main notification-head-main" style="margin-top: 3px;">
                                    <ul uk-tab class="head-switch">
                                    <li><a href="#">Dummy</a></li>
                                    <li><a href="#">Main</a></li> 
                                    </ul>
                                <!-- First Account Messages -->
                                    <ul class="uk-switcher uk-margin">
                                    <li> 

                                    <div class="nav-drop-body is-friend-requests">
                                <!-- Message -->
                                <div class="media">
                                    <figure class="media-left">
                                    <p class="image">
                                        <img
                                        src="https://via.placeholder.com/150x150"
                                        data-demo-src="assets/img/avatars/nelly.png"
                                        data-user-popover="9"
                                        alt=""
                                        />
                                    </p>
                                    </figure>
                                    <div class="media-content">
                                    <a href="#">Nelly Schwartz</a>
                                    <span>I think we should meet near the Starbucks so we can get...</span>
                                    <span class="time">Yesterday</span>
                                    </div>
                                    <div class="media-right is-centered">
                                    <div class="added-icon">
                                        <i data-feather="message-square"></i>
                                    </div>
                                    </div>
                                </div>
                                <!-- Message -->
                                <div class="media">
                                    <figure class="media-left">
                                    <p class="image">
                                        <img
                                        src="https://via.placeholder.com/150x150"
                                        data-demo-src="assets/img/avatars/edward.jpeg"
                                        data-user-popover="5"
                                        alt=""
                                        />
                                    </p>
                                    </figure>
                                    <div class="media-content">
                                    <a href="#">Edward Mayers</a>
                                    <span
                                        >That was a real pleasure seeing you last time we really should...</span
                                    >
                                    <span class="time">last week</span>
                                    </div>
                                    <div class="media-right is-centered">
                                    <div class="added-icon">
                                        <i data-feather="message-square"></i>
                                    </div>
                                    </div>
                                </div>
                         </div>    
                                    </li>

                                <!-- Second Account Messages --> 
                                    <li>  
                                    <div class="nav-drop-body is-friend-requests">
                                <!-- Message -->
                                <div class="media">
                                    <figure class="media-left">
                                    <p class="image">
                                        <img
                                        src="https://via.placeholder.com/150x150"
                                        data-demo-src="assets/img/avatars/nelly.png"
                                        data-user-popover="9"
                                        alt=""
                                        />
                                    </p>
                                    </figure>
                                    <div class="media-content">
                                    <a href="#">Rachit</a>
                                    <span>I think we should meet near the Starbucks so we can get...</span>
                                    <span class="time">Yesterday</span>
                                    </div>
                                    <div class="media-right is-centered">
                                    <div class="added-icon">
                                        <i data-feather="message-square"></i>
                                    </div>
                                    </div>
                                </div>
                                <!-- Message -->
                                <div class="media">
                                    <figure class="media-left">
                                    <p class="image">
                                        <img
                                        src="https://via.placeholder.com/150x150"
                                        data-demo-src="assets/img/avatars/edward.jpeg"
                                        data-user-popover="5"
                                        alt=""
                                        />
                                    </p>
                                    </figure>
                                    <div class="media-content">
                                    <a href="#">Somya</a>
                                    <span
                                        >That was a real pleasure seeing you last time we really should...</span
                                    >
                                    <span class="time">last week</span>
                                    </div>
                                    <div class="media-right is-centered">
                                    <div class="added-icon">
                                        <i data-feather="message-square"></i>
                                    </div>
                                    </div>
                                </div>
                         </div>     
                                    </li> 
                                    </ul>
                                </div>
                                </div> 
                        <div class="nav-drop-footer">
                            <a href="#">Clear All</a>
                        </div>
                    </div>
                </div>
            </div>

            <div id="mobile-explorer-trigger" class="navbar-item is-icon">
                <a class="icon-link is-primary">
                    <i class="mdi mdi-apps"></i>
                </a>
            </div>
            <div id="open-mobile-search" class="navbar-item is-icon">
                <a class="icon-link is-primary" href="javascript:void(0);">
                    <i data-feather="search"></i>
                </a>
            </div>
            <!-- Mobile menu toggler icon -->
            <div class="navbar-burger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <!-- Navbar mobile menu -->
        <div class="navbar-menu">
            <!-- Account -->
            <div class="navbar-item has-dropdown is-active">
                <a href="/navbar-v1-profile-main.html" class="navbar-link">
                    <img src="https://via.placeholder.com/150x150" data-demo-src="assets/img/avatars/jenna.png" alt="">
                    <span class="is-heading">Jenna Davis</span>
                </a>
                <!-- Mobile Dropdown -->
                <div class="navbar-dropdown">
                    <a href="/navbar-v1-feed.html" class="navbar-item is-flex is-mobile-icon">
                        <span><i data-feather="activity"></i>Feed</span>
                        <span class="menu-badge">87</span>
                    </a>
                    <a href="/navbar-v1-videos-home-v2.html" class="navbar-item is-flex is-mobile-icon">
                        <span><i data-feather="play-circle"></i>Watch</span>
                        <span class="menu-badge">21</span>
                    </a>
                    <a href="/navbar-v1-profile-friends.html" class="navbar-item is-flex is-mobile-icon">
                        <span><i data-feather="heart"></i>Friend Requests</span>
                        <span class="menu-badge">3</span>
                    </a>
                    <a href="/navbar-v1-profile-main.html" class="navbar-item is-flex is-mobile-icon">
                        <span><i data-feather="user"></i>Profile</span>
                    </a>
                    <a href="/navbar-v1-ecommerce-cart.html" class="navbar-item is-flex is-mobile-icon">
                        <span><i data-feather="shopping-cart"></i>Cart</span>
                        <span class="menu-badge">3</span>
                    </a>
                    <a href="#" class="navbar-item is-flex is-mobile-icon">
                        <span><i data-feather="bookmark"></i>Bookmarks</span>
                    </a>
                </div>
            </div>
            <!-- More -->
            <div class="navbar-item has-dropdown">
                <a href="/navbar-v1-settings.html" class="navbar-link">
                    <i data-feather="user"></i>
                    <span class="is-heading">Account</span>
                </a>
                <!-- Mobile Dropdown -->
                <div class="navbar-dropdown">
                    <a href="#" class="navbar-item is-flex is-mobile-icon">
                        <span><i data-feather="life-buoy"></i>Support</span>
                    </a>
                    <a href="/navbar-v1-settings.html" class="navbar-item is-flex is-mobile-icon">
                        <span><i data-feather="settings"></i>Settings</span>
                    </a>
                    <a href="logout.php" class="navbar-item is-flex is-mobile-icon">
                        <span><i data-feather="log-out"></i>Logout</span>
                    </a>
                </div>
            </div>
        </div>
        <!--Search-->
        <div class="mobile-search is-hidden">
            <div class="control">
                <input id="tipue_drop_input_mobile" class="input" placeholder="Search...">
                <div class="form-icon">
                    <i data-feather="search"></i>
                </div>
                <div class="close-icon">
                    <i data-feather="x"></i>
                </div>
                <div id="tipue_drop_content_mobile" class="tipue-drop-content"></div>
            </div>
        </div>
    </nav>
    <div class="view-wrapper">