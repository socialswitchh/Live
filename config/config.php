<?php 

/*******************************************************************************************/

/*                           DATABASE CONFIGURATION                                        */

/*******************************************************************************************/ 

/*	Database Server Name  */

$servername = "localhost"; 

/*	Database Username  */

$username = "wearhandloom_gat"; 

/*	Database Password */

$password = "idAozZCRFj"; 

/*	Database Name */

$dbname="wearhandloom_gat"; 

$conn = new mysqli($servername, $username, $password, $dbname); 

if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);

} 

date_default_timezone_set('Asia/Kolkata');