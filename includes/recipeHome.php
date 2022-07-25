<div class="rightAreaContainer"">
	<div class="rightArea">
		<h2>Camper Recipe</h2>
		<h3><?php echo $randomRecipe['recipeTitle']; ?></h3>
		<img src="<?php echo RECIPE_IMAGE ?><?php echo $randomRecipe['recipeImage']; ?>" alt="Travelling Camper <?php echo $randomRecipe['recipeTitle']; ?> Recipe" class="recipeImage" /><br />
		<a href="camper-recipes.php?recipeId=<?php echo $randomRecipe['recipeId']; ?>">click here to read...</a>
	</div>
</div>