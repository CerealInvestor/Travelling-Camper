<?php session_start(); ?>
<?php include '../config/config.php'; ?>
<?php include '../classes/Database.php'; ?>
<?php include '../classes/Blog.php'; ?>
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

	$postId = $_GET['postId'];

	if(!$postId){
		header('Location: ' . URL_ROOT . PAGE_404);
	}

	$blog = new Blog($pdo);

	$checkMessageExists =  $blog->checkMessageExists($postId);

	if(!$checkMessageExists){
		header('Location: ' . URL_ROOT . PAGE_404);
	} else {
		$errors = [];

		$messageUser = $_POST['messageUser'];
		$messageText = $_POST['messageText'];
		$postId = $_POST['postId'];
		$slug = $_POST['slug'];
		$pageType = $_POST['pageType'];

		if(!isset($messageUser) || empty($messageUser)) {
			$_SESSION['errors']['messageUser'] = true;
		}

		if(!isset($messageText) || empty($messageText)) {
			$_SESSION['errors']['messageText'] = true;
		}

		
		if(isset($_SESSION['errors']['messageUser']) || isset($_SESSION['errors']['messageText'])){

			header('Location: ' . URL_ROOT . 'blog/' . $slug);
		}

		if($blog->addMessage($postId, $messageUser, $messageText, $slug)){
			$to = "cerealinvestor@gmail.com";
			$subject = "Message added";

			$message = "<b>Message added to Travelling Camper</b>";
			$message .= "<h1>Check it out</h1>";

			$header = "From:contact@travelling-camper.co.uk \r\n";
			$header .= "MIME-Version: 1.0\r\n";
			$header .= "Content-type: text/html\r\n";

			$sendEmail = mail($to, $subject, $message, $header);

			if($sendEmail == true){
				header('Location: ' . URL_ROOT . 'blog/' . $slug . '&message=added#messageAdded');
			} else {
				header('Location: ' . URL_ROOT . 'blog/' . $slug);
			}
		}
	}

?>
