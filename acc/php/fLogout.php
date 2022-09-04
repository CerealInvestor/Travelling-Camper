<?php
	session_unset();

	include '../../config/config.php';

	header('Location: ' . URL_ROOT . '/acc/login.php?page=login');
?>