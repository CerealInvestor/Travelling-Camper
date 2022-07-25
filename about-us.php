<?php include 'config/config.php'; ?>

<!DOCTYPE html>
<html lang="en-GB">
	<head>
		<?php include('includes/head.php'); ?>

		<title><?php echo SITE_NAME; ?> | About Us</title>
	</head>
	<body>

		<?php include('navigation.php'); ?>
		<?php include("includes/about-us.php"); ?>
		<?php include("footer.php"); ?>		

		<script src="<?php echo URL_ROOT; ?>js/main.js"></script>
		<?php include("includes/ganalytics.html"); ?>
	</body>
</html>