<?php
session_start();
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
			<form class="form" action="<?php echo htmlspecialchars("index.php");?>" method="post" target="_blank">
			<div class="paragraph">
				<p>Your registeration is complete! <br>
					Proceed to login <br>
					<input type="submit" value="Proceed"></p>
			</div>	
			</form>
		</div>
	</div>
</body>
</html>