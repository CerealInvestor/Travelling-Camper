<?php
	if(isset($_GET['recipeId'])) {
		$recipeId = $_GET['recipeId'];
	} else {
		$recipeId = false;
	}

	$recipe = new Recipes($pdo);
	$recipes = $recipe->getRecipes($recipeId);

	// get number of recipes in database
	// get a random recipeId between 1 and number of
	// FIX to check recipeId exists LATER

	$numberofRecipes = $recipe->numberofRecipes();
	$randomRecipeId = rand(1, $numberofRecipes);

	// Get recipe
	$randomRecipe = $recipe->getRecipes($randomRecipeId);
?>