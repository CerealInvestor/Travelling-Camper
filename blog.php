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

		<?php if($tripMap) { ?>
			<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBnryfq8QgNiGGOJig21E0L_AgTCdA0hCY&callback=init"></script>
			<script type="text/javascript" src="<?php echo URL_ROOT; ?>js/google.js"></script>
		<?php } ?>

		<?php  
			if($recaptcha) 
			{
		?>
				<script src="https://www.google.com/recaptcha/api.js?render=6Lc-t1QhAAAAAENc0r9rr-nJ9We6GZEG0Lk9rdwB"></script>
		<?php
			}
		?>

		<link rel="stylesheet" href="<?php echo URL_ROOT; ?>css/slideshow.css" />

		<title><?php echo SITE_NAME; ?> | <?php if(isset($pageMeta)){ echo $pageMeta; } else {echo META_DESC; } ?> | Blog</title>
	</head>
	<body<?php if($tripMap) { ?> onload="init();"<?php } ?>>
		<?php include('navigation.php'); ?>
		<?php include("includes/blog.php"); ?>
		<?php include("footer.php"); ?>	
		

		<script type="text/javascript" src="<?php echo URL_ROOT; ?>js/main.js"></script>
		
		<script>
			   // when form is submit
			$('#commentForm').submit(function() {
			    // we stoped it
			    event.preventDefault();
			    console.log('here');
			    
			    var messageUser = $('#messageUseressageUser').val();
			    var messageText = $("#messageText").val();
			    var pageType = $("#pageType").val();
			    var postId = $("#postId").val();
			    var slug = $("#slug").val();
			    // needs for recaptacha ready
			    grecaptcha.ready(function() {
			        // do request for recaptcha token
			        // response is promise with passed token
			        grecaptcha.execute('6Lc-t1QhAAAAAENc0r9rr-nJ9We6GZEG0Lk9rdwB', {action: 'create_comment'}).then(function(token) {
			            // add token to form
			            $('#comment_form').prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');
			                $.post("form.php",{email: email, comment: comment, token: token}, function(result) {
			                        console.log(result);
			                        if(result.success) {
			                                alert('Thanks for posting comment.')
			                        } else {
			                                alert('You are spammer ! Get the @$%K out.')
			                        }
			                });
			        });;
			    });
			});
		</script>

		<?php include("includes/ganalytics.html"); ?>
		<?php if(@$postId) { ?>
			<script type="text/javascript" src="<?php echo URL_ROOT; ?>js/imageGallery.js"></script>
		<?php } ?>
		
	</body>
</html>