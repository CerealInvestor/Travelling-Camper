<?php
	$blog = new Blog($pdo);

	$posts = $blog->getPostList();
?>