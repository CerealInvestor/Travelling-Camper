<?php session_start(); ?>
<?php include 'config/config.php'; ?>
<?php include 'classes/Database.php'; ?>
<?php include 'classes/User.php'; ?>
<?php include 'classes/Blog.php'; ?>
<?php include 'models/blog.php'; ?>
<!DOCTYPE html>
<html lang="en-GB">
	<head>
		<?php include('includes/head.php'); ?>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>

		<?php //if(@!$postId) { ?>
			<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBnryfq8QgNiGGOJig21E0L_AgTCdA0hCY&callback=init"></script>
			<script type="text/javascript" src="<?php echo URL_ROOT; ?>js/google.js"></script>
		<?php //} ?>

		<title><?php echo SITE_NAME; ?> | <?php if(META_DESC){ echo META_DESC; } ?> | Blog</title>
	</head>
	<body<?php //if(@!$postId) { ?> onload="init();"<?php // } ?>>

		<?php include('navigation.php'); ?>
		<?php include("includes/blog.php"); ?>
		<?php include("footer.php"); ?>	
		

		<script type="text/javascript" src="<?php echo URL_ROOT; ?>js/main.js"></script>
		
		<?php include("includes/ganalytics.html"); ?>
		<?php if(@$postId) { ?>
			<script type="text/javascript" src="<?php echo URL_ROOT; ?>js/imageGallery.js"></script>
		<?php } ?>
		
	</body>
</html>