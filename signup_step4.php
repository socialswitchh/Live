<?php 
session_start(); 
include_once('header.php');
include_once('config.php'); 
$query = "SELECT *  FROM gt_users WHERE dummy_id = '" . $_SESSION['id'] . "'";
$query_retrived = mysqli_query($conn, $query) or die("Error:" . mysqli_error($conn));
$rows = mysqli_fetch_assoc($query_retrived);
$result = mysqli_num_rows($query_retrived); 

$main_query = "SELECT *  FROM gt_users WHERE id = '" . $_SESSION['id'] . "'";
$main_query_retrived = mysqli_query($conn, $main_query) or die("Error:" . mysqli_error($conn));
$main_row = mysqli_fetch_assoc($main_query_retrived);
$result = mysqli_num_rows($main_query_retrived);

/* Average Rating for profile */
$queryR = "SELECT p.*, COUNT(r.rating_number) as rating_num, FORMAT((SUM(r.rating_number) / COUNT(r.rating_number)),1) as average_rating, COUNT(r.user_id) as total_user FROM gt_posts as p LEFT JOIN rating as r ON r.post_id = p.id WHERE r.user_id = '" . $rows['id'] . "' GROUP BY (r.post_id)";
$resultR = mysqli_query($conn, $queryR) or die("Error:" . mysqli_error($conn));
$postData = mysqli_fetch_assoc($resultR);
$p_n_r = mysqli_num_rows($resultR);
// print_r($postData);die;
$queryCR = "SELECT c.*, COUNT(cr.rating_number) as rating_num, FORMAT((SUM(cr.rating_number) / COUNT(cr.rating_number)),1) as average_rating, COUNT(cr.user_id) as total_user FROM comment as c LEFT JOIN comment_rating as cr ON cr.comment_id = c.id WHERE cr.user_id = '" . $rows['id'] . "' AND rating_number != 'undefined'  GROUP BY (cr.post_id)";
$resultCR = mysqli_query($conn, $queryCR) or die("Error:" . mysqli_error($conn));
$commentDataCR = mysqli_fetch_assoc($resultCR);
$c_n_r = mysqli_num_rows($resultCR);
$post_average_rating = @$postData['average_rating'];
$comment_average_rating = @$commentDataCR['average_rating'];
if ($p_n_r != 0 and $c_n_r == 0) {
    $profile_ratig = $post_average_rating;
    if ($profile_ratig) {
        mysqli_query($conn, "UPDATE gt_users SET profile_rating='" . $profile_ratig . "' WHERE dummy_id = '" . $_SESSION['id'] . "'");
    }
} else if ($c_n_r != 0 and $p_n_r == 0) {
    $profile_ratig = $comment_average_rating;
    if ($profile_ratig) {
        mysqli_query($conn, "UPDATE gt_users SET profile_rating='" . $profile_ratig . "' WHERE dummy_id = '" . $_SESSION['id'] . "'");
    }
} else {
    $c = $comment_average_rating / 1.5;
    $p = $post_average_rating + $c;
    $p1 = $p / 10;
    $profile_ratig = $p1 * 6;
    if ($profile_ratig) {
        mysqli_query($conn, "UPDATE gt_users SET profile_rating='" . $profile_ratig . "' WHERE dummy_id = '" . $_SESSION['id'] . "'");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> Switchh </title>
    <link rel="icon" type="image/png" href="assets/img/logo/light original logo 1.png" /> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">
        function preventBack() {
            window.history.forward();
        }
        setTimeout("preventBack()", 0);
        window.onunload = function() {
            null
        };
    </script>
    
    <!-- Google Tag Manager --> 
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': 
                    new Date().getTime(),
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
    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/css/core.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.15.1/dist/css/uikit.min.css" />
    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.1/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.1/dist/js/uikit-icons.min.js"></script>
    <script src="assets/js/tinymce-old/jquery.tinymce.min.js"></script>
</head>
<body>
    <script id="__bs_script__">
        //<![CDATA[
        document.write("<script async src='/browser-sync/browser-sync-client.js?v=2.27.10'><\/script>".replace("HOST", location.hostname));
        //]]>
    </script>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KQHJPZP" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <!-- Pageloader -->
    <div class="pageloader"></div>
    <div class="infraloader is-active"></div>
    <div class="signup-wrapper">
        <div class="fake-nav">
            <a href="/" class="logo">
                <img src="assets/img/logo/light original logo 1.png" width="112" height="28" alt="">
            </a>
        </div>
        <div class="process-bar-wrap">
            <div class="process-bar">
                <div class="progress-wrap">
                    <div class="track"></div>
                    <div class="bar"></div>
                    <div id="step-dot-1" class="dot is-first is-active is-current" data-step="0">
                        <i data-feather="smile"></i>
                    </div>
                    <div id="step-dot-2" class="dot is-second" data-step="25">
                        <i data-feather="user"></i>
                    </div>
                    <div id="step-dot-3" class="dot is-third" data-step="50">
                        <i data-feather="image"></i>
                    </div>
                    <div id="step-dot-4" class="dot is-fourth" data-step="75">
                        <i data-feather="lock"></i>
                    </div>
                    <div id="step-dot-5" class="dot is-fifth" data-step="100">
                        <i data-feather="flag"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="outer-panel">

            <div class="outer-panel-inner">

                <div class="process-title">

                    <h2 id="step-title-1" class="step-title">Share some details.</h2>

                    <h2 id="step-title-2" class="step-title">Share some details.</h2>

                    <h2 id="step-title-3" class="step-title">Select your badge.</h2>

                    <h2 id="step-title-4" class="step-title">Select your Intrest.</h2>

                    <h2 id="step-title-5" class="step-title">You're all set. Ready?</h2>
                </div>

                <div id="signup-panel-5" class="process-panel-wrap  is-active">
                    <div class="form-panel" style="padding:0;">

                        <div class="nain-div">
                            <div class="switch-main switch-main-search-suggestion">
                                <ul uk-tab class="head-switch">
                                    <li><a href="#">Main Profile</a></li>
                                    <li><a href="#">Dummy Profile</a></li>
                                </ul>

                                <ul class="uk-switcher uk-margin w-100">
                                    <li>
                                        <div class="card">
                                            <div class="card-body cu-pad" style="border:none;">
                                                <!-- Suggested friend -->
                                                <?php 
                                                        $sql_fr = "SELECT * FROM gt_friend_request WHERE request_from_id='".$_SESSION['id']."'";
                                                        $result_fr = $conn->query($sql_fr);
                                                        $num_row_fr = @mysqli_num_rows($result_fr); 
                                                        $blank_array = array();
                                                            while ($row_fr = $result_fr->fetch_assoc()) {  
                                                                $blank_array[] = $row_fr['request_to_id']; 
                                                        }
                                                        $suggestions_ids = implode(',',$blank_array); 
                                                        //echo $suggestions_ids;
                                                        $sql = "SELECT gt_users.id as userid, gt_users.fname, gt_users.lname, gt_users.photo, gt_users.is_login, gt_friend_request.request_from_id, gt_friend_request.request_to_id FROM gt_friend_request INNER JOIN gt_users ON gt_friend_request.request_from_id=gt_users.id WHERE request_to_id IN ('".$suggestions_ids."') AND request_from_id !='".$_SESSION['id']."'";
                                                        //echo $sql;
                                                        $result = $conn->query($sql);
                                                        $num_row = @mysqli_num_rows($result);
                                                        if ($num_row>0) {
                                                            while ($row = $result->fetch_assoc()) { 
                                                ?> 
                                                    <div class="add-friend-block p-sm-0 transition-block">
                                                    <!--  <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/nelly.png" data-user-popover="9" alt=""> -->
                                                        <?php if($row['photo']!=''){?>
                                                        <img src="<?php echo $row['photo']?>" alt=""> 
                                                        <?php }else{ ?>
                                                        <img src="./upload/user/male.jpg" alt="">
                                                        <?php } ?>
                                                        <div class="page-meta">
                                                            <span><?php echo $row['fname'].' '.$row['lname']?></span>
                                                            <!-- <span>Delhi</span> -->
                                                        </div>
                                                        <div class="add-friend add-transition">
                                                            <i data-feather="user-plus"></i>
                                                        </div>
                                                    </div>
                                                 <?php }} ?> 
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <section>
                                            <div class="card">
                                                <div class="card-body cu-pad" style="border:none;">
                                                    <!-- Suggested friend --> 
					                                <?php 
						                            	$sql_get_suggestion_follow = "SELECT * FROM gt_users WHERE id NOT IN('".$dummy_row['id']."') and anonymous IN (".$dummy_row['anonymous'].") ORDER BY FIELD(anonymous, ".$dummy_row['anonymous']."), profile_rating DESC"; 
						                                $result_suggestion_follow =  mysqli_query($conn, $sql_get_suggestion_follow);  
						                                while($row_suggestion_follow = $result_suggestion_follow->fetch_assoc()){  
						                                 $sql11 = "SELECT * FROM gt_friend_request WHERE request_from_id = '".$dummy_row['id']."' and request_to_id='".$row_suggestion_follow["id"]."'";  
						                                $result1 = mysqli_query($conn, $sql11) or die("Error:".mysqli_error($conn));
						                                $row11 = mysqli_fetch_assoc($result1);  
						                                if($row_suggestion_follow["id"] == $row11['request_to_id'])
						                                {
						                                	$button = '<div class="checkmark-wrapper">
																				    <svg class="checkmark is-xs" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
																				        <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"></circle>
																				        <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"></path>
																				    </svg>
																				</div>';
						                                }else{

						                                 $button = '<div class="add-friend add-transition sending_follow_request" data-userid="'. $row_suggestion_follow['id'].'" data-from="'.$rows['id'].'" data-fullname="'.$row_suggestion_follow['fname'].' '.$row_suggestion_follow['lname'].'"> 
						                                                            <i data-feather="user-plus"></i> 
					                                                        	</div>';

					                                    }

					                        		?> 
													      
                                                    <div class="add-friend-block p-sm-0 transition-block">
                                                        <!-- <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/nelly.png" data-user-popover="9" alt=""> --> 
                                                        <?php if(!empty($row_suggestion_follow['photo'])){?> 
															<img src="<?php echo $row_suggestion_follow['photo'];?>" height="30" width="30" />  
														<?php }else{ echo '<img src="./upload/dummy_user.jpeg"  height="30" width="30">'; } ?> 
                                                        <div class="page-meta" style="min-height: 60px !important;">
                                                            <span class="profile-suggestion">
                                                                <span class="d-block"><?php echo $row_suggestion_follow['fname']?></span>
                                                                <span class="rating_star">
                                                                    <span class="star-text" style="margin-bottom: 0 !important;">
                                                                       <?php  echo  getProfileRating($conn, $dummy_row['id']);?>/5
                                                                       <label class="star-checked">★</label>
                                                                    </span>
                                                                </span>
                                                            </span>
				                                            <?php 
																$sql = mysqli_query($conn, "SELECT anonymous from gt_users where id='".$row_suggestion_follow['id']."'");  
																$row = mysqli_fetch_array($sql);   
																$anonymous_id = $row['anonymous'];   
																$sql1 = mysqli_query($conn, "SELECT anonymous_name from gt_anonymous_name where id in (".$anonymous_id.")");  
																while($row1 = @mysqli_fetch_array($sql1)) {   
															?> 
																<span class="sugges-tion"><?php echo $row1['anonymous_name'];?></span>
															<?php } ?>
                                                        </div>   
                                                        	<?php echo $button; ?>
														 

                                                    </div> 
                                                  <?php } ?>    
                                                </div>
                                            </div>
                                        </section>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="buttons">
                       <!-- <a class="button process-button" href="signup_step3.php">Back</a>-->
                        <a class="button process-button is-next" data-step="step-dot-5" href="feed.php">Next</a>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .form-panel{
                overflow: auto;
               max-height: 70vh;
            }
            *+.uk-margin{
                margin-top: 0 !important;
            }
            .uk-tab>*>a {
                padding: 5px 34px;
                color: #999;
                border-bottom: 4px solid transparent;
            }

            .uk-tab>*>a {
                padding: 5px 34px;
                color: #999;
                border-bottom: 4px solid transparent;
            }
        </style>
    </div>
    <script>
        $(document).ready(function() { 
            $('.anonymous_checkbox').change(function() { 
                if ($('.anonymous_checkbox:checked').length >= 3) { 
                    $('.anonymous_checkbox:not(:checked)').attr('disabled', true); 
                } else { 
                    $('.anonymous_checkbox:not(:checked)').removeAttr('disabled'); 
                } 
            });

            $('.badges_checkbox').change(function() { 
                if ($('.badges_checkbox:checked').length >= 1) { 
                    $('.badges_checkbox:not(:checked)').attr('disabled', true); 
                } else { 
                    $('.badges_checkbox:not(:checked)').removeAttr('disabled'); 
                } 
            }); 


            $(function() { 
                $("form[name='badges']").validate({ 
                    /* rules: {  
                    	title: "required",  
                    }, 

                    messages: {  
                    	title: "Choose badges",  
                    },  */ 
                    submitHandler: function(form) { 
                        $.ajax({ 
                            url: form.action, 
                            type: form.method, 
                            data: $(form).serialize(), 
                            success: function(response) { 
                                $('.step2').hide(); 
                                $('.step3').show();  
                            } 
                        }); 
                    } 
                });  
            }); 

            $(".alloptions").on("click", ".anonymous_name", function() { 
                var an_id = $(this).data("an_id"); 
                var mode = $(this).val(); 
                const rowTemp = `<tr data-mode=${mode} > <td><span><button type="button" class="close remove_anonymous anr_class" aria-label="Close">${an_id}<span aria-hidden="true">&times;</span></button></span> </td> </tr>`; 
                $('.db_value').hide(); 
                if ($(this).is(":checked")) { 
                    $(".selected_data").append(rowTemp); 
                } else { 
                    $("[data-mode='" + mode + "']").remove(); 
                } 
            });

            $(document).on('click', '.remove_anonymous', function(e) { 
                $(this).closest('tr').children('td').hide(); 
                var len = $(this).closest('tr').children('td').length; 
                if (len == 3) { 
                    $('.anonymous_checkbox:not(:checked)').attr('disabled', true); 
                    $('.next_btn:not(:checked)').attr('disabled', false); 
                } else { 
                    $('.anonymous_checkbox:not(:checked)').removeAttr('disabled'); 
                    $('.next_btn:not(:checked)').attr('disabled', true); 
                } 
            });

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



            
 
    </script>

    <!-- Concatenated js plugins and jQuery -->

    <script src="assets/js/app.js"></script>

    <script src="https://js.stripe.com/v3/"></script>

    <script src="assets/data/tipuedrop_content.js"></script>

    <script src="assets/js/jquery.validate.js"></script>

    <!-- Core js -->

    <script src="assets/js/global.js"></script>



    <!-- Navigation options js -->

    <script src="assets/js/navbar-v1.js"></script>

    <script src="assets/js/navbar-v2.js"></script>

    <script src="assets/js/navbar-mobile.js"></script>

    <script src="assets/js/navbar-options.js"></script>

    <script src="assets/js/sidebar-v1.js"></script>



    <!-- Core instance js -->

    <script src="assets/js/main.js"></script>

    <script src="assets/js/chat.js"></script>

    <script src="assets/js/touch.js"></script>

    <script src="assets/js/tour.js"></script> 

    <!-- Components js -->

    <script src="assets/js/explorer.js"></script>

    <script src="assets/js/widgets.js"></script>

    <script src="assets/js/modal-uploader.js"></script>

    <script src="assets/js/popovers-users.js"></script>

    <script src="assets/js/popovers-pages.js"></script>

    <script src="assets/js/lightbox.js"></script> 

    <script src="assets/js/signup.js"></script>
 

</body>



</html>