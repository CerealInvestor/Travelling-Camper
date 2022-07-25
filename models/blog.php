<?php
	$blog = new Blog($pdo);

	if(isset($_GET['pageType'])) {
		$pageType = $_GET['pageType'];
	} else {
		$pageType = 'blog';
	}

	if(isset($_GET['postId']) || isset($_GET['slug'])) {
		if(isset($_GET['postId'])) {
			$postId = $_GET['postId'];

			$post = $blog->getPostList($postId, $pageType);
		} elseif($_GET['slug']){
			$slug = $_GET['slug'];
			$post = $blog->getPost(null, $pageType, $slug);
			$postId = $post['postId'];
		}

		// Set meta text
		$postMeta = 'Travelling in a camper to and around ' . $post['postLocation'];

		$messages = $blog->getPostMessages($postId);

		$nextPost = $blog->nextPrevId($postId, '>');
		$prevPost = $blog->nextPrevId($postId, '<');
	} else {
		$postId = false;
		$postMeta = 'places visited in our Travelling Camper';
	}
	
	$list = $blog->getPostList(null, $pageType);
	$i = 0;
	foreach($list as $item){
		$list[$i]['postImages'] = $blog->getImages($item['postId'], 1);
		$i++;
	}
	//$posts = $blog->getLatestPost();
	$articles = $blog->getPostList(null, 'article');

	$latest = $blog->getLatestPost(1);
	if(isset($latest['postMiles'])) {
		$latestMiles = $latest['postMiles'];
	}
?>