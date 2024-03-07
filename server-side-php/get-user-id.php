<?php

	// This file gets the logged in user id
	// it's used for the pagination and post display on the homepage.

	$username = $_SESSION['username'];

	$get_user_id = $conn->prepare("SELECT id FROM users WHERE username=:username");
	$get_user_id->execute(['username' => $username]);
	$user_id = $get_user_id->fetchAll();

?>