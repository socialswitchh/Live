<?php  

session_start(); 

include_once('../config.php');     
function getProfileRating($conn, $userid){  
        $r_sql = "select post_user_id,  FORMAT((SUM(rating_number) / COUNT(rating_number)),1) as average_rating from rating where user_id = '$userid'  group by user_id";
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
$commentPostId = @$_POST['commentPostId'];  

$commentQuery = "SELECT comt.id, comt.reply_id, comt.user_id, comt.comment, u.id as u_id, u.dummy_id, u.fname, u.lname, u.unique_name, u.photo, u.anonymous FROM comment as comt INNER JOIN gt_users as u ON u.id = comt.user_id WHERE reply_id = '0' AND post_id='".$commentPostId."' ORDER BY id DESC"; 

//echo $commentQuery;

$commentsResult = mysqli_query($conn, $commentQuery) or die("database error:". mysqli_error($conn)); 

$commentHTML = '';  

$commentHTML .= '<div class="comments-body has-slimscroll f3">';  



$sql_dummy_photo = "SELECT * FROM users_photo WHERE user_id = '" . $dummy_row['user_id'] . "' AND type='dummy' ORDER BY id DESC LIMIT 1";

$query_retrived_dummy_photo = mysqli_query($conn, $sql_dummy_photo) or die("Error:" . mysqli_error($conn));

$row_dummy_photo = mysqli_fetch_assoc($query_retrived_dummy_photo);

$result_dummy_photo = mysqli_num_rows($query_retrived_dummy_photo);



while($comment = mysqli_fetch_assoc($commentsResult)){ 

    $queryR = "SELECT c.*, COUNT(cr.rating_number) as rating_num, FORMAT((SUM(cr.rating_number) / COUNT(cr.rating_number)),1) as average_rating, COUNT(cr.user_id) as total_user FROM comment as c LEFT JOIN comment_rating as cr ON cr.comment_id = c.id WHERE c.id = '".$comment["id"]."' AND rating_number != 'undefined'  GROUP BY (cr.comment_id)"; 

    $resultR = $conn->query($queryR);  

    $postData = $resultR->fetch_assoc(); 

    

    $sql_photo = "SELECT * FROM users_photo WHERE user_id = '" . $comment["u_id"] . "' ORDER BY id DESC LIMIT 1"; 

    $query_retrived_photo = mysqli_query($conn, $sql_photo) or die("Error:" . mysqli_error($conn));

    $row_photo = mysqli_fetch_assoc($query_retrived_photo);

    $result_photo = mysqli_num_rows($query_retrived_photo); 

    if ($result_photo > 0){

        $comment_photo = $row_photo['photo'];   

    } else {

        $comment_photo = './upload/user/male.jpeg';

    }

            
    if(!empty($postData['average_rating'])) { 

        $av_rating = $postData['average_rating'];  

    } else { 

        $av_rating = '0';  

    }  

    $tt_user = @$postData['total_user'];

    $commentHTML .= '<div class="media is-comment main-comment comment-rating" style="padding: 16px;"> 

            <div class="media-content" style="display: flex;justify-content: flex-start;align-items: center;gap: 10px;">';  

                //$commentHTML .='<a href="">'.$comment["fname"].' '.$comment["lname"].'</a>';

                if($comment["dummy_id"]==0){

                    $commentHTML .='<a href="main_user_profile.php?user_id='.$comment["u_id"].'">'.$comment["fname"].' '.$comment["lname"].'</a>

                    <span class="time">'.$comment['unique_name'].'</span>';

                }else{

                    $commentHTML .='
                    <a href="dummy_user_profile.php?user_id='.$comment["u_id"].'">
                        <div class="user-image">
                            <img src="'. $comment_photo .'" data-user-popover="1" alt="">
                        </div>
                    </a>
                    <a class="abcd" href="dummy_user_profile.php?user_id='.$comment["u_id"].'">
                        <div class="f1">
                            <span class="span-title d-flex-star">
                                <span style="font-size: .85rem;color: #393a4f;font-weight: 500;">'.$comment["fname"].'</span>
                                <span class="rating_star-m">
                                    <span class="star-textm">
                                         '. getProfileRating($conn,$comment['u_id']).'/5
                                        <label class="star-checked">★</label>
                                    </span>
                                </span>
                            </span>
                        </div>
                    ';

                    $sql1 = mysqli_query($conn, "SELECT anonymous_name from gt_anonymous_name where id in (" . $comment['anonymous'] . ")"); 
                        $commentHTML .='<div class="interest">';
                        while ($row1 = @mysqli_fetch_array($sql1)) {

                             $commentHTML .='<span class="time" style="margin: 5px 5px 0 0;display:inline-block;">'.$row1['anonymous_name'].'</span>';
                             
                            }
                    $commentHTML .='</div></div></a>';

                }

                

                $commentHTML .='<p style="padding: 10px 0;color: #757a91;font-size: .9rem;">'.$comment["comment"].'</p> 

                <div class="controls custom_c">';  

                    if ($comment['u_id']==$_SESSION['id'] || $comment['u_id']==$_SESSION['id']+1) {

                    $commentHTML .= '<div class="star-rating">'; 

                     }else{   

                        $commentHTML .= '<div class="star-rating cls_comment_rating" id="cls_comment_rating">';

                     }   

                    $commentHTML .= '<div class="like-count" style="margin: -16px 0px -12px 0px;">

                        <input class="cr_click" type="radio" name="rating" value="1" id="1-stars'.$comment["id"].'" data-rcommentid="'.$comment["id"].'" data-rcommentuid="'.$comment["user_id"].'" data-postid="'.$commentPostId.'">

                        <label for="1-stars'.$comment["id"].'" class="star">&#9733;</label>    

                        <input class="cr_click" type="radio" name="rating" value="2" id="2-stars'.$comment["id"].'" data-rcommentid="'.$comment["id"].'" data-rcommentuid="'.$comment["user_id"].'" data-postid="'.$commentPostId.'"> 

                        <label for="2-stars'.$comment["id"].'" class="star">&#9733;</label> 

                        <input class="cr_click" type="radio" name="rating" value="3" id="3-stars'.$comment["id"].'" data-rcommentid="'.$comment["id"].'" data-rcommentuid="'.$comment["user_id"].'" data-postid="'.$commentPostId.'">

                        <label for="3-stars'.$comment["id"].'" class="star">&#9733;</label> 

                        <input class="cr_click" type="radio" name="rating" value="4" id="4-stars'.$comment["id"].'" data-rcommentid="'.$comment["id"].'" data-rcommentuid="'.$comment["user_id"].'" data-postid="'.$commentPostId.'">

                        <label for="4-stars'.$comment["id"].'" class="star">&#9733;</label> 

                        <input class="cr_click" type="radio" name="rating" value="5" id="5-star'.$comment["id"].'" data-rcommentid="'.$comment["id"].'" data-rcommentuid="'.$comment["user_id"].'" data-postid="'.$commentPostId.'">

                        <label for="5-star'.$comment["id"].'" class="star">&#9733;</label>

                    </div>

                    </div>

                    <div>

                        <div class="like-count" style="font-size: small;margin: 0 2px -22px 10px;"> 

                            <div class="average_rating_show" style="display: none;"></div>

                            <h3 class="average_rating_hide"> '.$av_rating.'/5 </h3>

                        </div>

                        

                        <div class="reply post_comment" id="'.$comment["id"].'" data-userid="'.$comment["user_id"].'" style="margin: 0 0 0 48px;"> 

                            <a style="font-size: 14px;" href="#mainForm">Reply</a>

                        </div> 

                    </div>

                </div>';

    

                $commentHTML .= getCommentReply($conn, $comment["id"]);

    

            $commentHTML .='</div> 

        </div>'; 

                               

    }	

    $commentHTML .='</div>'; 

    echo $commentHTML;	 

      function getCommentReply($conn, $parentId = 0) { 

        global $commentPostId; 

        $commentHTML = '';  

        $commentQuery = "SELECT comt.id,comt.reply_id, comt.user_id, comt.comment, u.id as u_id, u.dummy_id, u.fname, u.lname, u.unique_name, u.photo, u.anonymous FROM comment as comt INNER JOIN gt_users as u ON u.id = comt.user_id WHERE reply_id = '".$parentId."' AND post_id='".$commentPostId."' ORDER BY id ASC"; 

        $commentsResult = mysqli_query($conn, $commentQuery); 

        $commentsCount = mysqli_num_rows($commentsResult);  

        

    



        if($commentsCount > 0) { 

        while($comment = mysqli_fetch_assoc($commentsResult)){

            $queryR = "SELECT c.*, COUNT(cr.rating_number) as rating_num, FORMAT((SUM(cr.rating_number) / COUNT(cr.rating_number)),1) as average_rating, COUNT(cr.user_id) as total_user FROM comment as c LEFT JOIN comment_rating as cr ON cr.comment_id = c.id WHERE c.id = '".$comment["id"]."' AND rating_number != 'undefined'  GROUP BY (cr.comment_id)"; 

            $resultR = $conn->query($queryR);  

            $postData = $resultR->fetch_assoc(); 

            

            $sql_photo = "SELECT * FROM users_photo WHERE user_id = '" . $comment["u_id"] . "' ORDER BY id DESC LIMIT 1"; 

            $query_retrived_photo = mysqli_query($conn, $sql_photo) or die("Error:" . mysqli_error($conn));

            $row_photo = mysqli_fetch_assoc($query_retrived_photo);

            $result_photo = mysqli_num_rows($query_retrived_photo); 

            if($result_photo > 0){

                $sub_comment_photo = $row_photo['photo'];   

            }else{

                $sub_comment_photo = './upload/user/male.jpeg';

            }

                if(!empty($postData['average_rating'])) { 

                    $av_rating = $postData['average_rating'];  

                } else { 

                    $av_rating = '0';  

                }  

        $tt_user = @$postData['total_user'];

        $commentHTML .= '<div class="media is-comment reply-comment comment-rating" style="padding: 16px;"> 

                <div class="media-content" style="display: flex;justify-content: flex-start;align-items: center;gap: 10px;">';  


                if($comment["dummy_id"]==0){

                    $commentHTML .='<a href="main_user_profile.php?user_id='.$comment["u_id"].'">'.$comment["fname"].' '.$comment["lname"].'</a>

                    <span class="time">'.$comment['unique_name'].'</span>';

                }else{

                    $commentHTML .='
                    <a href="dummy_user_profile.php?user_id='.$comment["u_id"].'">
                        <div class="user-image">
                            <img src="'. $sub_comment_photo .'" data-user-popover="1" alt="">
                        </div>
                    </a>
                    <a class="abcd" href="dummy_user_profile.php?user_id='.$comment["u_id"].'">
                        <div class="f1">
                            <span class="span-title d-flex-star">
                                <span style="font-size: .85rem;color: #393a4f;font-weight: 500;">'.$comment["fname"].'</span>
                                <span class="rating_star-m">
                                    <span class="star-textm">
                                        '. getProfileRating($conn,$comment['u_id']).'/5
                                        <label class="star-checked">★</label>
                                    </span>
                                </span>
                            </span>
                        </div>
                    ';

                    $sql1 = mysqli_query($conn, "SELECT anonymous_name from gt_anonymous_name where id in (" . $comment['anonymous'] . ")"); 
                        $commentHTML .='<div class="interest">';
                        while ($row1 = @mysqli_fetch_array($sql1)) {

                             $commentHTML .='<span class="time" style="margin: 5px 5px 0 0; display:inline-block;">'.$row1['anonymous_name'].'</span>';
                             
                            }
                    $commentHTML .='</div></div></a>';

                }

                

                $commentHTML .='<p style="padding: 10px 0;color: #757a91;font-size: .9rem;">'.$comment["comment"].'</p> 

                
                 

            <div class="controls custom_c">'; 

                    if ($comment['u_id']==$_SESSION['id'] || $comment['u_id']==$_SESSION['id']+1) {

                    $commentHTML .= '<div class="star-rating">'; 

                     }else{   

                        $commentHTML .= '<div class="star-rating cls_comment_rating" id="cls_comment_rating">';

                     } 

                 

                    $commentHTML .= '<div class="like-count"  style="margin: -16px 0px -12px 0px;">

                        <input class="cr_click" type="radio" name="rating" value="1" id="1-stars'.$comment["id"].'" data-rcommentid="'.$comment["id"].'" data-rcommentuid="'.$comment["user_id"].'" data-postid="'.$commentPostId.'">

                        <label for="1-stars'.$comment["id"].'" class="star">&#9733;</label>    

                        <input class="cr_click" type="radio" name="rating" value="2" id="2-stars'.$comment["id"].'" data-rcommentid="'.$comment["id"].'" data-rcommentuid="'.$comment["user_id"].'" data-postid="'.$commentPostId.'"> 

                        <label for="2-stars'.$comment["id"].'" class="star">&#9733;</label> 

                        <input class="cr_click" type="radio" name="rating" value="3" id="3-stars'.$comment["id"].'" data-rcommentid="'.$comment["id"].'" data-rcommentuid="'.$comment["user_id"].'" data-postid="'.$commentPostId.'">

                        <label for="3-stars'.$comment["id"].'" class="star">&#9733;</label> 

                        <input class="cr_click" type="radio" name="rating" value="4" id="4-stars'.$comment["id"].'" data-rcommentid="'.$comment["id"].'" data-rcommentuid="'.$comment["user_id"].'" data-postid="'.$commentPostId.'">

                        <label for="4-stars'.$comment["id"].'" class="star">&#9733;</label> 

                        <input class="cr_click" type="radio" name="rating" value="5" id="5-star'.$comment["id"].'" data-rcommentid="'.$comment["id"].'" data-rcommentuid="'.$comment["user_id"].'" data-postid="'.$commentPostId.'">

                        <label for="5-star'.$comment["id"].'" class="star">&#9733;</label>

                </div>

                </div>

                <div>

                    <div class="like-count" style="font-size: small;margin: 0 2px -22px 20px;"> 

                         <div class="average_rating_show" style="display: none;"></div>

                        <h3 class="average_rating_hide"> '.$av_rating.'/5 </h3> 

                    </div>

                

                <div class="reply post_comment" id="'.$comment["id"].'" data-userid="'.$comment["user_id"].'" style="margin: 0 0 0 58px;"> 

                    <a style="font-size: 14px;" href="#mainForm">Reply</a>

                </div> 

                </div>

            </div>

        </div> 

    </div>'; 

    $commentHTML .= getCommentReply($conn, $comment["id"]);  

    }

    }

    

    return $commentHTML;	

    

  }

?>