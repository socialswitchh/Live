<?php  
ob_start();   
session_start();  
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('config.php'); 
/* Start Google Login Script */
include('fb_init.php'); 
include('google_config.php'); 
$login_button = ''; 
if(isset($_GET["code"]))
{ 
  $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]); 
  if(!isset($token['error']))
    { 
      $google_client->setAccessToken($token['access_token']); 
      $_SESSION['access_token'] = $token['access_token']; 
      $google_service = new Google_Service_Oauth2($google_client); 
      $data = $google_service->userinfo->get(); 
        if(!empty($data['given_name']))
        {
          $_SESSION['user_first_name'] = $data['given_name'];
        } 
        if(!empty($data['family_name']))
        {
          $_SESSION['user_last_name'] = $data['family_name'];
        } 
        if(!empty($data['email']))
        {
          $_SESSION['user_email_address'] = $data['email'];
        } 
        if(!empty($data['gender']))
        {
          $_SESSION['user_gender'] = $data['gender'];
        } 
        if(!empty($data['picture']))
        {
          $_SESSION['user_image'] = $data['picture'];
        }
    }
} 
if(!isset($_SESSION['access_token']))
{ 
    $login_button = '<a href="'.$google_client->createAuthUrl().'"><i class="fa fa-google"></i></a>';
}
/* End Google Login Script */
  /*if(!empty($_SESSION['is_login'])){ 
      header("Location: https://switchh.in/"); 
      die(); 
  }*/
 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title> Switchh </title>
    <link rel="icon" type="image/png" href="assets/img/logo/light original logo 1.png" />

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
    
     
     
    <div class="view-wrapper">
        <!-- Main Wrapper -->
        <div class="login-wrapper columns is-gapless">
            <!--Left Side (Desktop Only)-->
            <div class="column is-6 is-hidden-mobile hero-banner">
                <div class="hero is-fullheight is-login">
                    <div class="hero-body">
                        <div class="container">
                            <div class="left-caption">
                                <h2>Interact and connect with top rated people sharing same interest.</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Right Side-->
            <div class="column is-6">
                <div class="hero form-hero is-fullheight">
                    <!--Logo-->
                    <div class="logo-wrap">
                        <div class="wrap-inner">
                            <img src="assets/img/logo/light original logo 1.png" alt="">
                        </div>
                    </div>

                    <div class="main-img">
                        <img src="assets/img/logo/full name final logo 1.png" alt="" width="350">
                    </div>
                    <!--Login Form-->
                    <div class="hero-body">
                        <div class="form-wrapper">



                            <!--Avatar-->
                            <!-- <div class="avatar">
                                    <div class="badge">
                                        <i data-feather="check"></i>
                                    </div>
                                    <img src="https://placehold.it/128x128" data-demo-src="assets/img/avatars/jenna.png" alt="">
                                </div> -->
                            <!--Form-->


                           

                         
                            <div class="login-form">
                                <form method="post" action="ajax/login.php" name="login">
                                <div class="field">
                                    <div class="control">
                                        <input class="input email-input" type="text" name="email" id="log_email" placeholder="jennadavis@gmail.com">
                                        <div class="input-icon">
                                            <i data-feather="user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control">
                                        <input class="input password-input" type="password"  name="password" id="password" placeholder="●●●●●●●">
                                        <div class="input-icon">
                                            <i data-feather="lock"></i>
                                        </div>
                                    </div>
                                </div>


                                <div class="field" style="margin: 10px 0;">
                                    <div class="control">
                                        <button type="submit" class="button is-solid primary-button raised is-rounded is-fullwidth"  id="signup">Login</button> 
                                    </div>
                                </div>
                            </form> 
                            
                                <div class="field">
                                    <div class="control">
                                       <a href="signup.php"><button class="js-modal-trigger button is-solid primary-button raised is-rounded is-fullwidth">Sign Up with phone</button></a>
                                    </div>
                                </div>
                            </div>
                             
                        




                            <div class="section forgot-password">
                                <div class="has-text-centered">
                                    <a href="#">Forgot password?</a>
                                </div>
                            </div>

                            <div class="social-container">
                                <div class="has-text-centered" style="margin-top: 2vh; color: #5596e6">
                                    <p>Or login with social</p>
                                </div>
                                <ul class="social-icons">

                                    <?php if(isset($_SESSION['fb_access_token'])){
                                          header("Location:facebook_login.php");
                                         } else { ?>
                                        <li>
                                            <a href="<?php echo $login_url; ?>"><i class="fa fa-facebook"></i></a>
                                        </li>
                                      <?php } ?>  
                                    <li>
                                        <?php if($login_button == '') {  
                                            header("Location:google_login.php");
                                           } else  {   echo $login_button ; } 
                                        ?> 
                                    </li> 
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                </ul>
                            </div>


                            <!-- -----------------------modal popup ---------------------------------->

                            <div id="modal-js-example" class="modal">
                                <div class="modal-background"></div>
                                <div class="modal-content">
                                    <div class="box">

                                        <h1 class="has-text-centered is-size-3">Signup</h1>
                                        <h1 class="has-text-centered mb-2">Join now i'ts free</h1>


                                        <div class="login-form">
                                            <form method="post" action="signup.php" name="registration">
                                                <div class="field">
                                                    <div class="control">
                                                        <input class="input email-input" type="text" name="firstname" placeholder="First Name">
                                                        <div class="input-icon">
                                                            <i data-feather="user"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="field">
                                                    <div class="control">
                                                        <input class="input email-input" type="text" name="lastname" placeholder="Last Name">
                                                        <div class="input-icon">
                                                            <i data-feather="user"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="field">
                                                    <div class="control">
                                                        <input class="input mobile-input" type="text" name="mobile" id="mobile" placeholder="Mobile">
                                                        <div class="input-icon">
                                                            <i data-feather="user"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="field">
                                                    <div class="control">
                                                        <input class="input email-input" type="text" name="email"  id="reg_email" placeholder="jennadavis@gmail.com">
                                                        <div class="input-icon">
                                                            <i data-feather="user"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="field">
                                                    <div class="control">
                                                        <input class="input password-input" type="password" name="password" placeholder="●●●●●●●">
                                                        <div class="input-icon">
                                                            <i data-feather="lock"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                <p class="my-5 is-size-7">By Clicking Sign up, You AgreeTerms, Data PolicyAndCookies PolicyYou May Receive SMS Notification From Us And OTP Out At Any Time</p>

                                                <div class="field">
                                                    <div class="control">
                                                        <button type="submit" class="button is-solid primary-button raised is-rounded is-fullwidth registration" id="signup">Signup</button>

                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>

                                <button class="modal-close is-large" aria-label="close"></button>
                            </div>

                            <!-- <button class="js-modal-trigger" data-target="modal-js-example">
                                Open JS example modal
                              </button> -->

                            <!-- -----------------------modal popup ---------------------------------->



                        </div>
                    </div>
                </div>
            </div>


            <style>
                @import url(https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css);

                .logo-wrap {
                    transform: rotate(0deg) !important;
                }

                .main-img {
                    display: flex;
                    justify-content: center;
                    margin-top: 100px;
                }

                .social-container {
                    /* width: 400px; */
                    /* margin: 40vh auto; */
                    text-align: center;
                }

                .social-icons {
                    padding: 0;
                    list-style: none;
                    margin: 1em;
                }

                .social-icons li {
                    display: inline-block;
                    margin: 0.15em;
                    position: relative;
                    font-size: 1.2em;
                }

                .social-icons i {
                    color: #fff;
                    position: absolute;
                    top: 21px;
                    left: 21px;
                    transition: all 265ms ease-out;
                }

                .social-icons a {
                    display: inline-block;
                }

                .social-icons a:before {
                    transform: scale(1);
                    -ms-transform: scale(1);
                    -webkit-transform: scale(1);
                    content: " ";
                    width: 60px;
                    height: 60px;
                    border-radius: 100%;
                    display: block;
                    background: linear-gradient(45deg, #00b5f5, #002a8f);
                    transition: all 265ms ease-out;
                }

                .social-icons a:hover:before {
                    transform: scale(0);
                    transition: all 265ms ease-in;
                }

                .social-icons a:hover i {
                    transform: scale(2.2);
                    -ms-transform: scale(2.2);
                    -webkit-transform: scale(2.2);
                    color: #00b5f5;
                    background: -webkit-linear-gradient(45deg, #00b5f5, #002a8f);
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;
                    transition: all 265ms ease-in;
                }
            </style>

            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    // Functions to open and close a modal
                    function openModal($el) {
                        $el.classList.add('is-active');
                    }

                    function closeModal($el) {
                        $el.classList.remove('is-active');
                    }

                    function closeAllModals() {
                        (document.querySelectorAll('.modal') || []).forEach(($modal) => {
                            closeModal($modal);
                        });
                    }

                    // Add a click event on buttons to open a specific modal
                    (document.querySelectorAll('.js-modal-trigger') || []).forEach(($trigger) => {
                        const modal = $trigger.dataset.target;
                        const $target = document.getElementById(modal);

                        $trigger.addEventListener('click', () => {
                            openModal($target);
                        });
                    });

                    // Add a click event on various child elements to close the parent modal
                    (document.querySelectorAll('.modal-background, .modal-close, .modal-card-head .delete, .modal-card-foot .button') || []).forEach(($close) => {
                        const $target = $close.closest('.modal');

                        $close.addEventListener('click', () => {
                            closeModal($target);
                        });
                    });

                    // Add a keyboard event to close all modals
                    document.addEventListener('keydown', (event) => {
                        const e = event || window.event;

                        if (e.keyCode === 27) { // Escape key
                            closeAllModals();
                        }
                    });
                });
                $(document).ready(function() { 

                    $(function() {
                        $("form[name='registration']").validate({

                            rules: {
                                firstname: "required",
                                lastname: "required",
                                mobile: {
                                    required: true,
                                    remote: {
                                        url: "ajax/duplicate_mobile.php",
                                        type: "post",
                                        data: {
                                            mobile: function() {
                                                return $("#mobile").val();
                                            }
                                        }
                                    }
                                },
                                email: {
                                    required: true,
                                    remote: {
                                        url: "ajax/duplicate_email.php",
                                        type: "post",
                                        data: {
                                            email: function() {
                                                return $("#reg_email").val();
                                            }
                                        }
                                    }
                                },
                                password: "required",
                            },
                            // Specify validation error messages 
                            messages: {
                                firstname: "Please enter your firstname",
                                lastname: "Please enter your lastname",
                                nick_name: "Please select nick name",
                                mobile: {
                                    required: "Please enter your mobile number.",
                                    remote: "Mobile number alredy exist"
                                },
                                email: {
                                    required: "Please enter a valid email address",
                                    remote: "Email id alredy exist"
                                },
                                password: "Please enter your password",

                            },
                            submitHandler: function(form) {

                                $.ajax({
                                    url: form.action,
                                    type: form.method,
                                    data: $(form).serialize(),
                                    success: function(response) {
                                        $("#savemsg").html(response);
                                        window.setTimeout(function() {
                                            location.assign("badges.php")
                                        }, 4000);
                                    }
                                });
                            }
                        });


                    });
                    //login 
    $(function() { 
      $("form[name='login']").validate({  
        rules: {   
          email: { 
            required: true,  
            email: true, 
            remote: { 
              url:"ajax/check_email_exist.php", 
              type: "post",  
              data: { 
                email: function() { 
                return $( "#log_email" ).val(); 
                } 
              } 
            } 
          }, 
          password: "required",  
        },  
        messages: {  
          email: { 
            required: "Please enter a valid email address", 
            remote: "Email id not exist"  
          }, 
          password: " Please enter your password",  
        },  
        submitHandler: function(form) { 
           // alert('hello');
            $.ajax({ 
                url: form.action, 
                type: form.method, 
                data: $(form).serialize(), 
                success: function(response) {  
                  //$("#login_otp_message_popup").modal("show");  
                   window.setTimeout(function(){location.assign("feed.php")}, 2000); 
                } 
            }); 
        }  
      }); 
    });
                });
            </script>
        </div>

        
        
        <!-- Concatenated js plugins and jQuery -->
        <script src="assets/js/app.js"></script>
        <script src="assets/js/jquery.validate.js"></script>
        <!-- <script src="https://js.stripe.com/v3/"></script> -->
        <script src="assets/data/tipuedrop_content.js"></script>

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