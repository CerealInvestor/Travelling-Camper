<?php
	Class Blog {
		private $conn;

		// pass the database connection to class
		// Dependency injection needed in all classes requiring a connection to db

	    /* Get database access */
	    public function __construct(\PDO $pdo) {
	        $this->conn = $pdo;
	    }

	    /* List all Categories */
	    public function getCategories() 
	    {
	        return $this->conn->query("SELECT * FROM postcategories")->fetchAll();
	    }

	    /*
			Trip Functions

	    */
		public function getAllTrips()
		{
			$stmt = $this->conn->prepare('SELECT * FROM posts WHERE deleted <> 1');
			$stmt->execute();

			$trips = $stmt->fetchAll();

			return $trips;
		}


		public function getTrips()
		{
			
			$stmt = $this->conn->prepare('SELECT * FROM postTrip WHERE deleted <> 1 ORDER BY tripId DESC');
			$stmt->execute();

			$trips = $stmt->fetchAll();

			return $trips;
		}

		/*
			the trip slug is used to get the trip details
			It is also used against each post to make sure we are in the right Trip
		*/
		public function getTrip($tripSlug)
		{
			
			$data = [
				'tripSlug' => $tripSlug
			];

			$stmt = $this->conn->prepare('SELECT * FROM postTrip WHERE tripSlug = :tripSlug AND deleted <> 1');
			$stmt->execute($data);

			$trip = $stmt->fetch();

			/*
				get the posts
			*/
			$trip['posts'] = $this->getPostList(null, 'blog', $tripSlug);

			/*
				loop through the posts and grab the first image 
				then add it to the postId array undernew key postImages
			*/
			foreach($trip['posts'] as $post)
				{
					$postId = $post['postId'];
					$image = $this->getImages($postId, 1);

					//echo '<br />postId: ' . $postId;

					$trip['post'][$postId]['postImages'] = $image[0]['imageName'];
				}

			return $trip;
		}

		/*
			Get Post
		*/



		/*
			Post Functions
		*/

	    public function getPost($postId = null, $postType = 'article', $slug = null )
	    {
	    	if($postId) 
	    	{
	    		$sql = 'postId = :postId';
				$data = ['postType' => $postType, 'postId' => $postId];
				$slug = false;
	    	}
	    	elseif($slug) 
	    	{
	    		$sql = 'slug = :slug';
    			$data = ['postType' => $postType, 'slug' => $slug];
    			$slug = true;
	    	}
			// Fetch the recipe first from database
			$stmt = $this->conn->prepare('SELECT * FROM posts WHERE ' . $sql . ' AND postType = :postType ORDER BY postMiles ASC');
			$stmt->execute($data);

			$posts = $stmt->fetch();

			// Use the postId to getImagex
			$postId = $posts['postId'];

			// Getimages
			$posts['postImages'] = $this->getImages($postId);
			$postViews = $posts['postViews'];
			// Add page view
			$this->addView($postId, $postViews);

			return $posts;
	    }

	    // Page Views
	    public function addView($postId, $postViews){
	    	if($postId) 
	    	{
	    		$postViews = $postViews + 1;

	    		$data = [
		    		'postViews' => $postViews,
		    		'postId' => $postId
		    	];

		    	$sql = '
		    		UPDATE posts SET
		    			postViews = :postViews
		    		WHERE
		    			postId = :postId
		    		';
		    	$stmt = $this->conn->prepare($sql);
		    	$stmt->execute($data);

		    	return true;
	    	}
	    }

	    // get list of posts
	    public function getPostList($postId = null, $postType = 'article', $tripSlug = null)
	    {
	    	if($postId) 
	    	{
				// Fetch the recipe first from database
				$stmt = $this->conn->prepare('SELECT * FROM posts WHERE postId = :postId AND postType = :postType ORDER BY postMiles ASC');
				$stmt->execute(['postId' => $postId, 'postType' => $postType]);

				$posts = $stmt->fetch();

				// Getimages
				$posts['postImages'] = $this->getImages($postId, null);

			} 
			else 
			{

				/*
					Capitalise first letter as stored in database
				*/
				$data = 
				[
					'postType' => $postType,
					'tripSlug' => $tripSlug
				];

				$stmt = $this->conn->prepare('SELECT * FROM posts WHERE postType = :postType AND tripSlug = :tripSlug AND deleted <> 1 ORDER BY postDate DESC, postId DESC');
				$stmt->execute($data);

				$posts = $stmt->fetchAll();

				// Get images for each post
				$i = 0;

				foreach($posts as $post) 
				{
					// Getimages
					$posts[$i]['postImages'] = $this->getImages($post['postId'], 1);
					$i++;
				}	
			}

	    	return $posts;
	    }

	    public function getArticles($slug = null){
	    	$postType = 'article';

	    	$data = 
				[
					'postType' => $postType,
				];

			

			$stmt = $this->conn->prepare('SELECT * FROM posts WHERE postType = :postType AND deleted <> 1 ORDER BY postDate DESC, postId DESC');
			$stmt->execute($data);

			$articles = $stmt->fetchAll();	

			return $articles;	
	    }

	    /* Get the next or prev*/
	    public function nextPrevId($postId, $check, $tripSlug)
	    {
	    	$data = [
	    		'postId' => $postId,
	    		'postType' => 'blog',
	    		'tripSlug' => $tripSlug
	    	];
	    	if($check == '>') 
	    	{
	    		$sql = '>';
	    		$order = ' ASC';
	    	} 
	    	else 
	    	{
	    		$sql = '<';
	    		$order = ' DESC';
	    	}


	    	$stmt = $this->conn->prepare('SELECT postId, slug FROM posts WHERE postId ' . $check . ' :postId AND postType = :postType AND tripSlug = :tripSlug AND deleted <> 1 ORDER BY postId ' . $order . ' LIMIT 1;');

			$stmt->execute($data);

			$checkingId = $stmt->fetch();

			if(isset($checkingId['postId'])) 
			{
				$postId = $checkingId['postId'];
				$slug = $checkingId['slug'];
			} 
			else 
			{
				$postId = 0;
				$slug = 0;
			}

			return $slug;
	    }

	    public function checkMessageExists($postId) 
	    {
	    	if($postId)
	    	{
	    		$stmt = $this->conn->prepare('SELECT * FROM posts WHERE postId = :postId AND deleted <> 1');
				$stmt->execute(['postId' => $postId]);

				$post = $stmt->fetch();

				if($post)
				{
					return true;
				} 
				else 
				{
					return false;
				}
	    	}
	    }

	    /* Get a list of locations, pass a category id if you like */
	    public function getLocations($categoryId = null) 
	    {
	    	$stmt = 'SELECT * FROM locations';
	    	if($categoryId) 
	    	{
	    		$stmt .= ' WHERE categoryId = ' . $categoryId;
	    	}

	    	$locations = $this->conn->query($stmt)->fetchAll();
	    	// Encode in json
	    	return $locations;

	    	
	    }

	    public function addPost($postTitle, $postLocation, $slug, $postCountry, $lat, $long, $postContent, $postBlurb, $postType, $postMiles, $deleted = 0) 
	    {
	    	$data = [
	    		'postTitle' => $postTitle,
				'postLocation' => $postLocation,
				'slug' => $slug,
				'postCountry' => $postCountry,
				'lat' => $lat,
				'long' => $long,
				'postContent' => $postContent,
				'postBlurb' => $postBlurb,
				'postType' => $postType,
				'postMiles' => $postMiles,
				'deleted' => $deleted
	    	];

	    	$sql = '
	    		INSERT INTO posts 
	    			(postTitle, postLocation, slug, postCountry, lat, long, postContent, postBlurb, postType, postMiles, deleted)
	    		VALUES
	    			(:postTitle, :postLocation, :slug, :postCountry, :lat, :long, :postContent, :postBlurb, :postType, :postMiles, :deleted)
	    		';
	    	$stmt = $this->conn->prepare($sql);
	    	$stmt->execute($data);

	    	$newId = $this->conn->lastInsertId();

	    	return $newId;
	    }

	     public function editPost($method = 'edit', $postTitle, $postContent, $postCountry, $postLocation, $postBlurb, $lat, $lon, $postMiles, $postType, $slug, $deleted = 0, $postId = null) 
	     {
	    	$data = [
	    		'postTitle' => $postTitle,
				'postLocation' => $postLocation,
				'slug' => $slug,
				'postCountry' => $postCountry,
				'lat' => $lat,
		 		'lon' => $lon,
				'postContent' => $postContent,
				'postBlurb' => $postBlurb,
				'postType' => $postType,
				'postMiles' => $postMiles,
				'deleted' => $deleted,
				'postId' => $postId
	    	];

	    	if($method == 'edit')
	    	{
		    	$sql = '
		    		UPDATE posts SET
		    			postTitle = :postTitle,
		    			postLocation = :postLocation,
		    			slug = :slug,
		    			postCountry = :postCountry,
						lat = :lat,
						lon = :lon,
						postContent = :postContent,
						postBlurb = :postBlurb,
						postType = :postType,
						postMiles = :postMiles,
						deleted = :deleted
		    		WHERE
		    			postId = :postId
		    		';

		    		$stmt = $this->conn->prepare($sql);
	    			$stmt->execute($data);

	    			return $postId;
		    } 
		    else 
		    {

		    	$dataAdd = [
	    		'postTitle' => $postTitle,
				'postLocation' => $postLocation,
				'slug' => $slug,
				'postCountry' => $postCountry,
				'lat' => $lat,
		 		'lon' => $lon,
				'postContent' => $postContent,
				'postBlurb' => $postBlurb,
				'postType' => $postType,
				'postMiles' => $postMiles,
				'deleted' => $deleted
	    		];

		    	$sql = '
		    		INSERT INTO posts 
		    			(postTitle, postLocation, slug, lat, lon, postContent, postCountry, postBlurb, postType, postMiles, deleted)
		    		VALUES
		    			(:postTitle, :postLocation, :slug, :lat, :lon, :postContent, :postCountry, :postBlurb, :postType, :postMiles, :deleted)
		    		';

		    	$stmt = $this->conn->prepare($sql);
	    		$stmt->execute($dataAdd);

	    		$newId = $this->conn->lastInsertId();
	    		echo $newId;

	    		return $newId;
		    }
	    }

	    public function getLatestPost($limit = 1) 
	    {
	    	$limitSQL = ' LIMIT ' . $limit;

	    	$data = [
	    		'postType' => 'blog'
	    	];
	    	$stmt = $this->conn->prepare("SELECT max(postId) as maxId FROM posts WHERE postType = :postType and deleted <> 1 " . $limitSQL);
			$stmt -> execute($data);
			$latest = $stmt->fetch(PDO::FETCH_ASSOC);
			$latestId = $latest['maxId'];


	    	$posts = $this->getPostList($latestId, 'blog');
	    	
	    	return $posts;
	    }

	    public function getLatestHomePost($limit = 1, $postType = 'blog') 
	    {
	    	$limitSQL = ' LIMIT ' . $limit;

	    	$data = [
	    		'postType' => $postType
	    	];
	    	$stmt = $this->conn->prepare("SELECT * FROM posts WHERE postType = :postType and deleted <> 1 ORDER BY postDate DESC, postId DESC " . $limitSQL);
			$stmt -> execute($data);
			$latest = $stmt->fetchAll(PDO::FETCH_ASSOC);

			if($postType == 'blog')
			{
				// Get images for each post
				$i = 0;
				foreach($latest as $post) 
				{
					// Getimages
					$latest[$i]['postImages'] = $this->getImages($post['postId'], 1);
					$i++;
				}
			}

	    	return $latest;
	    }


	    public function getPostMessages($postId) 
	    {
	    	$stmt = $this->conn->prepare('
	    		SELECT * FROM 
	    			postMessages 
	    		WHERE 
	    			postId = :postId
	    		ORDER BY 
	    			messageDate DESC
	    		');
	    	$stmt->execute(['postId' => $postId]);

	    	$messages = $stmt->fetchAll();

	    	return $messages;
	    }

	    public function addMessage($postId, $messageUser, $messageText, $slug)
	    {
	    	$data = [
	    		'postId' => $postId,
	    		'messageUser' => $messageUser,
	    		'messageText' => $messageText
	    	];

	    	$sql = '
	    		INSERT INTO postMessages 
	    			(postId, messageUser, messageText)
	    		VALUES
	    			(:postId, :messageUser, :messageText)
	    		';
	    	$stmt = $this->conn->prepare($sql);
	    	$stmt->execute($data);

	    	$this->addActivity('comment added', URL_ROOT . 'blog/' . $slug);

	    	return true;
	    }

	    public function addActivity($activityTitle = null, $activityLink = null) 
	    {

	    	$data = [
	    		'activityTitle' => $activityTitle,
	    		'activityLink' => $activityLink
	    	];

	    	$sql = '
	    		INSERT INTO activity 
	    			(activityTitle, activityLink)
	    		VALUES
	    			(:activityTitle, :activityLink)
	    		';
	    	$stmt = $this->conn->prepare($sql);
	    	$stmt->execute($data);

	    	return true;
	    }









	    /* Admin functions */
	    public function getImageList() {
	    	$stmt = $this->conn->prepare('SELECT * FROM postImages');
			$stmt->execute();

			$imageList = $stmt->fetchAll();

			return $imageList;
	    }

	    public function getImage($imageId) {
	    	$stmt = $this->conn->prepare('SELECT * FROM postImages WHERE imageId = :imageId');
			$stmt->execute(['imageId' => $imageId]);

			$postImage = $stmt->fetch();

			return $postImage;
	    } 

	    // Get a set amount of images or all of the images for a post
	     public function getImages($postId, $limit = null) {

	    	$sql = null;
	    	if($limit) {
	    		$sql = ' LIMIT ' . $limit;
	    	}

	    	$stmt = $this->conn->prepare('SELECT * FROM postImages WHERE postId = :postId ORDER BY imageOrder ASC' .$sql);
			$stmt->execute(['postId' => $postId]);

			$postImages = $stmt->fetchAll();

			return $postImages;
	    }

	    // Add images in the backend
	    public function addImage($postId, $imageName) 
	    {
	    	if($postId){
	    		if($imageName) 
	    		{
	    			$data = [
	    				'postId' => $postId,
	    				'imageName' => $imageName
	    			];
	    			$stmt = $this->conn->prepare('
	    				INSERT INTO postImages 
	    					(imageName, postId)
	    				VALUES
	    					(:imageName, :postId)
	    				');

	    			$addImage = $stmt->execute($data);

	    			if($addImage) 
	    			{
	    				return true;
	    			}
	    			else
	    			{
	    				return false;
	    			}
	    		}
	    		else 
	    		{
	    			return false;
	    		}
	    	} 
	    	else 
	    	{
	    		return false;
	    	}
	    }

	    // Resezie image
		public function resizeImage($filename, $maxWidth, $maxHeight) {
			

			

			return $new_image;
		}


	    // Edit the images caption
	    public function editImageText($imageId, $imageTitle) {
	    	$data = [
	    		'imageId' => $imageId,
	    		'imageTitle' => $imageTitle
	    	];

	    	$sql = '
	    		UPDATE postImages SET
	    			imageTitle = :imageTitle
	    		WHERE
	    			imageId = :imageId
	    		';
	    	$stmt = $this->conn->prepare($sql);
	    	$stmt->execute($data);

	    	return true;
	    }
	}
?>