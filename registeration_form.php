<?php
	if (!isset($fname) || !isset($lname) || !isset($email) || !isset($website)){
		$fname = $lname = $email = $website = $username = $gender = " ";
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>My Registeration Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="form_container">
		<div class="sub_container">
			<form class="form" action="<?php echo htmlspecialchars("registeration_validation_status.php");?>" method="post" target="_blank">
				<div class="first_name">
					<label for="fname">First Name:</label>
					<input type="text" name="fname" placeholder="First Name" value="<?php echo $fname; ?>">
					<p class= "error"><?php if (isset($fnameErr)) {echo $fnameErr;} ?></p>
				</div>
				<div class="last_name">
					<label for="lname">Last Name:</label>
					<input type="text" name="lname" placeholder="Last Name" value="<?php echo $lname; ?>">
					<p class= "error"><?php if (isset($lnameErr)) {echo $lnameErr;} ?></p>
				</div>
				<div class="email">
					<label for="email">Email:</label>
					<input type="email" name="email" placeholder="Email" value="<?php echo $email; ?>">
					<p class= "error"><?php if (isset($emailErr)) {echo $emailErr;} ?></p>
				</div>
				<div class="website">
					<label for="website">Website:</label>
					<input type="text" name="website" placeholder="Website" value="<?php echo $website; ?>">
					<p class= "error"><?php if (isset($websiteErr)) {echo $websiteErr;} ?></p>
				</div>
				<div class="username">
					<label for="username">Username:</label>
					<input type="text" name="username" placeholder="Username" value="<?php echo $username; ?>">
					<p class= "error"><?php if (isset($usernameErr)) {echo $usernameErr;} ?></p>
				</div>
				<div class="password">
					<label for="password">Password:</label>
					<input type="password" name="password" placeholder="Password">
					<p class= "error"><?php if (isset($passwordErr)) {echo $passwordErr;} ?></p>
				</div>
				<div class="password">
					<label for="cpassword">Confirm Password:</label>
					<input type="password" name="cpassword" placeholder="Confirm Password">
					<p class= "error"><?php if (isset($cpasswordErr)) {echo $cpasswordErr;} ?></p>
				</div>
				<div class="gender">
					<label for="male">Male</label>
					<input type="radio" name="gender" value="Male">
					<label for="female">Female</label>
					<input type="radio" name="gender" value="Female">
					<p class= "error"><?php if (isset($genderErr)) {echo $genderErr;} ?></p>
				</div>
				<div class="submit_button">
					<input type="submit" value="Register">
				</div>
			</form>
		</div>
	</div>
</body>
</html>