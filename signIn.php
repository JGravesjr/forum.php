<?php 
	#Connecting to the Forum_app database.
	$connection = mysqli_connect("localhost", "Forum", "HarvardFan46", "Forum_app");	
	if (mysqli_connect_errno()) {
                die("Database connection failed: " . mysqli_connect_error() .
                " (" . mysqli_connect_errno() . ")" );
        }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN""http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
	<head>
		<title>Sign In</title>
	</head>
	<body>
		<form action:"signIn.php" method="post">
			<input type="text" class="input-large" name="username" placeholder="Username" value="" /><br>
			<input type="text" class="input-large" name="password" placeholder="Password" value="" /><br>
			<!-- Adding different $_POST values for sign up and sign in. -->
			<input type="submit"  name="signUp" value="Sign Up" />
			<input type="submit" name="signIn" value="Sign In" />
		</form>	
	</body>
</html>
