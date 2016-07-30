<?php
	#Connecting to the Forum_app database.
        $connection = mysqli_connect("localhost", "forum", "HarvardFan46", "forum_app");
        if (mysqli_connect_errno()) {
                die("Database connection failed: " . mysqli_connect_error() .
                " (" . mysqli_connect_errno() . ")" );
        }

	#Bring in functions.php
	require_once("../php/functions.php");
	
	#Start session.
	session_start();

	#Assign a value to $_GET value.
	$threadId = $_GET['id'];
        #Connecting to the Forum_app database.
        $connection = mysqli_connect("localhost", "forum", "HarvardFan46", "forum_app");
        if (mysqli_connect_errno()) {
                die("Database connection failed: " . mysqli_connect_error() .
                " (" . mysqli_connect_errno() . ")" );
        }

	#Get thread post data from forumPost.
	$threadQuery = "SELECT * FROM forumPost 
                  WHERE threadPost_id = '$threadId' ORDER BY id ASC";
        $threadResult = mysqli_query($connection, $threadQuery);
	#Make sure we're connected to the database
        if (!$threadResult) {
	        die("Database query failed. " . mysqli_error($connection));
        }
        $match = 1;
	while ($threadRow = mysqli_fetch_array($threadResult)){
        	#Getting the first subject value for the title.
		if ($match == 1){
			$subHeader = $threadRow['subject'];
		}
		$match ++;
		#Adding posts to threadOutput
		$subValue = $threadRow['subject'];
		$textValue = $threadRow['text'];
                $threadOutput .=  
"<pre>{$subValue} <br> 
	{$textValue} <br></pre>";
        }
	
        #Reply to a thread
        if (isset($_POST['nReply'])) {
              #Connect to mysql server.
                $connection = mysqli_connect("localhost", "forum", "HarvardFan46", "forum_app");
                if (mysqli_connect_errno()) {
                die("Database connection failed: " . mysqli_connect_error() .
                    " (" . mysqli_connect_errno() . ")" );
                }
		
		#Insert reply into forumPost with threadId field. 
                #Add nSubIn and nForumIn variables.
                $nSubIn = mysqli_real_escape_string($connection, $_POST['nSubIn']);
                $nForumIn = mysqli_real_escape_string($connection, $_POST['nForumIn']);
                $query = "INSERT INTO forumPost (subforum, threadPost_id, subject, text)
                         VALUES ('$subforum', '$threadId', '$nSubIn', '$nForumIn' )";
                $forumResult = mysqli_query($connection, $query);
                if (!$forumResult) {
                      die("Database query failed. " . mysqli_error($connection));
                }
	redirect("threadView.php?id=$threadId"); 
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN""http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">
	<head>
		<title><?php echo $subHeader; ?></title>
	</head>
	<body>
		<!-- Link back to forum view -->
		<a href="forum.php">Forum</a>
		<?php echo $threadOutput; ?>
		<br>
		<form action="threadView.php?id=<?php echo $threadId; ?>" method="post">
			<input type="text" name="nSubIn" placeholder="Add your subject here. " value="" /></input><br>
			<textarea cols="60" rows="10" placeholder="Enter your witty ideas here." name="nForumIn" value="" /></textarea><br>
			<input type="submit" name="nReply" value="Reply" /></input>

		</form>	
	</body>
</html>

