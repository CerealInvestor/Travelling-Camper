<!DOCTYPE HTML>
<html lang="en-GB">
<?php include '../config/config.php'; ?>
<?php include '../classes/Database.php'; ?>
<?php include '../classes/User.php'; ?>
<?php include '../classes/Blog.php'; ?>
<?php include '../classes/Images.php'; ?>
<?php include 'models/blog.php'; ?>
	<head>
		<link href="css/main.css" rel="stylesheet">

		<title><?php echo SITE_NAME; ?> | Admin | Blog</title>
		
		<?php if($page == 'edit' || $page == 'add') { ?>
			<script src="https://cdn.tiny.cloud/1/iay6ot7o89zwbi6h0aj6fnuxsmn08nn4uvh2a7qldncbftv0/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
			<script type="text/javascript">
			tinymce.init({
		      selector: '#postContent',
		      plugins: 'a11ychecker advcode casechange export formatpainter image editimage linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tableofcontents tinycomments tinymcespellchecker',
		      toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter image editimage pageembed permanentpen table tableofcontents',
		      toolbar_mode: 'floating',
		      tinycomments_mode: 'embedded',
		      tinycomments_author: 'Travelling Camper',
		    });
			</script>
		<?php } ?>
	</head>
	<body>
		<?php include('includes/header.php'); ?>
		<div class="pageContainer">
			<?php				
				switch($page){
					case 'list':
						include('pages/blog-list.php');
						break;
					case 'edit':
						include('pages/blog-edit.php');
						break;
					case 'add':
						include('pages/blog-add.php');
						break;
					case 'edit-caption-list';
						include('pages/caption-edit-list.php');
						break;
					case 'edit-caption';
						include('pages/caption-edit.php');
						break;
					default:
						include('pages/blog-list.php');
						break;
				}
			?>
		</div>

		<script src="js/main.js"></script>
		<script>

			
		</script>
	</body>
</html>