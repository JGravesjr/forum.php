<?php 
	session_start(); 
	#Connecting to the Forum_app database.
        $connection = mysqli_connect("localhost", "forum", "HarvardFan46", "forum_app");
        if (mysqli_connect_errno()) {
        	die("Database connection failed: " . mysqli_connect_error() .
                " (" . mysqli_connect_errno() . ")" );
        	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN""http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">
	<head>
		<title>Welcome!</title>
	</head>
	<body>
		<p> Welcome to your account page, it's a little bare right now, come back later!</p>
		<?php 
		$username = $_SESSION['username'];
		echo "Welcome {$username}!"; 
		?>
	</body>
</html>

