<?php
	$recipe = new Recipes($pdo);

	$recipes = $recipe->getRecipes();
?>