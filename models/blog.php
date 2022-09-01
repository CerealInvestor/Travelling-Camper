<?php
	// initiate class
	$blog = new Blog($pdo);

	if(isset($_GET['pageType'])) 
	{
		// variables to determin which scripts are included in the main blog,php file
		$pageType = $_GET['pageType'];
		$tripMap = false;
		$recaptcha = false;
		/*
			If the page has a tripId
		*/
		switch ($pageType) {
			case 'trips':
				$tripMap = true;
				$trips = $blog->getTrips();
				break;

			case 'trip':
				$tripMap = true;
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

					// Recatptcha is included
					$recaptcha = true;

					// Get the tripslug used to retrun trip data
					$tripSlug = $post['tripSlug'];

					// Set meta text
					$pageMeta = 'Travelling in a campervan to and around ' . $post['postLocation'];

					// Gets post messages
					$messages = $blog->getPostMessages($postId);

					// next and previous links
					$nextPost = $blog->nextPrevId($postId, '>', $tripSlug, $post['postDate']);
					$prevPost = $blog->nextPrevId($postId, '<', $tripSlug, $post['postDate']);

					// Get recommended articles
					//$checkoutArticle = $blog->checkoutArticle();
				} 
				else {
					$postId = false;
					$pageMeta = 'places visited in our Travelling Camper';
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
				// Get the aritcle list
				$articles = $blog->getArticles();

				break;

			case 'article':
				// get the slug for selected article
				// get all article data for selected slug
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