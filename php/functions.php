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

        	#Checking for signIn $_POST data.
        	if (isset($_POST['signIn'])) {
		        #Validate sign in against forum_app.
                	$query = "SELECT username FROM user_info WHERE username = '$user_in' and password = '$pass_in' LIMIT 1;";
                	$result = mysqli_query($connection, $query);
			$row = mysqli_fetch_array($result);
			$username = $row[0];

                	#Kills the page if no result from database.
                	if (!$result) {
        	                die("Database query failed.");
	                }

                	#Check for match.
                	if ($user_in == $username) {
                        	$_SESSION['username'] = $username;
				redirect("signedIn.php");
                	} else {
                        	$output .= "Try again!";
                	}

        	}

        	#Checking for signUp $_POST data. Query string still has the needed information, no need to reset. 
        	if (isset($_POST['signUp'])){
                	#Validate sign in against forum_app.
                	$query = "SELECT username FROM user_info WHERE username = '$user_in' LIMIT 1;";
                	$result = mysqli_query($connection, $query);
			$row = mysqli_fetch_array($result);
			$username = $row[0];

                	#Kills the page if no result from database.
                	if (!$result) {
        	                die("Database query failed.");
	                }

                	#If statement looks at different match values.
                	if ($user_in != $username) {
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
	
	#New thread 
	function newThread($nSub) {
		#Check for submission $_POST data.
		if(isset($_POST['nSub'])) {
			#Sign into mysql.
		        $connection = mysqli_connect("localhost", "forum", "HarvardFan46", "forum_app");
        		if (mysqli_connect_errno()) {
                		die("Database connection failed: " . mysqli_connect_error() .
                		" (" . mysqli_connect_errno() . ")" );
                	}

                	#Increment threadId and add username data.
                	$query = "INSERT INTO threadPost (author)
                        	 VALUES ('{$_SESSION['username']}')";
                	$threadResult = mysqli_query($connection, $query);
                	if (!$threadResult) {
                       		die("Database query failed. " . mysqli_error($connection));
                	}

                	#Find out the id of the current post.
			#Get username from SESSION data.
			$username = $_SESSION['username'];
                	$query = "SELECT id FROM threadPost WHERE author = '$username' ORDER BY id DESC LIMIT 1";
                	$idResult = mysqli_query($connection, $query);
                	$idValueArray = mysqli_fetch_array($idResult);
                	$idValue = $idValueArray['id'];
                	if (!$idResult) {
                     		die("Database query failed. " . mysqli_error($connection));
                	}

                	#Add post to forumPost with the Thread_id field.
                	#Add nSubIn and nForumIn variables.
                	$nSubIn = mysqli_real_escape_string($connection, $_POST['nSubIn']);
                	$nForumIn = mysqli_real_escape_string($connection, $_POST['nForumIn']);
                	$query = "INSERT INTO forumPost (subforum, threadPost_id, subject, text)
                        	VALUES ('$subforum', '$idValue', '$nSubIn', '$nForumIn' )";
                	$forumResult = mysqli_query($connection, $query);
                	if (!$forumResult) {
                     		die("Database query failed. " . mysqli_error($connection));
                	} else {
				redirect("threadView.php?id=$idValue");	
			}


                }
		return $output;
	}

	#Reply 
#	function replyPost($ ) {
		
#	}
?>
