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
	
	#Reply to a thread
	if (isset(			
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN""http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
	<head>
		<title>Forum</title>
	</head>
	<body>
		<!-- Dev link for view page -->
		<a href="viewForum.php" >View Forum</a> 

		<!-- Display username top-right -->
		
		<!-- Check for nThread $_POST data. -->
		<!-- Form for forum input -->
                <form action="forum.php" method="post">        
			<input type="text" class="input-large" name="subIn" placeholder="Subject" value="" /></input><br>
                        <textarea name="forumIn" cols="60" rows="10" placeholder="Enter witty response here." value="" /></textarea><br>
                        <input type="submit"  name="nReply" value="Post" /></input>
		</form>
		<!-- Show thread, ordered by post id -->
			<!-- New thread button increments to threadPost -->
			<form action="forum.php" method="post">
				<input type="submit"  name="nThread" value="New Thread" /></input>
			</form>
			<form action="forum.php" method="post">
				<input type="text" name="nSubIn" placeholder="Subject" value="" /></input><br>
				<textarea name="nForumIn" cols="60" rows="10" placeholder="Enter your witty ideas here." value="" /></textarea><br>
				<input type="submit" name="nSub" value="Submit" /></input>
			</form>
			<!-- Replies create refNum, refnum will be the variable in php of threadPost_id in the database. 
			refNum will be taken from the first post. -->
			<!-- Create thread views based on refNum and forumPost_id. Call threadPost_author for the top right
			Thread Author view. -->
		<?php  
		
		?>	
	</body>
</html>
