<?php include('php/isLoggedIn.php'); ?>
<?php include '../classes/Recipes.php'; ?>
<?php include 'models/recipes.php'; ?>

<!DOCTYPE html>
<html lang="en-GB">
	<head>
		<link href="css/main.css" rel="stylesheet">
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCVvAIahL0MFZWX5GNQ5Bs66HqsjixTCbc&callback=init"></script>
		<script type="text/javascript" src="js/google.js"></script>
		<title><?php echo SITE_NAME; ?> | Admin | Blog</title>
		
		<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
		
		<!-- Include the Quill library -->
		<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
	</head>
	<body onload="init();">

		<div id="pageContainer">
			<?php include('includes/header.php'); ?>
			<?php include('includes/navigation.php'); ?>
			<?php
				$page = isset($_GET['page']) ? $_GET['page'] : '';
				
				switch($page){
					case 'list':
						include('pages/recipe-list.php');
						break;
					case 'edit':
						include('pages/recipe-edit.php');
						break;
					case 'add':
						include('pages/recipe-add.php');
						break;
					default:
						include('pages/recipe-list.php');
						break;
				}
			?>
		</div>

		<script src="js/main.js"></script>
		<script>
		  	var Editors = ['#recipeDesc'];
			var quill;
			for(var k=0; k<=Editors.length; k++)
			{
			quill = new Quill(Editors[k], {
			theme: 'snow'
			});
			}
		</script>
	</body>
</html>