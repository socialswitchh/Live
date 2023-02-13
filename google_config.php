<?php  

require_once 'vendor/autoload.php'; 

$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('674073170140-47iqsh5si67d5fhfra67acppaa0f2ljo.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('https://switchh.in/index.php');

// to get the email and profile 
$google_client->addScope('email');

$google_client->addScope('profile');
?>


 