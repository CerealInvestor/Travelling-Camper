<?php include 'config/config.php'; ?>
<?php include 'classes/Database.php'; ?>
<?php include 'classes/Blog.php'; ?>
<?php include 'models/travelling-camper.php'; ?>

<!DOCTYPE html>
<html lang="en-GB">
	<head>
		<?php include('includes/head.php'); ?>
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCVvAIahL0MFZWX5GNQ5Bs66HqsjixTCbc&callback=init"></script>
		<script type="text/javascript" src="js/google.js"></script>
		<script src="js/jquery-3.6.0.min.js"></script>
		<title><?php echo SITE_NAME; ?> | Travelling Camper</title>
	</head>
	<body onload="init();">

		<?php include('navigation.php'); ?>
		<?php include("includes/travelling-camper.php"); ?>
		<?php include("footer.php"); ?>	

		<script src="js/main.js"></script>
		<?php include("includes/ganalytics.html"); ?>
	</body>
</html>