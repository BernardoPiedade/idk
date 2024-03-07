<?php

	// this page only serves to check if the user is logged in.
	// if the user is logged in, he or she is sent to the homepage.
	// If the user is not logged in, he or she is sent to the registration page.

	// A user cannot search the site and see posts without an account.

	// The scripts exits after sending the user to a different location.

	session_start();

	if(isset($_SESSION['username'])){
		header("location: homepage.php");
		exit();
	}else{
		header("location: register.php");
		exit();
	}

?>