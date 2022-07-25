<?php 
	if(isset($_GET['error'])) {
		if($_GET['error'] == 0) {
			echo '<div class="success">Updated successfully.</div>';
		}
		if($_GET['error'] == 1) {
			echo '<div class="error">An error occured.</div>';
		}
	}
?>
<div class="blogTitle"><h2>Image Caption Editing List</h2></div>
<div class="linkButton"><a href="<?php echo CMS_ROOT; ?>blog.php?page=edit-caption-list">back to list</a></div>
<div class="content">
	<?php 
		if(isset($page) && $page = 'edit-caption') {
			echo '<img src="../images/blog/' . $imageContent['imageName'] . '" style="width: 250px;" />';
	?>
		<form action="<?php echo CMS_ROOT . 'blog.php?page=edit-caption&imageId=' . $imageContent['imageId']; ?>" method="post">
			<input type="text" name="imageTitle" value="<?php echo $imageContent['imageTitle']; ?>">
			<input type="hidden" value="<?php echo $imageContent['imageId']; ?>">
			<input type="submit" name="editImageText" value="Update" />
		</form>
	<?php
		}
	?>
</div>