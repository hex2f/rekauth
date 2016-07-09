<?php 
//Database Settings
$servername = 	"localhost";
$username = 	"user";
$password = 	"password";
$dbname = 		"appdb";

//App Settings
$appname = 'App';
$loginpage = 'http://www.notarealsite.com/login.html';
$isloggedinpage = 'http://www.notarealsite.com/loggedin.html';

//Register Error Strings
$password_notmatch_msg = 'password_notmatch';
$password_tooshort_msg = 'password_tooshort';
$mail_notmatch_msg = 'mail_notmatch';
$username_tooshort_msg = 'username_tooshort';
$username_toolong_msg = 'username_toolong';
$username_taken_msg = 'username_taken';

//Login Error Strings
$auth_failed_msg = 'auth_fail';

//Login and Register Settings
$password_encrypt_cost = 12;

$maxusernamelength = 32;
$minusernamelength = 5;
$minpasswordlength = 5;
?>