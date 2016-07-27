<?php
	#redirects a user to a new location.
        function redirect($newLocation) {
                header("Location: " . $newLocation);
        }
?>
