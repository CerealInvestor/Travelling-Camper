<?php session_start(); ?>
<?php include '../config/config.php'; ?>
<?php include '../classes/Database.php'; ?>
<?php include '../classes/User.php'; ?>
<?php

	unset($_SESSION['errors']);

	/*
	above start a session
	Get postId
	check if entered
	check if blog post actually exists
	set form variable
	check if required fields entered
	set session errors so we can access these back on the blog page

	*/

	$user = new User($pdo);

		$errors = [];

		$email = $_POST['newsletterEmail'];

		if(!isset($email) || empty($email)) {
			$_SESSION['errors']['email'] = true;
		}

		
		if(isset($_SESSION['errors']['messageUser']) || isset($_SESSION['errors']['messageText'])){

			header('Location: ' . URL_ROOT . 'blog/' . $slug);
		}

		if($user->addNewsletter($email)){
			if($sendEmail == true){
				header('Location: ' . URL_ROOT . '?message=added#messageAdded');
			} else {
				header('Location: ' . URL_ROOT);
			}
		}

?>
