<?php 
/*******************************************************************************************/
/*                           DATABASE CONFIGURATION                                        */
/*******************************************************************************************/ 
/*	Database Server Name  */
$servername = "localhost"; 
/*	Database Username  */
$username = "switchh_user"; 
/*	Database Password */
$password = "dHWYPf8PY?g2"; 
/*	Database Name */
$dbname="switchh_live"; 
$conn = new mysqli($servername, $username, $password, $dbname); 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
date_default_timezone_set('Asia/Kolkata');