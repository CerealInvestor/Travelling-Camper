<div class="blogTitle"><h2>Blog list</h2></div>
<div class="linkButton"><a href="blog.php?page=add">Add Post</a></div>
<div class="content">
<table>
	<tr>
		<th>&nbsp;</th>
		<th>&nbsp;</th>
	</tr>
	<?php
		foreach($posts as $post){
	?>
		<tr>
			<td><?php echo $post['postTitle']; ?></td>
			<td><a href="blog.php?page=edit&postId=<?php echo $post['postId']; ?>">edit</a></td>
			<td>
				<?php
					if($post['deleted'] == 1) {
						echo 'draft';
					} else {
						echo 'live';
					}
				?>
			</td>
		</tr>
	<?php
		}
	?>
</table>
</div>