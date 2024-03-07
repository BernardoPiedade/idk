<?php

// This file checks if the user is logged in or not
// it's used on all pages except some like the login page
// and the index.php.

// Reminder that the user can only search and see the posts
// if he or she is logged in!

	if(isset($_SESSION['username'])){
		header("location: homepage.php");
		exit();
	}else{
		header("location: register.php");
		exit();
	}

?>