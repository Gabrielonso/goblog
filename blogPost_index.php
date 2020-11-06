<?php
	#starts session if none is started
if (session_start()!= 1){
	session_start();
}
	#opens a connection to db
require_once 'db.class.php';
DB::$user = 'root';
DB::$password = '';
DB::$dbName = 'users';

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="form_container">
		<div class="sub_container">
			<form class="form" action="<?php echo htmlspecialchars("post.php");?>" method="post" target="_blank">
			<textarea name="posts" id= "posts" placeholder="<?php if (isset($_SESSION['user'])){echo 'Hi '.$_SESSION['user'].', what\'s on your mind...';} ?>" ></textarea>
			</br>
			<input type="submit" name="submit" value="Send">
			</form>
		<a href="index.php">Log Out</a>
		</div>
	</div>
<?php

/*...this code executes as $users makes posts after start of login session...*/	
	#if the $user table variable exist
if (isset($_SESSION['table'])) {	
	#sort the table in descending order
rsort($_SESSION['table']);
foreach ($_SESSION['table'] as $userPost) {
	#echo each post in the table
echo '<p>'.$userPost['posts'].'<a href="delete.php"><button>Delete Post</button></a>'.'</p>';
}
}

/*...this code is executed ONLY when $users newly starts a login session...*/
else {
	#sets a variable for user
$user = $_SESSION['user'];

	/*table of $user is created ONLY IF it doesn't exist in db...*/
#set a session variable
$_SESSION['createTable'] = DB::query("CREATE TABLE IF NOT EXISTS $user(
		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		`posts` VARCHAR(255))
		ENGINE = InnoDB");

	/*...echos all posts of $user ONLY when $user newly start a login session...*/		
	#requests the $user table
$query = DB::query("SELECT * FROM $user");
	#sorts $user table in descending order
rsort($query);
foreach ($query as $userPost) {
	#echos each post of $user
echo '<p>'.$userPost['posts'].'<a href="delete.php"><button>Delete Post</button></a>'.'</p>';
}
}

?>
</body>
</html>