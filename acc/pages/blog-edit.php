<div class="blogTitle"><h2>Editing: <br /><?php echo $post['postTitle']; ?></h2></div>
<div class="linkButton"><a href="blog.php">Back to Posts</a></div>
<div class="content">
	<form method="post">
		<label for="postTitle">Title</label><br />
		<input type="text" id="postTitle" name="postTitle" value="<?php echo $post['postTitle']; ?>"><br>

		<label for="postLocation">Location</label><br />
		<input type="text" id="postLocation" name="postLocation" value="<?php echo $post['postLocation']; ?>"><br>

		<label for="slug">Slug</label><br />
		<input type="text" id="slug" name="slug" value="<?php echo $post['slug']; ?>"><br>

		<label for="postCountry">Country</label><br />
		<input type="text" id="postCountry" name="postCountry" value="<?php echo $post['postCountry']; ?>"><br>

		<label for="lat">Latitude</label><br />
		<input type="text" id="lat" name="lat" value="<?php echo $post['lat']; ?>"><br>

		<label for="longitude">Longitude</label><br />
		<input type="text" id="lon" name="lon" value="<?php echo $post['lon']; ?>"><br>
		

		Content<br />
		<!-- Create the editor container -->
		<div id="postContent" name="postContent">
			<?php echo $post['postContent']; ?>
		</div><br/>
		

		<label for="postBlurb">Blurb</label><br />
		<input type="text" id="postBlurb" name="postBlurb" value="<?php echo $post['postBlurb']; ?>"><br>

		<label for="postType">Type</label><br />
		<select name="postType">
			<option value="blog"<?php if($post['postType'] == 'blog'){ echo 'selected="selected"';} ?>>Blog</option>
			<option value="article"<?php if($post['postType'] == 'article'){ echo 'selected="selected"';} ?>>Article</option>
		</select><br />


		<label for="postMiles">Miles</label><br />
		<input type="text" id="postMiles" name="postMiles" value="<?php echo $post['postMiles']; ?>"><br>

		<input type="hidden" id="postId" name="postId" value="<?php echo $post['postId']; ?>">

		<input type="submit" name="editPost">
	</form>
	<h1>Image Uploading</h1>
	<form method="post" enctype="multipart/form-data" name="postImageUploader">
		<label for="files">Select files to upload</label>
		<input type="file" name="files[]" multiple="multiple" />
		<input type="hidden" name="postId" value="<?php echo $postId; ?>"  />
		<input type="submit" name="postImageUpload" />
	</form>

	<?php 
		if($post['postImages']) 
		{
			foreach($post['postImages'] as $image)
			{
				echo '<img src="../images/blog/' . $image['imageName'] . '" style="width: 150px;" /><br />';
			}
		} 
	?>
</div>