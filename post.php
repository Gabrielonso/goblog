<?php
session_start();
require_once 'db.class.php';
DB::$user = 'root';
DB::$password = '';
DB::$dbName = 'users';


	#set variable for the post and user
$posts = $_POST['posts'];
$user = $_SESSION['user'];

			/*...insert posts into a createdTable...*/
	#if a createTable variable is set
if (isset($_SESSION['createTable'])) {

 	#insert $posts into the $user table
  	$table = DB::insert($user, ['posts' => $posts]);

  	#set table variable for $user
 	$_SESSION['table'] = DB::query("SELECT * FROM $user");
 }

else {
	#query and set table variable only
	$_SESSION['table'] = DB::query("SELECT * FROM $user");
}

header('Location:http://localhost/registeration/blogPost_index.php')

?>