<?php
	// start the session
	// check the session

	session_start();

?>
		<?php include '../config/config.php'; ?>
		<?php include '../classes/Database.php'; ?>
		<?php include '../classes/User.php'; ?>
		<?php include '../classes/Blog.php'; ?>

<?php
		$user = new User($pdo);

		$check = $user->isLoggedIn();

		if(!$check) {
			header('Location: ' . CMS_ROOT . 'login.php');
		}
	

?>