<?php header("Content-Type: text/json"); ?>
<?php include '../config/config.php'; ?>
<?php include '../classes/Database.php'; ?>
<?php include '../classes/Blog.php'; ?>
<?php
	$blog = new Blog($pdo);

	if(isset($_GET['tripslug']))
	{
		$tripSlug = htmlspecialchars($_GET['tripslug']);
		$locations =  $blog->getPostList(null, 'blog', $tripSlug);

	}
	else 
	{
		$locations =  $blog->getAllTrips();
	}

	//echo 'slug: ' . $_GET['tripslug'];

	echo json_encode($locations);
?>