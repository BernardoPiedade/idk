<?php include('./conn.php'); ?>
<?php include('../conf.php'); ?>
<?php include('errors-register-acc.php'); ?>
<?php

// this file ads a new user to the database


// form entries initialization
$new_username = "";
$new_email = "";


if (isset($_POST['reg_user'])) {

	//get username and email
	$new_username = isset($_POST['new_username']);
	$new_email = isset($_POST['new_email']);

	// get both passwords to verify they're the same.
	$new_password1 = isset($_POST['password1']);
	$new_password2 = isset($_POST['password2']);

	// verify the entries were filled
	if (empty($new_username)){
		array_push($errors, "Username is required!");
	}

	if (empty($new_email)){
		array_push($errors, "Email is required!");
	}

	if (empty($new_password1)){
		array_push($errors, "Password is required!");
	}

	if(strlen($new_password1) < 10){
		array_push($errors, "Password must be at least 10 characters long!");
	}

	if (empty($new_password2)){
		array_push($errors, "Password verification is required!");
	}

	if ($new_password1 != $new_password2){
		array_push($errors, "The two passwords do not match!");
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

		// encrypt password
		$password_peppered = hash_hmac("sha256", $new_password1, $pepper);
		$password_hashed = password_hash($pwd_peppered, PASSWORD_ARGON2ID);

	}

	// Finally, register user if there are no errors in the form
	if (count($errors) == 0) {
		
		$options = [
			'cost' => 10
		];

		$password = password_hash($password_1, PASSWORD_BCRYPT, $options);

		$query = "INSERT INTO users (username, pass, email, creationDate, uRank) 
					VALUES('$username', '$password', '$email', NOW(), 0)";
		mysqli_query($db, $query);
		$_SESSION['username'] = $username;
		$_SESSION['success'] = "You are now logged in";
		header('location: index.php');
	}


}

?>