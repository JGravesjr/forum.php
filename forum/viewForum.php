<?php
        #Starting session
        session_start();
	
	#Adding session to a local variable.
        $username = $_SESSION['username'];

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
                <title>Forum</title>
        </head>
        <body>
		<!-- View all threads -->
		<?php
				$threadOutput = "";
				#Get all posts from threadPost, then search forumPost for subject names
		        	$query = "SELECT * FROM threadPost ORDER BY id DESC";
                		$threadResult = mysqli_query($connection, $query);
				if (!$threadResult) {
                     			die("Database query failed. " . mysqli_error($connection));
                		}
				#Putting values into php variable to search for subjects. 
                		while ($row = mysqli_fetch_array($threadResult)){
                			$threadIdValue = $row['id'];
					$author = $row['author'];
					$subQuery = "SELECT subject FROM forumPost 
						WHERE threadPost_id = '$threadIdValue' ORDER BY id ASC LIMIT 1";
					$subResult = mysqli_query($connection, $subQuery);
					if (!$subResult) {
						die("Database query failed. " . mysqli_error($connection));
					}
					while ($subRow = mysqli_fetch_array($subResult)){
						$subValue = $subRow['subject'];
						$threadOutput .=  "<a href='threadView.php'>{$threadIdValue}  {$subValue}  {$author}</a><br>";
					}
		
				}		
				
			
               	?>
		
		<?php echo $threadOutput; ?>
        </body>
</html>

