<?php 
	#Require functions.php
	require_once("../php/functions.php");

	#Start session.
	session_start();

	#Assign $_SESSION data to a variable.
	$username = $_SESSION['username'];
	
	#Sign into mysql.
	$connection = mysqli_connect("localhost", "forum", "HarvardFan46", "forum_app");
        if (mysqli_connect_errno()) {
                die("Database connection failed: " . mysqli_connect_error() .
                " (" . mysqli_connect_errno() . ")" );
                }
			
	#Create new thread.
	$nSub = $_POST['nSub'];
	echo newThread($nSub);
?>	
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN""http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
	<head>
		<title>New Thread</title>
	</head>
	<body>
		<!-- Dev link for view page -->
		<a href="forum.php" >View Forum</a> 

		<!-- Display username top-right -->
		
			<!-- New thread button increments to threadPost -->
			<form action="newThread.php" method="post">
				<input type="text" name="nSubIn" placeholder="Subject" value="" /></input><br>
				<textarea name="nForumIn" cols="60" rows="10" placeholder="Enter your witty ideas here." value="" /></textarea><br>
				<input type="submit" name="nSub" value="Submit" /></input>
			</form>
	</body>
</html>
