<?php
	// Latest posts for home page
	$latestPosts = $blog->getLatestHomePost(1, 'blog');
	$latestArticles = $blog->getLatestHomePost(1, 'article');

	// Latest Activity
	$news = new News($pdo);
	$latestActivity = $news->getLatestActivity(3);
?>