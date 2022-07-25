<div class="blogTitle"><h2>Image Caption Editing List</h2></div>
<div class="linkButton"><a href="blog.php">Back to Posts</a></div>
<div class="content">
	<table>
		<tr>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>

		<?php
			if($imageList) {

				foreach($imageList as $image){
		?>
				<tr>
					<td><?php echo $image['imageName']; ?></td>
					<td><a href="blog.php?page=edit-caption&imageId=<?php echo $image['imageId']; ?>">edit</a></td>
				</tr>
		<?php
				}
			}
		?>
	</table>
</div>