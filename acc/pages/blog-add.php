<div class="blogTitle"><h2>Blog Add</h2></div>
<div class="linkButton"><a href="blog.php">Back to Posts</a></div>
<div class="content">
	<form method="post">
		<label for="postTitle">Title</label><br />
		<input type="text" id="postTitle" name="postTitle"><br>

		<label for="postLocation">Location</label><br />
		<input type="text" id="postLocation" name="postLocation"><br>

		<label for="slug">Slug</label><br />
		<input type="text" id="slug" name="slug"><br>

		<label for="postCountry">Country</label><br />
		<input type="text" id="postCountry" name="postCountry"><br>

		<label for="lat">Latitude</label><br />
		<input type="text" id="lat" name="lat"><br>

		<label for="longitude">Longitude</label><br />
		<input type="text" id="lon" name="lon"><br>
		

		Content<br />
		<!-- Create the editor container -->
		<div id="postContent" name="postContent">
		
		</div><br/>
		

		<label for="postBlurb">Blurb</label><br />
		<input type="text" id="postBlurb" name="postBlurb"><br>

		<label for="postType">Type</label><br />
		<select name="postType">
			<option value="blog">Blog</option>
			<option value="article">Article</option>
		</select><br />


		<label for="postMiles">Miles</label><br />
		<input type="text" id="postMiles" name="postMiles"><br>

		<input type="submit" name="addPost">
	</form>