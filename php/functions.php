<?php
	#redirects a user to a new location.
        function redirect($newLocation) {
                header("Location: " . $newLocation);
        }
	
	#Sign in and sign up function.
	function user_information($user_in, $pass_in) {
		#Connecting to the Forum_app database.
	        $connection = mysqli_connect("localhost", "forum", "HarvardFan46", "forum_app");        
        	if (mysqli_connect_errno()) {
                	die("Database connection failed: " . mysqli_connect_error() .
                	" (" . mysqli_connect_errno() . ")" );
        	}

		#Adding an output variable for screen output.
		$output = "";	
        
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
                                	$match ++;
                        	}
                	}
        
                	#If statement looks at different match values.
                	if ($match == 1) {
                        	$_SESSION['username'] = $user_in;
				redirect("signedIn.php");
                	} else {
                        	$output .= "Try again!";
                	}

        	}

        	#Checking for signUp $_POST data. Query string still has the needed information, no need to reset. 
        	if (isset($_POST['signUp'])){
                	#While loop cycles through whole list looking for a match.
               		$match = 0;
                	while($row = mysqli_fetch_array($result)) {
                        	$username = $row['username'];
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
				$_SESSION['username'] = $user_in;
                        	redirect("signedUp.php");

                	} else {
                        	#Unique ID error
                        	$output .= "You must choose a unique Username.";
                	}
		}
		mysqli_close($connection); 	
		return $output;
	}
?>
