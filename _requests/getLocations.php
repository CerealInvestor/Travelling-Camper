<?php header("Content-Type: text/json"); ?>
<?php include '../config/config.php'; ?>
<?php include '../classes/Database.php'; ?>
<?php include '../classes/Blog.php'; ?>
<?php
	$blog = new Blog($pdo);

	$locations =  $blog->getPostList(null, 'blog');

	echo json_encode($locations);
?>