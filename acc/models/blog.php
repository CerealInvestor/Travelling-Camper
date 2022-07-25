<?php

 		function thumbnail($image, $max_width, $max_height) {
            $img = new Imagick($image);
            $img->thumbnailImage($max_width, $max_height, TRUE);
            return $img;
        }

        function normalImage($image) {
        	$max_width  = 2000;
			$max_height = 1200;
			$im = new Imagick($image);
			$im->resizeImage(
			    min($im->getImageWidth(),  $max_width),
			    min($im->getImageHeight(), $max_height),
			    imagick::FILTER_CATROM,
			    1,
			    true
			);

            return $im;
        }
	
	// get page from url
	$page = isset($_GET['page']) ? $_GET['page'] : '';

	//instantiate a new blog instance
	$blog = new Blog($pdo);

	// adding a post
	if(isset($_POST['addPost'])) 
	{
		$postId = null;
		$postTitle = $_POST['postTitle'];
		$postCountry = $_POST['postCountry'];
		$postContent = $_POST['postContent'];
		$postLocation = $_POST['postLocation'];
		$postBlurb = $_POST['postBlurb'];
		$lon = $_POST['lon'];
		$lat = $_POST['lat'];
		$postMiles = $_POST['postMiles'];
		$postType = $_POST['postType'];
		$slug = $_POST['slug'];
		$deleted = 0;

		$addPost = $blog->editPost('add', $postTitle, $postContent, $postCountry, $postLocation, $postBlurb, $lat, $lon, $postMiles, $postType, $slug, $deleted);

		// Add latest activity
		$activityTitle = $postLocation . ' ' . ADD_BLOG_ACTIVITY_TEXT;
		$activityLink = SLUG_FOLDER . $slug;
		$addActivity = $blog->addActivity($activityTitle, $activityLink);


		if($addPost) 
		{
			header('Location: ' . CMS_ROOT . 'blog.php?page=edit&postId=' . $addPost);
		}
	} 

	// Editing a post
	if(isset($_POST['editPost'])) 
	{
		$postId = $_POST['postId'];
		$postTitle = $_POST['postTitle'];
		$postCountry = $_POST['postCountry'];
		$postContent = $_POST['postContent'];
		$postLocation = $_POST['postLocation'];
		$postBlurb = $_POST['postBlurb'];
		$lon = $_POST['lon'];
		$lat = $_POST['lat'];
		$postMiles = $_POST['postMiles'];
		$postType = $_POST['postType'];
		$slug = $_POST['slug'];
		$deleted = 0;

		$editPost = $blog->editPost('edit', $postTitle, $postContent, $postCountry, $postLocation, $postBlurb, $lat, $lon, $postMiles, $postType, $slug, $deleted, $postId);

		// Add latest activity
		$activityTitle = $postLocation . ' ' . EDIT_BLOG_ACTIVITY_TEXT;
		$activityLink = SLUG_FOLDER . $slug;
		$addActivity = $blog->addActivity($activityTitle, $activityLink);

		if($editPost) 
		{
			echo '<div class="success">Post has been updated</div>';
		}
	} 

	// Image upload
	if(isset($_POST['postImageUpload'])) 
	{
		// Get the postId
		$postId = $_POST['postId'];
		//Set variables
		$errors = array();
		$uploadedFiles = array();

		// Valid file extensions
		$extension = array("jpeg","jpg","png","gif");

		// File sizes
		$bytes = 1024;
		$KB = 1024;
		$totalBytes = $bytes * $KB;

		// Set max size of image to 10mb
		$maxSizeBytes = $totalBytes * 10;

		//set folder to upload to
		$UploadFolder = '../images/blog';
		$compressedFolder = '../images/blog/compressed/';
		 
		$counter = 0;
		
		// loop through all temp image files selected with multiple
		foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name){
		    $temp = $_FILES["files"]["tmp_name"][$key];
		    $name = $_FILES["files"]["name"][$key];

		     
		    if(empty($temp))
		    {
		        break;
		    }
		     
		    $counter++;
		    $UploadOk = true;
		     
		    // Check filesize is not above 10mb
		    if($_FILES["files"]["size"][$key] > $maxSizeBytes)
		    {
		        $UploadOk = false;
		        array_push($errors, $name." file size is larger than the 10 MB.");
		    }
		    
		    // Get the extention and check if it is allowed
		    $ext = pathinfo($name, PATHINFO_EXTENSION);
		    if(in_array($ext, $extension) == false){
		        $UploadOk = false;
		        array_push($errors, $name." invalid file type.");
		    }
		    
		    /* Check if the file already exists
		    if(file_exists($UploadFolder."/".$name) == true){
		        $UploadOk = false;
		        array_push($errors, $name." file already exist.");
		    }*/
		     
		    // Upload the files
		    if($UploadOk == true){
		       	move_uploaded_file($temp,$UploadFolder."/".$name);


		       	$image = $UploadFolder . '/' . $name;


    //Get original dimensions
    list($width, $height, $type, $attr) = getimagesize($image);
    echo "<BR>";
    echo "ORIGINAL:";
    echo "<BR>";
    echo "Image width $width";
    echo "<BR>";
    echo "Image height " .$height;



      $max_height = 800;
        $max_width = 1000;

     // orginal line    thumbnail($image, $max_width, $max_height);
    $img=thumbnail($image, $max_width, $max_height);
    file_put_contents('../images/blog/thumbs/tn_' . $name, $img );

	$img1=normalImage($image);
    file_put_contents('../images/blog/' . $name, $img1 );


		       //	$blog->compressImage($name, $compressedFolder, 60);
		       	//$check = $blog->resizeImage($thumbFile, 300, 200);
		       	
		       	// Add files to the database using the blog class method
		       	$blog->addImage($postId, $name);
		        array_push($uploadedFiles, $name);
		    }
		}
		
		// If an image has been uploaded
		if($counter>0){
			// if errors list them
		    if(count($errors)>0)
		    {
		    	echo '<div class="error">';
			        echo "<b>Errors:</b>";
			        echo "<br/><ul>";
			        foreach($errors as $error)
			        {
			            echo "<li>".$error."</li>";
			        }
			        echo "</ul><br/>";
			   	echo '</div>';
		    }
		     
		    if(count($uploadedFiles)>0)
		    {
		    	echo '<div class="success">';
			        echo "<b>Uploaded Files:</b>";
			        echo "<br/><ul>";
			        foreach($uploadedFiles as $fileName)
			        {
			            echo "<li>".$fileName."</li>";
			        }
			        echo "</ul><br/>";
			         
			        echo count($uploadedFiles)." file(s) are successfully uploaded.";
			   	echo '</div>';
		    }                         
		}
		else
		{
		    echo "Please, Select file(s) to upload.";
		}
	}

	// Get a list of images
	$imageList = $blog->getImageList();

	if($page == 'edit-caption') 
	{
		$imageId = $_GET['imageId'];
		$imageContent = $blog->getImage($imageId);


		if(isset($_POST['editImageText'])) 
		{
			$imageTitle = $_POST['imageTitle'];

			$editImage = $blog->editImageText($imageId, $imageTitle);

			if($editImage) 
			{
				header('Location: ' . CMS_ROOT . 'blog.php?page=edit-caption&imageId=' . $_GET['imageId'] . '&error=0');
			} else {
				header('Location: ' . CMS_ROOT . 'blog.php?page=edit-caption&imageId=' . $_GET['imageId'] . '&error=1');
			}
		}
	}

	// check to see if page is defined
	// check what the page is before returning functions
	if($page == '') 
	{
		// Display list of posts
		$posts = $blog->getPostList(null, 'blog');
	} elseif($page == 'edit') 
	{
		$postId = $_GET['postId'];
		// If an id exists return the post
		if($postId)
		{
			$post = $blog->getPost($postId, 'blog');

			// more code for the blogid selected

		}
	}

?>

