<!DOCTYPE HTML>
<html lang="en-GB">
<?php include '../config/config.php'; ?>
<?php include '../classes/Database.php'; ?>
<?php include '../classes/User.php'; ?>
<?php include '../classes/Images.php'; ?>
<?php include 'models/page.php'; ?>

	<head>
		<link href="css/main.css" rel="stylesheet">

		<title><?php echo SITE_NAME; ?> | Admin | Blog</title>
	</head>
	<body>
		<?php include('includes/header.php'); ?>
		<div class="pageContainer">
			<?php				
				switch($page){
					case 'login':
						include('pages/login.php');
						break;
					case 'register';
						include('pages/register.php');
						break;
				}
			?>
		</div>

		<script src="js/main.js"></script>
		<script>

			
		</script>
	</body>
</html>