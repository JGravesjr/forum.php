<?php 
	#Starting session
	session_start(); 

	#Connecting to the Forum_app database.
        $connection = mysqli_connect("localhost", "forum", "HarvardFan46", "forum_app");
        if (mysqli_connect_errno()) {
        	die("Database connection failed: " . mysqli_connect_error() .
                " (" . mysqli_connect_errno() . ")" );
        	}

	#Adding session to a local variable.
	$username = $_SESSION['username'];

	#test
        $username = $_SESSION['username'];
        $query = "SELECT id FROM user_info WHERE username = $username ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($connection, $query);
	$value = mysqli_fetch_array($result);
	$valueId = $value['id'];
	echo get_resource_type($result);
	echo get_resource_type($value);
        echo ("You are id number {$valueId}"); 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN""http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">
	<head>
		<title>Welcome!</title>
	</head>
	<body>
		<p> Welcome to your account page <?php echo " {$username}"; ?>, it's a little bare right now so come back later!</p>
		
	</body>
</html>

