<?php 
	 
	require 'vendor/autoload.php';
	$fb = new Facebook\Facebook([
		'app_id' => '921426972558656',
		'app_secret' => 'eeee6f2ab106be0f1de6cf78d0f1a80b',
		'default_graph_version'=> 'v8.0'
	]);

	$helper = $fb->getRedirectLoginHelper();
	$permissions = ['email']; // optional
	 
	$login_url = $helper->getLoginUrl("https://switchh.in", $permissions);

	try {
		$accessToken = $helper->getAccessToken();
		if (isset($accessToken)) {
			$_SESSION['fb_access_token'] = (string)$accessToken;
			header("Location:index.php");
		}
	} catch (Exception $e) {
		echo $e->getTraceAsString();
	}

	if (isset($_SESSION['fb_access_token'])) {
		try {
			$fb->setDefaultAccessToken($_SESSION['fb_access_token']);
			$res = $fb->get('/me?fields=id,name,email,first_name,last_name,picture');
			 
			$user= $res->getGraphuser();
			  $fbUserData = array();
                $fbUserData['oauth_uid']  = !empty($user['id'])?$user['id']:'';
                $fbUserData['first_name'] = !empty($user['first_name'])?$user['first_name']:'';
                $fbUserData['last_name']  = !empty($user['last_name'])?$user['last_name']:'';
                $fbUserData['email']      = !empty($user['email'])?$user['email']:'';
                $fbUserData['gender']     = !empty($user['gender'])?$user['gender']:'';
                $fbUserData['picture']    = !empty($user['picture']['url'])?$user['picture']['url']:'';
                $fbUserData['link']       = !empty($user['link'])?$user['link']:'';
                $_SESSION['userData'] = $fbUserData;
		} catch (Exception $e) {
			echo $e->getTraceAsString();
		}
	}
	// Getting user's profile data
   /* $fbUserData = array();
    $fbUserData['oauth_uid']  = !empty($user['id'])?$user['id']:'';
    $fbUserData['first_name'] = !empty($user['first_name'])?$user['first_name']:'';
    $fbUserData['last_name']  = !empty($user['last_name'])?$user['last_name']:'';
    $fbUserData['email']      = !empty($user['email'])?$user['email']:'';
    $fbUserData['gender']     = !empty($user['gender'])?$user['gender']:'';
    $fbUserData['picture']    = !empty($user['picture']['url'])?$user['picture']['url']:'';
    $fbUserData['link']       = !empty($user['link'])?$user['link']:'';
    $_SESSION['userData'] = $fbUserData;
    print_r($_SESSION); */
 
?>