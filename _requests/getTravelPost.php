<?php include '../config/config.php'; ?>
<?php include '../classes/Database.php'; ?>
<?php include '../classes/Blog.php'; ?>
<?php
	$postId = $_GET['postId'];

	$blog = new Blog($pdo);

	$post =  $blog->getPostList($postId);
	print_r($post);
?>