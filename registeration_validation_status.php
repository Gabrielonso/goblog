<?php

/*...start data/input validation...*/

#if datas are submitted using 'post' method,
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

#assign variables to each validated data
$fname = test_input($_POST['fname']);
$lname = test_input($_POST['lname']);
$email = test_input($_POST['email']);
$website = test_input($_POST['website']);
$username = test_input($_POST['username']);
$password = test_input($_POST['password']);


if (empty($_POST['gender'])) {
	#set error message if a gender is not selected, 
	$genderErr = "*required field";
}
else {$gender = test_input($_POST['gender']);
}	


if (empty($fname) ){
	#set this error message if $fname field is empty, 
	$fnameErr = "*required field";
}
elseif (!preg_match("/^[a-zA-Z-' ]*$/",$fname) ){
	#set this error message if $fname field does not contain ONLY letters and white spaces
	$fnameErr = "*Only letters and white space allowed";
}
else { $fname = test_input($_POST['fname']); }


if (empty($lname)) {
	#set this error message IF $lname field is empty 
	$lnameErr = "*required field";
}
elseif (!preg_match("/^[a-zA-Z-' ]*$/",$lname)) {
	#set this error message if $lname field does not contain ONLY letters and white spaces
	$lnameErr = "*Only letters and white space allowed";
}
else {$lname = test_input($_POST['lname']);}


if (empty($email)) {
	#set this error message IF the $email field is empty
	$emailErr =
		"*required field";
}
elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	#set this error message IF $email entered does not have a valid email format 
	$emailErr = "*Invalid email format";
}
else {$email = test_input($_POST['email']);}


if (empty($website)) {
	#set this error message IF the $website field is empty
	$websiteErr =
		"*required field";
}
elseif (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
	#set this error message IF the $website entered does not match a valid URL format
	$websiteErr = "*Invalid URL";
}
else {$website = test_input($_POST['website']);}


if (empty($username)) {
	#set this error message IF the $username field is empty
	$usernameErr = "*choose a username";
}
else {$username = test_input($_POST['username']);}


if (empty($password)) {
	#set this error message IF the $password field is empty
	$passwordErr = "*choose a password";
}
elseif (!preg_match("/([a-zA-Z]+[0-9]|[0-9]+[A-Za-z])[A-Za-z0-9]*/",$password)) {
	#set this error message if $password entered does not contain alphanumeric characters
	$passwordErr = "*must contain alphanumeric characters";
}
elseif (strlen($password) < 6) {
	#set this error message if $password entered is less than 6 characters
	$passwordErr = "*password should not be less than 6 characters";
}
else {$password = test_input($_POST['password']);}


$cpassword = test_input($_POST['cpassword']);
if($cpassword !== $password) {
	#set this error message if the confirm password is not exactly equal to the $password set
	$cpasswordErr = "*Your passwords does not match";
}
else { $cpassword = test_input($_POST['cpassword']);}


if (empty($gender)) {
	#set this error message IF a gender is not chosen
	$genderErr = "*Male or Female"."</i></p>";
}
else {$gender = test_input($_POST['gender']);
}


#open and connect to database
require_once 'db.class.php';
DB::$user = 'root'; //the user name is root
DB::$password = ''; //for xampp leave an empty quote''
DB::$dbName  = 'users';

#assign variable to request, from database table, the row with $username record
$requestDB = DB::queryFirstRow("SELECT * FROM userinfo where username = %s", $username);

#check if the $username already exist in the username field of the DB table
if ($username == $requestDB['username'] ){
	#set this error message
	$usernameErr = "*username already exist";
}

#if any error message is set,
if (isset($fnameErr) || isset($lnameErr) || isset($emailErr) || isset($websiteErr) || isset($usernameErr) || isset($passwordErr) || isset($cpasswordErr) || isset($genderErr)){
	include('registeration_form.php');
}
else {
/*...connect to database, and insert all inputs/data values...*/
require_once 'db.class.php';
DB::$user = 'root'; //the user name is root
DB::$password = ''; //for xampp leave an empty quote''
DB::$dbName  = 'users';

#encrypt the confirmed password
$hash = password_hash($cpassword, PASSWORD_DEFAULT);

#insert data into userinfo table
$insertdata = DB::insert('userinfo', [
	'fname' => $fname,
	'lname' => $lname,
	'email' => $email,
	'website' => $website,
	'username' => $username,
	'password' => $hash,
	'gender' => $gender]);}

#if all data is inserted sucessfully,
if (isset($insertdata)) {
	include('registeration_success.php');
}
}
else {echo "STOP!!!";}
 
?>