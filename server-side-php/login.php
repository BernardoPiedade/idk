<?php include('./conn.php'); // database conection var $conn and session_start() ?>
<?php include('./errorsHandling/errors-login.php'); // errors handling array ?>
<?php


//form entries initialization
$username_entered = "";
$password_entered = "";

if(isset($_POST['login_user'])){

	// get username and password
	$username_entered = isset($_POST['username']);
	$password_entered = isset($_POST['password']);


	// verify both fields were filled
	if (empty($username_entered)) {
		array_push($errors, "Username is required!");
		exit();
	}
	
	if (empty($password_entered)) {
		array_push($errors, "Password is required!");
		exit();
	}

	// if there's no errors above, check the username and the password
	if (count($errors) == 0) {
		
		// find user id with given username
		$find_user = $conn->prepare("SELECT id FROM users WHERE username=:username_entered");
		$find_user->execute(['username_entered' => $username_entered]);
		$get_find_user = $find_user->fetch();

		// find password hash with given user id
		$find_pass_hash = $conn->prepare("SELECT uPass FROM pass WHERE userId=:username_id");
		$find_pass_hash->execute(['username_id' => $get_find_user[0]]);
		$get_find_pass_hash = $find_pass_hash->fetch();

		// verify if the entered password matches with the stored hash
		// if it matches, the user is logged in and sent to homepage
		if (password_verify($password_entered, $get_find_pass_hash[0])){
			$_SESSION['username'] = $username_entered;
			$_SESSION['success'] = "You are now logged in!";

			exit();

			header("location: homepage.php");
		}else{
			array_push($errors, "Invalid Username or Password!");
			exit();
		}

	}

}

?>