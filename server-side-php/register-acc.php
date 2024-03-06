<?php include('./conn.php'); // database conection var $conn and session_start()  ?>
<?php include('../conf.php'); // password $pepper ?>
<?php include('./errorsHandling/errors-register-acc.php'); // errors handling array ?>
<?php

// form entries initialization
$new_username = "";
$new_email = "";


if (isset($_POST['reg_user'])){

	//get username and email
	$new_username = isset($_POST['new_username']);
	$new_email = isset($_POST['new_email']);

	// get both passwords to verify they're the same.
	$new_password1 = isset($_POST['password1']);
	$new_password2 = isset($_POST['password2']);

	// verify the entries were filled
	if (empty($new_username)){
		array_push($errors, "Username is required!");
		exit();
	}

	if (empty($new_email)){
		array_push($errors, "Email is required!");
		exit();
	}

	// verify if email is valid
	if(filter_var($new_email, FILTER_VALIDATE_EMAIL) == false){
		array_push($errors, "Email address is not valid!");
		exit();
	}

	if (empty($new_password1)){
		array_push($errors, "Password is required!");
		exit();
	}

	if(strlen($new_password1) < 10){
		array_push($errors, "Password must be at least 10 characters long!");
		exit();
	}

	if (empty($new_password2)){
		array_push($errors, "Password verification is required!");
		exit();
	}

	if ($new_password1 != $new_password2){
		array_push($errors, "The two passwords do not match!");
		exit();
	}

	// check if username or email is already in use
	$user_email_check = $conn->prepare("SELECT * FROM users WHERE username=:new_username OR email=:new_email LIMIT 1");
	$user_email_check->execute(['new_username' => $new_username, 'new_email' => $new_email]);
	$get_data_user_email = $user_email_check->fetchAll();

	//if user or email exists
	if($get_data_user_email){
		if($get_data_user_email['username'] === $new_username){
			array_push($errors, "Username already exists");
		}

		if($get_data_user_email['email'] === $new_email){
			array_push($errors, "Email already exists");
		}
	}

	// if there's no erros, register the user
	if(count($errors) == 0){

		// to register the user we first add it to the "users" table
		// we then need to get the "userId" that was given
		// having that, we can then add the password to the "pass" table

		// encrypt password
		$password_peppered = hash_hmac("sha256", $new_password1, $pepper);
		$password_hashed = password_hash($pwd_peppered, PASSWORD_ARGON2ID);

		// prepare and execute query to add user to database
		$register_user = $conn->prepare("INSERT INTO users (username, email, creationDate, uRank) VALUES (:new_username, :new_email, NOW(), 0");
		$register_user->execute(['new_username' => $new_username, 'new_email' => $new_email]);

		// prepare and execute query to get the user id
		$find_user_id = $conn->prepare("SELECT id FROM users WHERE username=:new_username");
		$find_user_id->execute(['username_entered' => $new_username]);
		$get_find_user_id = $find_user_id->fetchAll();

		// prepare and execute query to add user password to database
		$register_password = $conn->prepare("INSERT INTO pass (uPass, userId) VALUES (:password_hashed, :user_id)");
		$register_password->execute(['password_hashed' => $password_hashed, 'user_id' => $get_find_user_id]);
		
		// login and send user to homepage
		$_SESSION['username'] = $new_username;
		$_SESSION['success'] = "You're now logged in!";
		header('location: index.php');

	}
}

?>