<?php include 'config/config.php'; ?>

<!DOCTYPE html>
<html lang="en-GB">
	<head>
		<?php include('includes/head.php'); ?>

		<title><?php echo SITE_NAME; ?> | Privacy Policy</title>
	</head>
	<body>

		<?php include('navigation.php'); ?>
		<?php include("includes/privacy.php"); ?>
		<?php include("footer.php"); ?>		

		<script type="text/plain" cookie-consent="strictly-necessary" src="<?php echo URL_ROOT; ?>js/main.js"></script>
		<?php include("includes/ganalytics.html"); ?>
	</body>
</html>