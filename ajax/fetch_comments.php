<?php 
include_once('../config.php');   
$cpId = @$_POST['cpId'];
$cuId = @$_POST['cuId']; 
$commentQuery = "SELECT id, user_id, comment, created_at FROM comment WHERE reply_id = '0' AND post_id = '".$cpId."' AND  user_id = '".$cuId."' ORDER BY id DESC"; 
//echo $commentQuery;
$commentsResult = mysqli_query($conn, $commentQuery) or die("database error:". mysqli_error($conn));
$commentHTML = '';
//$commentHTML .= '<div class="showcomment" style="display:none;">';
while($comment = mysqli_fetch_assoc($commentsResult)){
    $commentHTML .= '
   
            <div class="grid md:grid-cols-1 divide divide-gray-200 gap-x-6 gap-y-4" id="follow_id"> 
              <div class="flex items-center space-x-4">
        
                <div class="w-10 h-10 rounded-full relative flex-shrink-0"> 
                    <img src="assets/images/avatars/avatar-1.jpg" alt="" class="absolute h-full rounded-full w-full"> 
                </div> 

                <div class="text-gray-700 py-2 px-3 rounded-md bg-gray-100 relative lg:ml-5 ml-2 lg:mr-12  dark:bg-gray-800 dark:text-gray-100"> 
                    <p class="leading-6">'.$comment["comment"].' </p> 
                    <div class="absolute w-3 h-3 top-3 -left-1 bg-gray-100 transform rotate-45 dark:bg-gray-800"></div> 
                </div> 
                <div class="text-sm flex items-center space-x-3 mt-2 ml-5"> 
                                                 <button type="button" class="btn btn-primary reply" id="'.$comment["id"].'">Reply</button>
                <div class="text-sm flex items-center space-x-3 mt-2 ml-5"> 

                </div>  
            </div> 
        </div>'; 
        $commentHTML .= getCommentReply($conn, $comment["id"]);
}
//$commentHTML .= '</div>';
echo $commentHTML; 
function getCommentReply($conn, $parentId = 0, $marginLeft = 0) {
    $commentHTML = '';
    $commentQuery = "SELECT id, user_id, comment, created_at FROM comment WHERE reply_id = '".$parentId."'";   
    $commentsResult = mysqli_query($conn, $commentQuery);
    $commentsCount = mysqli_num_rows($commentsResult);
    if($parentId == 0) {
        $marginLeft = 0;
    } else {
        $marginLeft = $marginLeft + 48;
    }
    if($commentsCount > 0) {
        while($comment = mysqli_fetch_assoc($commentsResult)){  
            $commentHTML .= '
                <div class="border-t py-4 space-y-4 dark:border-gray-600" style="margin-left:'.$marginLeft.'px"> 
                    <div class="flex"> 
                        <div class="w-10 h-10 rounded-full relative flex-shrink-0"> 
                            <img src="assets/images/avatars/avatar-1.jpg" alt="" class="absolute h-full rounded-full w-full"> 
                        </div>  
                        <div class="text-gray-700 py-2 px-3 rounded-md bg-gray-100 relative lg:ml-5 ml-2 lg:mr-12  dark:bg-gray-800 dark:text-gray-100"> 
                            <p class="leading-6">'.$comment["comment"].' </p> 
                            <div class="absolute w-3 h-3 top-3 -left-1 bg-gray-100 transform rotate-45 dark:bg-gray-800"></div> 
                        </div> 
                        <div class="text-sm flex items-center space-x-3 mt-2 ml-5"> 
                                                         <button type="button" class="btn btn-primary reply" id="'.$comment["id"].'">Reply</button>
                        <div class="text-sm flex items-center space-x-3 mt-2 ml-5"> 

                        </div>  
                    </div> 
                </div>';
            $commentHTML .= getCommentReply($conn, $comment["id"], $marginLeft);
        }
    }
    return $commentHTML;
}