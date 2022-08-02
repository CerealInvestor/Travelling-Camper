<?php
	$blog = new Blog($pdo);

	if(isset($_GET['pageType'])) 
	{
		$pageType = $_GET['pageType'];
		/*
			If the page has a tripId
		*/
		switch ($pageType) {
			case 'trips':
				$trips = $blog->getTrips();
				break;

			case 'trip':
				// SLUG for the trip
				$tripSlug = htmlspecialchars($_GET['tripSlug']);

				$trip = $blog->getTrip($tripSlug);

				$tripLat = $trip['tripLat'];
				$tripLong = $trip['tripLong'];
				// Get individual posts for a trip
				$tripPosts = $trip['posts'];

				break;

			case 'blog':

				/*
					Single Blog post
				*/
				if(isset($_GET['postId']) || isset($_GET['slug'])) 
				{
					if(isset($_GET['postId'])) 
					{
						$postId = $_GET['postId'];

						$post = $blog->getPostList($postId, $pageType);
					} elseif($_GET['slug']){
						$slug = $_GET['slug'];
						$post = $blog->getPost(null, $pageType, $slug);
						$postId = $post['postId'];
					}

					$tripSlug = $post['tripSlug'];

					// Set meta text
					$postMeta = 'Travelling in a camper to and around ' . $post['postLocation'];

					$messages = $blog->getPostMessages($postId);

					$nextPost = $blog->nextPrevId($postId, '>', $tripSlug, $post['postDate']);
					$prevPost = $blog->nextPrevId($postId, '<', $tripSlug, $post['postDate']);
				} 
				else {
					$postId = false;
					$postMeta = 'places visited in our Travelling Camper';
				}

				$list = $blog->getPostList(null, $pageType);
				$i = 0;
				foreach($list as $item){
					$list[$i]['postImages'] = $blog->getImages($item['postId'], 1);
					$i++;
				}

				$latest = $blog->getLatestPost(1);
				if(isset($latest['postMiles'])) {
					$latestMiles = $latest['postMiles'];
				}

				break;

			case 'articles':

				$articles = $blog->getArticles();

				break;

			case 'article':
				$slug = $_GET['slug'];
				$article = $blog->getPost(null, 'article', $slug);

				break;
			
			default:
				$list = $blog->getPostList(null, 'article');
				$articles = $blog->getPostList(null, 'article');
				break;
		}


	} 
?>