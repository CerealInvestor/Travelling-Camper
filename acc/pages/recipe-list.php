<h2>Recipe list</h2>
<a href="recipes.php?page=add">Add Recipe</a>
<table class="accList">
	<tr>
		<th>&nbsp;</th>
		<th>&nbsp;</th>
	</tr>
	<?php print_r($recipes); ?>
	<?php
		foreach($recipes as $recipe){
	?>
		<tr>
			<td><?php echo $recipe['recipeTitle']; ?></td>
			<td><a href="recipes.php?page=edit&recipeId=<?php echo $recipe['recipeId']; ?>">edit</a></td>
			<td>
				<?php
					if($recipe['deleted'] == 1) {
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