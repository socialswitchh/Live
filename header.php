<?php
/*if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip'))
    ob_start("ob_gzhandler"); else ob_start(); */
ob_start();
session_start();
include('config.php');
$query = "SELECT *  FROM gt_users WHERE dummy_id = '" . $_SESSION['id'] . "'";
$query_retrived = mysqli_query($conn, $query) or die("Error:" . mysqli_error($conn));
$dummy_row = mysqli_fetch_assoc($query_retrived);
$result = mysqli_num_rows($query_retrived);

$main_query = "SELECT *  FROM gt_users WHERE id = '" . $_SESSION['id'] . "'";
$main_query_retrived = mysqli_query($conn, $main_query) or die("Error:" . mysqli_error($conn));
$main_row = mysqli_fetch_assoc($main_query_retrived);
$result = mysqli_num_rows($main_query_retrived);
//echo 'Main id-'. $main_row['id'];
//echo 'Dummy id-'. $dummy_row['id'];die;
/* Average Rating for profile */

$queryR = "SELECT p.*, COUNT(r.rating_number) as rating_num, FORMAT((SUM(r.rating_number) / COUNT(r.rating_number)),1) as average_rating, COUNT(r.user_id) as total_user FROM gt_posts as p LEFT JOIN rating as r ON r.post_id = p.id WHERE r.user_id = '" . $main_row['id'] . "' GROUP BY (r.post_id)";
$resultR = mysqli_query($conn, $queryR) or die("Error:" . mysqli_error($conn));
$postData = mysqli_fetch_assoc($resultR);
$p_n_r = mysqli_num_rows($resultR);
// print_r($postData);die;
$queryCR = "SELECT c.*, COUNT(cr.rating_number) as rating_num, FORMAT((SUM(cr.rating_number) / COUNT(cr.rating_number)),1) as average_rating, COUNT(cr.user_id) as total_user FROM comment as c LEFT JOIN comment_rating as cr ON cr.comment_id = c.id WHERE cr.user_id = '" . $main_row['id'] . "' AND rating_number != 'undefined'  GROUP BY (cr.post_id)";
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

    $sql_main_photo = "SELECT * FROM users_photo WHERE user_id = '" . $main_row["id"] . "' ORDER BY id DESC LIMIT 1"; 
    $query_main_retrived_photo = mysqli_query($conn, $sql_main_photo) or die("Error:" . mysqli_error($conn));
    $row_main_photo = mysqli_fetch_assoc($query_main_retrived_photo);
    $result_main_photo = mysqli_num_rows($query_main_retrived_photo); 
    if ($result_main_photo > 0){
         $main_photo = $row_main_photo['photo'];   
    } else {
        $main_photo = './upload/user/male.jpeg';
    } 
    
    $sql_dummy_photo = "SELECT * FROM users_photo WHERE user_id = '" . $dummy_row["id"] . "' ORDER BY id DESC LIMIT 1"; 
    $query_dummy_retrived_photo = mysqli_query($conn, $sql_dummy_photo) or die("Error:" . mysqli_error($conn));
    $row_dummy_photo = mysqli_fetch_assoc($query_dummy_retrived_photo);
    $result_dummy_photo = mysqli_num_rows($query_dummy_retrived_photo); 
    if ($result_dummy_photo > 0){
        $dummy_photo = $row_dummy_photo['photo'];   
    } else {
        $dummy_photo = './upload/user/male.jpeg';
    } 

    function getProfileRating($conn, $userid){  
       // echo $userid;
        $r_sql = "select post_user_id,  FORMAT((SUM(rating_number) / COUNT(rating_number)),1) as average_rating from rating where post_user_id = '$userid'  group by post_user_id";
        $r_result = mysqli_query($conn, $r_sql) or die("Error:" . mysqli_error($conn));
        $r_num_row = @mysqli_num_rows($r_result);
        $r_data = mysqli_fetch_assoc($r_result); 
        
        $cr_sql = "select post_id,  FORMAT((SUM(rating_number) / COUNT(rating_number)),1) as average_rating from comment_rating where user_id = '$userid'  group by user_id";
        $cr_result = mysqli_query($conn, $cr_sql) or die("Error:" . mysqli_error($conn));
        $cr_num_row = @mysqli_num_rows($cr_result);
        $cr_data = mysqli_fetch_assoc($cr_result);  
         
        
        if ($r_num_row != 0 and $cr_num_row == 0) {
            if(!empty($r_data['average_rating'])){ $pr = $r_data['average_rating']; } else { $pr = 0; }
            return $pr;
        } else if ($cr_num_row != 0 and $r_num_row == 0) {
            if(!empty($cr_data['average_rating'])){ $cr = $cr_data['average_rating']; } else { $cr = 0; }
            return $cr;
        } else {
            $c = $cr_data['average_rating'] / 1.5;
            $p = $r_data['average_rating'] + $c;
            $p1 = $p / 10;
            $profile_ratig = $p1 * 6;
            
                if(!empty($profile_ratig)){ $pcr = $profile_ratig; } else { $pcr = 0; }
            return $pcr;
            
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
    <title> Switchh </title>
    <link rel="icon" type="image/png" href="assets/img/logo/light original logo 1.png" />
    <!--  <script src="assets/js/new.jquery.min.js"></script> -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.15.1/dist/css/uikit.min.css" />

    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.1/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.1/dist/js/uikit-icons.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/fontisto@v3.0.4/css/fontisto/fontisto-brands.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">




    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/css/core.css">
    <link rel="stylesheet" href="assets/css/custom.css">
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
    <script>
        $(document).ready(function(e) {
            if (window.File && window.FileList && window.FileReader) {
                $(".image-file").on("change", function(e) {


                    var file = e.target.files,
                        imagefiles = $(".image-file")[0].files;
                    let numFiles = imagefiles.length;
                    if (numFiles > 0) {
                        $("#file-input:input").attr("disabled", true);
                    } else {
                        $("#file-input:input").attr("disabled", false);
                    }
                    var i = 0;
                    var dt = Date.now();
                    //alert(dt)
                    $.each(imagefiles, function(index, value) {
                        var f = file[i];
                        var fileReader = new FileReader();
                        fileReader.onload = (function(e) {

                            $('<div class="pip col-sm-3 col-4 boxDiv" align="center" style="margin:15px;">' +
                                '<div class="cross-thumbnail remove"><input type="" placeholder="x" class="button cross-btn feather feather-x"></div>' +
                                '<img style="width: 100px; height: 100px;" src="' + e.target.result + '" class="prescriptions">' +
                                '<p style="width:100px; overflow:hidden;">' + value.name + '</p>' +
                                '<input type="hidden" name="files[]" value=" ' + dt + '-' + value.name + '">' +
                                '</div>').insertAfter("#selected-images");

                            $(".remove").click(function() {
                                $(this).parent(".pip").remove();
                                if ($('.pip').length) {
                                    $("#file-input:input").attr("disabled", true);
                                } else {
                                    $("#file-input:input").attr("disabled", false);
                                }
                            });
                        });
                        fileReader.readAsDataURL(f);
                        i++;
                    });
                });
            } else {
                alert("Your browser doesn't support to File API")
            }

            /*const input = document.getElementById('file-input');
            const video = document.getElementById('video');
            const videoSource = document.createElement('source'); 

            input.addEventListener('change', function() {
                const files = this.files || []; 
               // if (!files.length) return;
               let numFilesV =  files.length;
                       if(numFilesV >0){ 
                             $("#files:input").attr("disabled",true);
                       }else{
                             $("#files:input").attr("disabled",false);
                       }
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('<div class="pip col-sm-3 col-4 boxDiv" align="center" style="margin-bottom: 20px;">' +
                        '<video id="video" width="150" height="150" src="' + e.target.result + '" controls></video>' +
                        '<p class="cross-image remove">Remove</p>' +
                        '</div>').insertAfter("#selected-images");
                    $(".remove").click(function() {
                        $(this).parent(".pip").remove();
                            if($('.pip').length){
                                $("#files:input").attr("disabled",true);
                            }else{
                                $("#files:input").attr("disabled",false);
                            }
                    });
                    videoSource.setAttribute('src', e.target.result);
                    video.appendChild(videoSource);
                    video.load();
                    //video.play();

                };
                reader.onprogress = function(e) {
                    console.log('progress: ', Math.round((e.loaded * 100) / e.total));
                };
                reader.readAsDataURL(files[0]);
            });*/


            $('.hide_notification_main').click(function(){  
                var main_id = '<?php echo $main_row['id'];?>';
                var dummy_id = '<?php echo $dummy_row['id'];?>';
                $.ajax({  
                    url: 'ajax/hide_notification.php', 
                    type: 'POST',  
                    data: {main_id:main_id, dummy_id:dummy_id},  
                    success: function(response) { 
                    $('.indicator').hide(); 
                    //window.setTimeout(function(){location.assign("feed.php")}, 1000); 
                    }    
                });  
            }); 



            $('#file-input').change(function() {
                const files = this.files || [];
                let numFilesV = files.length;
                if (numFilesV > 0) {
                    $("#files:input").attr("disabled", true);
                } else {
                    $("#files:input").attr("disabled", false);
                }
                var reader = new FileReader();
                reader.onload = function(file) {
                    var fileContent = file.target.result;
                    $('<div class="pip col-sm-3 col-4 boxDiv" align="center" style="margin-bottom: 20px;">' +
                        '<video id="video" width="150" height="150" src="' + fileContent + '" controls></video>' +
                        '<p class="cross-image remove">Remove</p>' +
                        '</div>').insertAfter("#selected-images");
                    $(".remove").click(function() {
                        $(this).parent(".pip").remove();
                        if ($('.pip').length) {
                            $("#files:input").attr("disabled", true);
                        } else {
                            $("#files:input").attr("disabled", false);
                        }
                    });

                }
                reader.readAsDataURL(this.files[0]);
            });





            $("#content").emojioneArea({
                pickerPosition: "right",
                tonesStyle: "bullet",
                events: {
                    keyup: function(editor, event) {
                        console.log(editor.html());
                        console.log(this.getText());
                    }
                }
            });

            $('#divOutside').click(function() {
                $('.emojionearea-button').click()
            })

            $("#posts").on('submit', function(e) {
                jQuery.noConflict();
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'ajax/posts.php',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $(".loader").show();
                    },
                    success: function(response) {
                        $(".form_class").hide();
                        $(".popup_class").show();
                    },
                });
            });

            /*$('.img_cls').click(function() {
                $(".vdo_cls").css('display', 'none');
            });

            $('.vdo_cls').click(function() {
                $(".img_cls").css('display', 'none');
            });*/

            $('.main_diary').click(function() {
                var header = $('.header').val();
                var content = $('.content').val();
                var diary = 'Yes';
                $.ajax({
                    url: 'ajax/posts.php',
                    type: 'POST',
                    data: {
                        header: header,
                        content: content,
                        diary: diary
                    },
                    success: function(response) {
                        $("#post_where").modal("show");
                        // $("#savemsg").html(response);  
                        //window.setTimeout(function(){location.assign("diary.php")}, 1000); 
                    }
                });
            });

            $('.changepassword').click(function() {
                var old_pass = $('.old_pass').val();
                var new_pass = $('.new_pass').val();
                $.ajax({
                    url: 'ajax/change_password.php',
                    type: 'POST',
                    data: {
                        old_pass: old_pass,
                        new_pass: new_pass
                    },
                    success: function(response) {
                        alert(response);
                        // $("#post_where").modal("show");  
                        // $("#savemsg").html(response);  
                        //window.setTimeout(function(){location.assign("diary.php")}, 1000); 
                    }
                });
            });

            $('.save_to_diary').click(function() {
                var id = $(this).attr("data-id");
                $.ajax({
                    url: 'ajax/save_to_diary.php',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        //$("#post_where").modal("show"); 
                        // $("#savemsg").html(response); 
                        window.setTimeout(function() {
                            location.assign("diary.php")
                        }, 1000);
                    }
                });
            });

            $('.main').click(function() {
                $.ajax({
                    url: 'ajax/post_main_id.php',
                    type: 'POST',
                    //data: {header:header, content:content, fileToUpload:fileToUpload}, 
                    success: function(response) {
                        // $("#post_where").modal("show");
                        // $("#savemsg").html(response);  
                        window.setTimeout(function() {
                            location.assign("feed.php")
                        }, 1000);
                    }
                });
            });

            $('.dummy').click(function() {
                var user_id = '<?php echo $dummy_row['id'] ?>';
                $.ajax({
                    url: 'ajax/post_dummy_id.php',
                    type: 'POST',
                    data: {
                        user_id: user_id
                    },
                    success: function(response) {
                        //$("#post_where").modal("show");
                        // $("#savemsg").html(response); 
                        window.setTimeout(function() {
                            location.assign("feed.php")
                        }, 1000);
                    }
                });
            });

        });
    </script>

    <script type="text/javascript">
        function showComments(id) {
            $.ajax({
                url: "ajax/show_comments.php",
                method: "POST",
                data: {
                    commentPostId: id
                },
                success: function(response) {
                    $('.showComments').html(response);
                }
            });
        }
        
         
        
        $(document).ready(function(e) {
            showComments();
           $('.commentForm').on('submit', function(event) {
                event.preventDefault();
                var formData = $(this).serialize(); 
                $.ajax({
                    url: "ajax/comments.php",
                    method: "POST",
                    data: formData,
                    dataType: "JSON",
                    success: function(response) {
                        if (!response.error) {
                            $('.commentForm')[0].reset();
                            $('.commentId').val('0');
                            $('.message').html(response.message);
                            showComments(response.postid);
                        } else if (response.error) {
                            $('.message').html(response.message);
                        }
                    }
                })
            });  
            
            
           /* $(document).on('click', '.post_comment', function() {
                var postId = $(this).attr("data-postid");  
             
                var postId = $('.postId').val();
                var userId = $('.userId').val();
                var commentId = $('.commentId').val(); 
                //var comment = $("textarea", $(this).parent()).val();
                //var comment = $(this).closest('p.fff').prev().find("textarea[name=comment]").val();
                let comment = $(this).siblings().find('').val();
                // var comment = $('textarea[name=comment]').val(); 
                alert('postid='+postId+'&userid='+userId+'&commentId='+commentId+'&comment='+comment);
                $.ajax({
                    url: "ajax/comments.php",
                    method: "POST",
                    data: {postId:postId, userId:userId, commentId:commentId, comment:comment},
                    dataType: "JSON",
                    success: function(response) {
                        if (!response.error) {
                            $('.commentForm')[0].reset();
                            $('.commentId').val('0');
                            $('.message').html(response.message);
                            showComments(response.postid);
                        } else if (response.error) {
                            $('.message').html(response.message);
                        }
                    }
                })
            });
            */

            $(document).on('click', '.reply', function() {
                var commentId = $(this).attr("id");
                //alert('id='+commentId);  
                var commentUsrId = $(this).attr("data-userid");
                $('.commentId').val(commentId);
                $('.commentt').focus();
                $.ajax({
                    url: "ajax/comments_get_user.php",
                    method: "POST",
                    data: {
                        commentUsrId: commentUsrId
                    },
                    dataType: "JSON",
                    success: function(response) {
                        console.log(response);
                        if (response.fname == 'null') {
                            $('.commentt').val('');
                        } else {
                            $('.commentt').val('@' + response.fname + ' ' + response.lname + ' ');
                        }
                    }
                });
            });

            $(document).on('click', '.ispostId', function() {
                var postId = $(this).attr("data-postid");
                showComments(postId);

            });
        });
    </script>

    <style>
        .loader {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid blue;
            border-right: 16px solid green;
            border-bottom: 16px solid red;
            width: 120px;
            height: 120px;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
        }

        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    <style>
        .tox-tinymce {
            font-size: .9rem;
            border-radius: 0.65rem;
        }

        .compose-option {
            position: relative;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            padding: 6px 16px;
            margin-right: 10px;
            background: #f7f7f7;
            border-radius: 500px;
            font-size: .85rem;
            color: #888da8;
            transition: all .3s;
        }

        .compose-option span {
            display: block;
            padding: 0 8px;
            cursor: pointer;
        }

        #feed-upload-input-2 {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .cross-thumbnail {
            position: absolute;
            z-index: 1;
            width: 10px;
            height: 10px;
            display: flex;
            justify-content: flex-end;
            width: 100px;
            align-items: center;

        }

        .cross-btn {
            border-radius: 50%;
            width: 15px;
            height: 15px;
            background: #a00000f7;
            border: none;
            padding: 0;
        }

        .modal-content {
            margin: 0 auto;
            width: 380px;
            margin-top: 15px;
        }

        .content-block {
            width: 350px !important;

            /* Friends carousel */
        }

        .MultiCarousel {
            float: left;
            overflow: hidden;
            padding: 15px;
            width: 100%;
            position: relative;
        }

        .MultiCarousel .MultiCarousel-inner {
            transition: 1s ease all;
            float: left;
        }

        .MultiCarousel .MultiCarousel-inner .item {
            float: left;
        }

        .MultiCarousel .MultiCarousel-inner .item>div {
            text-align: center;
            padding: 10px;
            margin: 10px;
            background: #f1f1f1;
            color: #666;
        }

        .MultiCarousel .leftLst,
        .MultiCarousel .rightLst {
            position: absolute;
            border-radius: 50%;
            top: calc(50% - 20px);
        }

        .MultiCarousel .leftLst {
            left: 0;
        }

        .MultiCarousel .rightLst {
            right: 0;
        }

        .MultiCarousel .leftLst.over,
        .MultiCarousel .rightLst.over {
            pointer-events: none;
            background: #ccc;
        }

        @media only screen and (min-width: 742px) {
            .card-mobile-carousel {
                display: none;
            }
        }
    </style>

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
    <!-- Js for friends carousel -->
    <script>
        $(window).on("load", function () {
            ResCarouselSize();
        });
        $(function() {
            ResCarouselSize();
        });

        var itemsMainDiv = ('.MultiCarousel');
        var itemsDiv = ('.MultiCarousel-inner');
        var itemWidth = "";

        $('.leftLst, .rightLst').click(function() {
            var condition = $(this).hasClass("leftLst");
            if (condition)
                click(0, this);
            else
                click(1, this)
        });
        $(window).resize(function() {
            ResCarouselSize();
        });

        //It is used to get some elements from btn
        function click(ell, ee) {
            var Parent = "#" + $(ee).parent().attr("id");
            var slide = $(Parent).attr("data-slide");
            ResCarousel(ell, Parent, slide);
        }
        //this function define the size of the items
        function ResCarouselSize() {
            var incno = 0;
            var dataItems = ("data-items");
            var itemClass = ('.item');
            var id = 0;
            var btnParentSb = '';
            var itemsSplit = '';
            var sampwidth = $(itemsMainDiv).width();
            var bodyWidth = $('body').width();
            $(itemsDiv).each(function() {
                id = id + 1;
                var itemNumbers = $(this).find(itemClass).length;
                btnParentSb = $(this).parent().attr(dataItems);
                itemsSplit = btnParentSb.split(',');
                $(this).parent().attr("id", "MultiCarousel" + id);


                if (bodyWidth >= 1200) {
                    incno = itemsSplit[3];
                    itemWidth = sampwidth / incno;
                } else if (bodyWidth >= 992) {
                    incno = itemsSplit[2];
                    itemWidth = sampwidth / incno;
                } else if (bodyWidth >= 768) {
                    incno = itemsSplit[1];
                    itemWidth = sampwidth / incno;
                } else {
                    incno = itemsSplit[0];
                    itemWidth = sampwidth / incno;
                }
                $(this).css({
                    'transform': 'translateX(0px)',
                    'width': itemWidth * itemNumbers
                });
                $(this).find(itemClass).each(function() {
                    $(this).outerWidth(itemWidth);
                });

                $(".leftLst").addClass("over");
                $(".rightLst").removeClass("over");

            });
        }
        //this function used to move the items
        function ResCarousel(e, el, s) {
            var leftBtn = ('.leftLst');
            var rightBtn = ('.rightLst');
            var translateXval = '';
            var divStyle = $(el + ' ' + itemsDiv).css('transform');
            var values = divStyle.match(/-?[\d\.]+/g);
            var xds = Math.abs(values[4]);
            if (e == 0) {
                translateXval = parseInt(xds) - parseInt(itemWidth * s);
                $(el + ' ' + rightBtn).removeClass("over");

                if (translateXval <= itemWidth / 2) {
                    translateXval = 0;
                    $(el + ' ' + leftBtn).addClass("over");
                }
            } else if (e == 1) {
                var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();
                translateXval = parseInt(xds) + parseInt(itemWidth * s);
                $(el + ' ' + leftBtn).removeClass("over");

                if (translateXval >= itemsCondition - itemWidth / 2) {
                    translateXval = itemsCondition;
                    $(el + ' ' + rightBtn).addClass("over");
                }
            }
            $(el + ' ' + itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');
        }
    </script>


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
                <a class="navbar-item" href="feed.php">
                    <img class="light-image" src="assets/img/logo/light original logo 1.png" alt="">
                    <img class="dark-image" src="assets/img/logo/light original logo 1.png" alt="">
                </a>
            </div>
        </div>
    </div>
    <nav class="navbar mobile-navbar is-hidden-desktop" aria-label="main navigation">
        <!-- Brand -->
        <div class="navbar-brand">
            <a class="navbar-item" href="feed.php">
                <img class="light-image" src="assets/img/logo/light original logo 1.png" alt="">
                <img class="dark-image" src="assets/img/logo/light original logo 1.png" alt="">
            </a>


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
                                <ul class="uk-switcher uk-margin">
                                    <li>

                                        <div class="nav-drop-body is-friend-requests"> 
                                            <div class="media">
                                                <figure class="media-left">
                                                    <p class="image"> 
                                                       <img src="#" data-demo-src="assets/img/avatars/nelly.png" data-user-popover="9" alt="" />
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
                                            <div class="media">
                                                <figure class="media-left">
                                                    <p class="image">
                                                        <img src="#" data-demo-src="assets/img/avatars/edward.jpeg" data-user-popover="5" alt="" />
                                                    </p>
                                                </figure>
                                                <div class="media-content">
                                                    <a href="#">Edward Mayers</a>
                                                    <span>That was a real pleasure seeing you last time we really should...</span>
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
                                    <li>
                                        <div class="nav-drop-body is-friend-requests">
                                            <!-- Message -->
                                            <div class="media">
                                                <figure class="media-left">
                                                    <p class="image">
                                                        <img src="#" data-demo-src="assets/img/avatars/nelly.png" data-user-popover="9" alt="" />
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
                                            <div class="media">
                                                <figure class="media-left">
                                                    <p class="image">
                                                        <img src="#" data-demo-src="assets/img/avatars/edward.jpeg" data-user-popover="5" alt="" />
                                                    </p>
                                                </figure>
                                                <div class="media-content">
                                                    <a href="#">Somya</a>
                                                    <span>That was a real pleasure seeing you last time we really should...</span>
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
       <!-- <div class="navbar-menu">
         
            <div class="navbar-item has-dropdown is-active">
                <a href="/navbar-v1-profile-main.html" class="navbar-link">
                    <img src="#" data-demo-src="assets/img/avatars/jenna.png" alt="">
                    <span class="is-heading">Jenna Davis</span>
                </a>
               
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
                        <span><i data-feather="shopping-cart"></i>Cart1</span>
                        <span class="menu-badge">3</span>
                    </a>
                    <a href="#" class="navbar-item is-flex is-mobile-icon">
                        <span><i data-feather="bookmark"></i>Bookmarks</span>
                    </a>
                </div>
            </div>
            
            <div class="navbar-item has-dropdown">
                <a href="/navbar-v1-settings.html" class="navbar-link">
                    <i data-feather="user"></i>
                    <span class="is-heading">Account</span>
                </a>
                
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
        </div>-->
       
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
    </div>
    </div>
    <nbody>
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
                    <a href="feed.php" class="navbar-item">
                        <img class="logo light-image" src="assets/img/logo/light original logo 1.png" width="112" height="28" alt="">
                        <img class="logo dark-image" src="assets/img/logo/light original logo 1.png" width="112" height="28" alt="">
                    </a>
                </div>
                <div class="navbar-menu">
                    <div class="navbar-start">
                        <!-- Navbar Search -->

                        <!---------------------- Friend requests Section -------------------->


                        <!---------------------- Notifications Section -------------------->
                        <?php
                        $sql_noti_count = "SELECT *  FROM gt_notification WHERE request_to_id='" . $main_row['id'] . "' AND status='0'";
                        $result_noti_count = $conn->query($sql_noti_count);
                        $num_row_noti_count = @mysqli_num_rows($result_noti_count);

                        $sql_dnoti_count = "SELECT *  FROM gt_dummy_notification WHERE request_to_id='" . $dummy_row['id'] . "' AND status='0'";
                        $result_dnoti_count = $conn->query($sql_dnoti_count);
                        $num_row_dnoti_count = @mysqli_num_rows($result_dnoti_count);
                        ?>
                        <div class="navbar-item is-icon drop-trigger hide_notification_main">
                            <a class="icon-link is-active" href="javascript:void(0);">
                                <i data-feather="bell"></i>
                                <?php if($num_row_noti_count > 0 or $num_row_dnoti_count> 0){?>
                                    <span></span> 
                                <?php } else{ ?>
                                    <span class="indicator"></span>
                                <?php } ?>
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
                                                        $sql =  "SELECT *  FROM gt_notification WHERE request_to_id='" . $dummy_row['id'] . "' ORDER BY id DESC";
                                                        //echo $sql;
                                                        $result = $conn->query($sql);
                                                        $num_row = @mysqli_num_rows($result);
                                                        if ($num_row > 0) {
                                                            while ($row = $result->fetch_assoc()) {
                                                        ?>
                                                                <a href="dummy_user_profile.php?id=<?php echo $row['request_from_id']; ?>&request_to_id=<?php echo $row['request_to_id']; ?>">
                                                                    <div class="media">
                                                                        <figure class="media-left">
                                                                            <p class="image">
                                                                                <?php if (!empty($row['user_image'])) { ?>
                                                                                    <img src="./upload/p2.jpg" data-demo-src="assets/img/avatars/david.jpg" alt="">
                                                                                <?php } else { ?>
                                                                                    <img src="./image/male.jpeg" alt="">
                                                                                <?php } ?>
                                                                            </p>
                                                                        </figure>
                                                                        <div class="media-content">

                                                                            <span><?php echo $row['message']; ?></span>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <!-- Notification -->
                                                        <?php }
                                                        } ?>
                                                    </div>
                                                </li>
                                                <!-- Second Account Friend request -->
                                                <li>
                                                    <div class="nav-drop-body is-notifications">
                                                        <?php
                                                        $sql =  "SELECT *  FROM gt_notification WHERE request_to_id='" . $main_row['id'] . "' ORDER BY id DESC";
                                                        //echo $sql; 
                                                        $result = $conn->query($sql);
                                                        $num_row = @mysqli_num_rows($result);
                                                        if ($num_row > 0) {
                                                            while ($row = $result->fetch_assoc()) {
                                                        ?>

                                                                <a href="main_user_profile.php?id=<?php echo $row['request_from_id']; ?>&request_to_id=<?php echo $row['request_to_id']; ?>">
                                                                    <div class="media">
                                                                        <figure class="media-left">
                                                                            <p class="image">
                                                                                <?php if (!empty($row['user_image'])) { ?>
                                                                                    <img src="<?php echo $row['user_image']; ?>" data-demo-src="assets/img/avatars/david.jpg" alt="">
                                                                                <?php } else { ?>
                                                                                    <img src="./image/male.jpeg" alt="">
                                                                                <?php } ?>
                                                                            </p>
                                                                        </figure>
                                                                        <div class="media-content">
                                                                            <span><?php echo $row['message']; ?></span>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                        <?php }
                                                        } ?>
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
                        $sql_noti_count_msg = "SELECT *  FROM chat WHERE reciever_userid='" . $_SESSION['id'] . "' GROUP BY sender_userid";
                        $result_noti_count_msg = $conn->query($sql_noti_count_msg);
                        $num_row_noti_count_msg = @mysqli_num_rows($result_noti_count_msg);
                        ?>
                       
                        <!--<div class="navbar-item is-icon open-chat">
                            <a class="icon-link is-primary" href="javascript:void(0);">
                                <i data-feather="message-square"></i>
                                <span class="indicator"></span>
                            </a>
                        </div>
                        <div id="explorer-trigger" class="navbar-item is-icon">
                            <a class="icon-link is-primary">
                                <i class="mdi mdi-apps"></i>
                            </a>
                        </div>-->
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
                                <img src="<?php echo $main_photo; ?>" data-demo-src="assets/img/avatars/jenna.png" alt="">
                                <span class="indicator"></span>
                            </div>
                            <div class="nav-drop is-account-dropdown">
                                <div class="inner">
                                    <div class="nav-drop-header">
                                        <span class="username">SWITCHH</span>
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
                <a class="navbar-item" href="feed.php">
                    <img class="light-image" src="assets/img/logo/light original logo 1.png" alt="">
                    <img class="dark-image" src="assets/img/logo/light original logo 1.png" alt="">
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
                                                <!-- Notification -->
                                                <?php
                                                $sql =  "SELECT *  FROM gt_notification
                            WHERE request_from_id='" . $dummy_row['id'] . "' ORDER BY id DESC";
                                                //echo $sql;
                                                $result = $conn->query($sql);
                                                $num_row = @mysqli_num_rows($result);
                                                if ($num_row > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                ?>
                                                        <a href="dummy_user_profile.php?id=<?php echo $row['request_to_id']; ?>&request_to_id=<?php echo $row['request_from_id']; ?>">
                                                            <div class="media">
                                                                <figure class="media-left">
                                                                    <p class="image">
                                                                        <?php if (!empty($row['user_image'])) { ?>
                                                                            <img src="./upload/p2.jpg" data-demo-src="assets/img/avatars/david.jpg" alt="">
                                                                        <?php } else { ?>
                                                                            <img src="./image/male.jpeg" alt="">
                                                                        <?php } ?>
                                                                    </p>
                                                                </figure>
                                                                <div class="media-content">

                                                                    <span><?php echo $row['message']; ?></span>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <!-- Notification -->
                                                <?php }
                                                } ?>
                                            </div>
                                        </li>
                                        <!-- Second Account Friend request -->
                                        <li>
                                            <div class="nav-drop-body is-notifications">
                                                <?php
                                                $sql =  "SELECT *  FROM gt_notification WHERE request_to_id='" . $main_row['id'] . "' ORDER BY id DESC";
                                                //echo $sql; 
                                                $result = $conn->query($sql);
                                                $num_row = @mysqli_num_rows($result);
                                                if ($num_row > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                ?>
                                                        <a href="main_user_profile.php?id=<?php echo $row['request_to_id']; ?>&request_to_id=<?php echo $row['request_from_id']; ?>">
                                                            <div class="media">
                                                                <figure class="media-left">
                                                                    <p class="image">
                                                                        <?php if (!empty($row['user_image'])) { ?>
                                                                            <img src="<?php echo $row['user_image']; ?>" data-demo-src="assets/img/avatars/david.jpg" alt="">
                                                                        <?php } else { ?>
                                                                            <img src="./image/male.jpeg" alt="">
                                                                        <?php } ?>
                                                                    </p>
                                                                </figure>
                                                                <div class="media-content">
                                                                    <span><?php echo $row['message']; ?></span>
                                                                </div>
                                                            </div>
                                                        </a>

                                                <?php }
                                                } ?>
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
                
                <!--<div id="mobile-explorer-trigger" class="navbar-item is-icon">
                    <a class="icon-link is-primary">
                        <i class="mdi mdi-apps"></i>
                    </a>
                </div>-->
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
                    
                    <a href="main_profile.php" class="navbar-link">
                        <img src="<?php echo $main_photo; ?>" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <span  class="span-title"><?php echo $main_row['fname']. ' '. $main_row['lname']; ?> </span>
                        <span class="story-meta"><?php echo $main_row['unique_name']; ?></span>
                    </a> 
                     
                    <a href="dummy_profile.php" class="navbar-link">
                        <img src="<?php echo $dummy_photo; ?>" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <span  class="span-title"><?php echo $dummy_row['fname']; ?> 
                           <span class="rating_star-m">
                                <span class="star-textm">
                                  <?php  echo  getProfileRating($conn, $dummy_row['id']);?>/5
                                    <label class="star-checked">★</label>
                                </span>
                            </span>
                        </span>
                        <!--<span class="story-meta">Doctor Engineer StudentDoctor Engineer Student</span>-->
                         <?php
                            $sql = mysqli_query($conn, "SELECT * from gt_users where id='" . $dummy_row['id'] . "'");
                            $row = mysqli_fetch_array($sql);
                            $anonymous_id = $row['anonymous']; 
                            $sql1 = mysqli_query($conn, "SELECT anonymous_name from gt_anonymous_name where id in (" . $anonymous_id . ")");?>
                            <span class="story-meta">
                                 <?php while ($row1 = @mysqli_fetch_array($sql1)) {  echo '&nbsp;'.$row1['anonymous_name'];   } ?>
                            </span>
                    </a> 
                    <!-- Mobile Dropdown -->
                  <!--  <div class="navbar-dropdown">
                        <a href="/navbar-v1-feed.html" class="navbar-item is-flex is-mobile-icon">
                            <span><i data-feather="activity"></i>Feed</span>
                            <span class="menu-badge">817</span>
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
                    </div>-->
                </div>
                <!-- More -->
                <div class="navbar-item has-dropdown">
                  <!--  <a href="/navbar-v1-settings.html" class="navbar-link">
                        <i data-feather="user"></i>
                        <span class="is-heading">Account</span>
                    </a>-->
                    <!-- Mobile Dropdown -->
                    <div class="navbar-dropdown">
                       <!-- <a href="#" class="navbar-item is-flex is-mobile-icon">
                            <span><i data-feather="life-buoy"></i>Support</span>
                        </a>
                        <a href="#" class="navbar-item is-flex is-mobile-icon">
                            <span><i data-feather="settings"></i>Settings</span>
                        </a>-->
                        <a href="logout.php" class="navbar-item is-flex is-mobile-icon">
                            <span><i data-feather="log-out"></i>Logout</span>
                        </a>
                    </div>
                </div>
            </div>
            <!--Search-->
            <div class="mobile-search is-hidden">
                <div class="control">
                    <form action="search.php" method="get">
                        <input id="tipue_drop_input_mobile" name="search_data" class="input is-rounded" type="text" placeholder="Search...">
                        <div class="close-icon">
                            <i data-feather="x"></i>
                        </div>
                        <div class="form-icon">
                            <i data-feather="search"></i>
                        </div>

                        <div id="tipue_drop_content_mobile" class="tipue-drop-content"></div>
                    </form>
                </div>
            </div>
        </nav>
        <div class="view-wrapper">