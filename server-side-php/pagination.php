<?php

	// this file saves the pagination code.
	// it will probably only be used on the homepage.php


	// get page number
	if (isset($_GET['page_num']) && $_GET['page_num'] != "") {
    	$page_num = $_GET['page_num'];
	} else {
    	$page_num = 1;
	}

	$total_posts_per_page = 15;
	$offset = ($page_num - 1) * $total_posts_per_page;
	$previous_page = $page_num - 1;
	$next_page = $page_num + 1;


	// prepare and execute query to get posts
	// $user_id comes from "get-user-id.php"
	$num_posts = $conn->prepare("SELECT COUNT(*) As total_posts FROM posts WHERE subforumId IN (SELECT subId FROM subscriptions WHERE userId=:user_id)");
	$num_posts->execute(['user_id' => $user_id]);
	$total_num_posts = $num_posts->fetch();

	$total_num_of_pages = ceil($total_num_posts[0] / $total_posts_per_page);
	

?>