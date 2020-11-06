<?php
if (session_start() == 1) {
	#unsets and destroys started session
	session_unset();
	session_destroy();
}

if (!isset($username)) {
	#leaves field empty if a $username has not being enterd
$username = "";
}

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
			<form class="form" action="<?php echo htmlspecialchars("login_error.php");?>" method="post" target="_blank">
				<div class="username">
					<label for="username">Username:</label>
					<input type="text" name="username" placeholder="Username" value="<?php if(!isset($usernameErr)){echo $username;} ?>">
					<p class="error"><?php if (isset($usernameErr)) {echo $usernameErr;} ?></p>
				</div>
				<div class="password">
					<label for="cpassword">Password:</label>
					<input type="password" name="cpassword" placeholder="Password">
					<p class="error"><?php if (isset($cpasswordErr)) {echo $cpasswordErr;} ?></p>
				</div>
				<div class="submit_button">
					<input type="submit" value="Login"><br>
					<br>
				<p>Don't have an account yet?<br> <a href="registeration_form.php">Register</a></p>					
				</div>

			</form>
		</div>
	</div>
</body>
</html>