<?php 
	#Requiring functions.php
	require_once('../php/functions.php');

	#Accessing session data.
	session_start();
	
	#Adding user_in and pass_in into variables.
	$userIn = $_POST['userIn'];
	$passIn = $_POST['passIn'];

	#Sign in function.
	echo user_information($userIn, $passIn);	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN""http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
	<head>
		<title>Sign In</title>
	</head>
	<body>
		<form action:"signIn.php" method="post">
			<input type="text" class="input-large" name="userIn" placeholder="Username" value="" /></input><br>
			<input type="password" class="input-large" name="passIn" placeholder="Password" value="" /></input><br>
			<!-- Adding different $_POST values for sign up and sign in. -->
			<input type="submit"  name="signUp" value="Sign Up" /></input>
			<input type="submit" name="signIn" value="Sign In" /></input>
		</form>	
	</body>
</html>
