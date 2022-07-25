<?php include('php/isLoggedIn.php'); ?>
<?php //include 'classes/User.php'; ?>

<!DOCTYPE html>
<html lang="en-GB">
	<head>
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCVvAIahL0MFZWX5GNQ5Bs66HqsjixTCbc&callback=init"></script>
		<script type="text/javascript" src="js/google.js"></script>
		<title><?php echo SITE_NAME; ?> | Admin | Home</title>
	</head>
	<body onload="init();">

		<?php include('includes/header.php'); ?>
		<?php include('includes/navigation.php'); ?>
		<?php include('includes/login.php'); ?>		

		<script src="js/main.js"></script>
	</body>
</html>