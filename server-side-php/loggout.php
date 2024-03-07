<?php

	// this file saves the loggout code
	// it destroys the session and unsets the 'username' cookie

	// it's to be called on every page where the loggout is available.

	if (isset($_GET['logout'])) {
		session_destroy();
    	unset($_SESSION['username']);
    	header("location: index.php");
	}

?>