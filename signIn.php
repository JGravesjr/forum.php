<?php 
	#Connecting to the Forum_app database.
	$connection = mysqli_connect("localhost", "forum", "HarvardFan46", "forum_app");	
	if (mysqli_connect_errno()) {
                die("Database connection failed: " . mysqli_connect_error() .
                " (" . mysqli_connect_errno() . ")" );
        }

	#Requiring functions.php
	require_once('functions.php');
	
	#Adding user_in and pass_in into variables, and adding the query before the if statements so I DRY.
	$user_in = $_POST['user_in'];
	$pass_in = $_POST['pass_in'];
		#Validate sign in against forum_app.
                $query = "SELECT * FROM user_info;";
                $result = mysqli_query($connection, $query);

                #Kills the page if no result from database.
                if (!$result) {
                        die("Database query failed.");
                }

	#Checking for signIn $_POST data.
	if (isset($_POST['signIn'])) {
		#While loop cycles through whole list looking for a match.
		$match = 0; 
                while($row = mysqli_fetch_array($result)) {
                        $username = $row['username'];
			$password = $row['password'];
                        if ($user_in === $username && $pass_in === $password) {
                                $match ++; echo "working?";
                        }
                }
	
		#If statement looks at different match values.
		if ($match == 1) {
			redirect("signedIn.php");
		} else {
			echo "Try again!";
		}	
	
	}

	#Checking for signUp $_POST data. Query string still has the needed information, no need to reset. 
	if (isset($_POST['signUp'])){
                #While loop cycles through whole list looking for a match.
                $match = 0;
                while($row = mysqli_fetch_array($result)) {
                        $username = $row['username'];
                        $password = $row['password'];
                        if ($user_in === $username) {
                                $match ++; 
                        }
                }

                #If statement looks at different match values.
                if ($match == 0) {
                        #Insert into user_info
			$query = "INSERT INTO user_info (username, password)
                                VALUES ('{$user_in}', '{$pass_in}')";
                        $result = mysqli_query($connection, $query);
                        if (!$result) {
                                die("Database query failed. " . mysqli_error($connection));
                        }
			redirect("signedUp.php");

                } else {
			#Unique ID error
                        echo "You must choose a unique Username.";
                }

	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN""http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
	<head>
		<title>Sign In</title>
	</head>
	<body>
		<form action:"signIn.php" method="post">
			<input type="text" class="input-large" name="user_in" placeholder="Username" value="" /><br>
			<input type="password" class="input-large" name="pass_in" placeholder="Password" value="" /><br>
			<!-- Adding different $_POST values for sign up and sign in. -->
			<input type="submit"  name="signUp" value="Sign Up" />
			<input type="submit" name="signIn" value="Sign In" />
		</form>	
	</body>
</html>
