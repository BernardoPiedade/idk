<?php include('./server-side-php/conn.php'); // $conn ?>
<?php //include('./server-side-php/check-session.php'); ?>
<?php include('./server-side-php/get-user-id.php'); // $username and $user_id ?>
<?php include('./server-side-php/pagination.php'); // $page_num ; $total_num_of_pages ; $previous_page ; $next_page ?>
<?php include('./server-side-php/loggout.php'); ?>
<?php 
$title = "Devuger | Homepage"; // page title, found on "header.php"
?>

<?php include('./templates/header.php'); ?>

<main class="content-wrapper">
    <div class="container">
        <div class="row">
			<div class="col-md-9 py-3">
				
				
                
				<?php include('./templates/pagination.php'); // pagination template ?>

            </div>

			<?php include('./templates/right-side-bar.php'); ?>

		</div>
    </div>
</main>

<?php include('./templates/footer.php'); ?>