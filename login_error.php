<?php

	#opens and connects to database
require_once 'db.class.php';
DB::$user = 'root';
DB::$password = '';
DB::$dbName = 'users';

				/*...validate the login form...*/

#set variables for the username and password posted
$username = $_POST['username'];
$password = $_POST['cpassword'];

	#assigns a variable to request the row with $username record in the database
$requestDB = DB::queryFirstRow("SELECT * FROM userinfo WHERE username=%s", $username);

	#if $username does not match any record in the selected username field in db
if ($username != $requestDB['username']) {
	#sets the error message
	$usernameErr = "*username not found";	
}

	#verifies the $password match with password of selected $username record in db
if (password_verify($password, $requestDB['password']) != 1) {
	#sets error message if true
	$cpasswordErr = "*wrong password";
	}

	#if either of the error messages is set
if (isset($usernameErr) || isset($cpasswordErr)) {	
		include 'index.php';
	}
						/*...validation complete...*/

	#if no error messages is set
elseif ( !isset($usernameErr) && !isset($cpasswordErr)) {
	session_start();
	$_SESSION['user'] = $requestDB['username'];
	$_SESSION['password'] = $requestDB['password'];
	header('Location:http://localhost/goblog/blogPost_index.php');
}
?>
