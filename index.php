<?php include 'config/config.php'; ?>
<?php include 'classes/Database.php'; ?>
<?php include 'classes/Blog.php'; ?>
<?php include 'classes/News.php'; ?>
<?php include 'models/blog.php'; ?>
<?php include 'models/home.php'; ?>
<?php
	$blog = new Blog($pdo);
?>
<!DOCTYPE html>
<html lang="en-GB">
	<head>
		<script type="text/plain" cookie-consent="strictly-necessary" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>

		<?php include('includes/head.php'); ?>

		<link rel="stylesheet" href="<?php echo URL_ROOT; ?>css/slideshow.css" />
		<link rel="stylesheet" href="<?php echo URL_ROOT; ?>css/homeLatest.css" />
		<title><?php echo SITE_NAME; ?> | Home of the Travelling Camper</title>
	</head>
	<body>
		<?php include('navigation.php'); ?>
		<?php include("home.php"); ?>
		<?php include("footer.php"); ?>

		<script type="text/javascript">
		let slideIndex = 0;
		//showShow();

		function showShow() {
		  let i;
		  let slides = document.getElementsByClassName("myShow");
		  for (i = 0; i < slides.length; i++) {
		    slides[i].style.display = "none";  
		  }
		  slideIndex++;
		  if (slideIndex > slides.length) {slideIndex = 1}    
		  
		  slides[slideIndex-1].style.display = "block";  

		  setTimeout(showShow, 6000); // Change image every 2 seconds
		}
		</script>
		<script type="text/plain" cookie-consent="strictly-necessary" src="<?php echo URL_ROOT; ?>js/main.js"></script>


		<?php include("includes/ganalytics.html"); ?>
	</body>
</html>