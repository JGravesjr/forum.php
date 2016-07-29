<?php 
	#Require functions.php
	require_once("../php/functions.php");

	#Start session.
	session_start();
	
	#Sign into mysql.
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN""http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">
	<head>
		<title>Forum</title>
	</head>
	<body>
		<!-- Display username top-right -->
		
		<!-- Check for nThread $_POST data. -->
		<?php
			if(isset($_POST("nThread")) {
				#Check for submission $_POST data.
				if(isset($_POST("nSub")) {
					#Increment threadId and add username data.
					$query = "INSERT INTO threadPost (author)
                                	        VALUES ('{$_SESSION['username']}')";
	                                $threadResult = mysqli_query($connection, $query);
        	                        if (!$threadResult) {
                	                        die("Database query failed. " . mysqli_error($connection));
                        	        }

					#Find out the id of the current post.
					$query = "SELECT LAST_INSERT_ID() FROM threadPost";
					$idResult = mysqli_query($connection, $query);
                                        if (!$idResult) {
                                                die("Database query failed. " . mysqli_error($connection));
                                        }

					#Add post to forumPost with Author and Thread_id fields.
					$query = "INSERT INTO forumPost ("

				}
			}
		?>
		<!-- Form for forum input -->
                <form action="forum.php" method="post">        
			<input type="text" class="input-large" name="subIn" placeholder="Subject" value="" /></input><br>
                        <textarea name="forumIn" cols="60" rows="10" placeholder="Enter witty response here." value="" /></textarea><br>
                        <input type="submit"  name="nPost" value="Post" /></input>
		</form>
		<!-- Show thread, ordered by post id -->
			<!-- New thread button increments to threadPost -->
			<form action="newThread.php" method="post">
				<input type="submit"  name="nThread" value="New Thread" /></input>
			</form>
			<form action=newThread.php" method="post">
				<input type="text" name="nSubIn" placeholder="Subject" value="" /></input><br>
				<textarea name="nForumIn" cols="60" rows="10" placeholder="Enter your witty ideas here." value="" /></textarea><br>
				<input type="submit" name="nSub" value="Post" /></input>
			</form>
			<!-- Replies create refNum, refnum will be the variable in php of threadPost_id in the database. 
			refNum will be taken from the first post. -->
			<!-- Create thread views based on refNum and forumPost_id. Call threadPost_author for the top right
			Thread Author view. -->
		<?php  
		
		?>	
	</body>
</html>
