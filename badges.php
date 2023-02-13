<?php 
session_start();
include_once('config.php'); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title> Friendkit | Sign Up</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="icon" type="image/png" href="assets/img/favicon.png" />
    
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-KQHJPZP');</script>
    <!-- End Google Tag Manager -->

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">
    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/css/core.css">
</head>

<body><script id="__bs_script__">//<![CDATA[
    document.write("<script async src='/browser-sync/browser-sync-client.js?v=2.27.10'><\/script>".replace("HOST", location.hostname));
//]]></script>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KQHJPZP"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <!-- Pageloader -->
    <div class="pageloader"></div>
    <div class="infraloader is-active"></div>
    <div class="signup-wrapper">
        
        <div class="fake-nav">
            <a href="/" class="logo">
                <img src="assets/img/logo/friendkit-bold.svg" width="112" height="28" alt="">
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
                
             
                
                
                
                <div id="signup-panel-3" class="process-panel-wrap is-active step2">
					<form method="post" action="ajax/save_badges.php" name="badges">
							<input type="hidden" name="user_id" class="user_id" value="<?php echo $_SESSION['id'];?>">
                    <div class="form-panel">
						
							<div class="photo-upload check-box-buttons" style="display:flex; justify-content: space-around; margin-bottom: 50px;"> 
								<?php  
									$query = mysqli_query($conn,"SELECT * FROM gt_badges"); 
									$i=0; 
									while ($row = $query->fetch_assoc()) {  
								?> 
								<div class="preview cat comedy" style="display: flex; flex-direction:column;"> 
									<label>
										<img style="z-index:1;" id="upload-preview" src="assets/img/logo/1.jpg"
										data-demo-src="assets/img/avatars/avatar-w.png" alt="">  
										
										<input type="checkbox" class="badges_checkbox" name="title" value="<?php echo $row['id'];?>"  aria-label="badges" aria-describedby="basic-addon1">
										<span class="avtar-label"><?php echo $row['title'];?></span> 
									</label>
								</div>  
								<?php  $i++; } ?>   
							</div> 
						
                    </div>
                
                    <div class="buttons">
                        <!-- <a class="button process-button" href="signup.php">Back</a> -->
                        <!--<a class="button process-button is-next" data-step="step-dot-4">Next</a>-->
						 
						<button type="submit" class="button  badges" data-step="step-dot-4" id="signup1">Next</button>
                    </div>
					</form>
                </div> 
        
                 
        
        
                
        </div>
        </div>
        
        
        
        <!--Edit Credit card Modal-->
        <div id="crop-modal" class="modal is-small crop-modal is-animated">
            <div class="modal-background"></div>
            <div class="modal-content">
                <div class="modal-card">
                    <header class="modal-card-head">
                        <h3>Crop your picture</h3>
                        <div class="close-wrap">
                            <button class="close-modal" aria-label="close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                    </header>
                    <div class="modal-card-body">
                        <div id="cropper-wrapper" class="cropper-wrapper"> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <style>
            .avtar-label{
             margin-bottom: -38px;
            }
            .avtar-s{
                 display: flex !important;
                  flex-direction: column !important;
                   
        
            }
            .suggestion-m{
                display: flex;
                width: 300px;
                padding: 5px !important;
                width: 350px;
            }
            .suggestion-m > img{
                width: 70px;
            }
			
			.comedy input:checked + span { 
				background-color: #ed7239!important; 
				color: #fff;
			}
			.comedy input:checked + span {
				background-color: #1BB8F7;
			}
			.cat label input + span {
				color: #ed7239;
				font-weight: 600;
			}
			.cat label span {
				text-align: center;
				padding: 3px 0;
				display: block;
			}
			.cat label {
				float: left;
				line-height: 3.0em;
				width: 8em;
				height: 45px;
			}
			.cat.comedy {
				background: #fff;
				border: 3px solid #ed7239;
				color: #ed7239!important;
				margin: 10px 10px;
			}
			.check-box-buttons {
				margin-left: -10px;
			}
        </style>
    </div>
	<script>
		$(document).ready(function() { 
			$('.anonymous_checkbox').change(function(){
				if($('.anonymous_checkbox:checked').length>=3){
					$('.anonymous_checkbox:not(:checked)').attr('disabled',true);
				}
				else{
					$('.anonymous_checkbox:not(:checked)').removeAttr('disabled');
				}
			});
			$('.badges_checkbox').change(function(){
				if($('.badges_checkbox:checked').length>=1){
					$('.badges_checkbox:not(:checked)').attr('disabled',true);
				}
				else{
					$('.badges_checkbox:not(:checked)').removeAttr('disabled');
				}
			}); 
 
					
					$(function() { 
						$("form[name='badges']").validate({ 
							  rules: { 
								title: "required", 
							}, 
							messages: { 
								title: "Choose badges", 
							},  
							submitHandler: function(form) { 
								$.ajax({ 
									url: form.action, 
									type: form.method, 
									data: $(form).serialize(), 
									success: function(response) { 
										$('.step2').hide();
										$('.step3').show();
										/* $("#savemsg").html(response);*/ 
										window.setTimeout(function() {
											location.assign("interest.php")
										}, 2000);  
									} 
								}); 
							} 
						}); 
					});
					
					$(".alloptions").on("click", ".anonymous_name", function(){ 
						var an_id = $(this).data("an_id");
						var mode = $(this).val(); 
						const rowTemp = `<tr data-mode=${mode} > <td><span><button type="button" class="close remove_anonymous anr_class" aria-label="Close">${an_id}<span aria-hidden="true">&times;</span></button></span> </td> </tr>`; 
						$('.db_value').hide(); 
						if($(this).is(":checked")) {
							$(".selected_data").append(rowTemp)
						}else{    
							$("[data-mode='"+ mode +"']").remove(); 
						}
					});
					 $(document).on('click', '.remove_anonymous', function(e) {
						$(this).closest('tr').children('td').hide();
						var len = $(this).closest('tr').children('td').length; 
						if(len==3){ 
							$('.anonymous_checkbox:not(:checked)').attr('disabled',true);
							$('.next_btn:not(:checked)').attr('disabled',false); 
						} 
						else{ 
							$('.anonymous_checkbox:not(:checked)').removeAttr('disabled');
							$('.next_btn:not(:checked)').attr('disabled',true); 
						} 
						/*if($(this).is(":checked")) {
							$('.anonymous_checkbox:not(:checked)').attr('disabled',true);
						}else{    
							$('.anonymous_checkbox:not(:checked)').removeAttr('disabled');
						}*/
					});
                });
	</script>
    <!-- Concatenated js plugins and jQuery -->
    <script src="assets/js/app.js"></script>
    <!-- <script src="https://js.stripe.com/v3/"></script> -->
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
    
    <!-- Landing page js -->
    
    <!-- Signup page js -->
    <script src="assets/js/signup.js"></script>
    
    <!-- Feed pages js -->
     
    <!-- profile js -->
    
    <!-- stories js -->
    
    <!-- friends js -->
    
    <!-- questions js -->
    
    <!-- video js -->
    
    <!-- events js -->
    
    <!-- news js -->
    
    <!-- shop js -->
    
    <!-- inbox js -->
    
    <!-- settings js -->
    
    <!-- map page js -->
    
    <!-- elements page js -->
</body>

</html>