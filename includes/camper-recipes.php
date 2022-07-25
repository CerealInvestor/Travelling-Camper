<div id="homeContent">
	<div class="content">
	<?php
		if(!$recipeId) {
			echo '<div class="flex-content">';
			echo '<h1>Camper Recipes</h1>';
			echo '<p>Soon you will be able to find some of our best and worst recipes made soley in the camper.</p>';
			echo '<ul>';
			foreach($recipes as $recipe) {				
				echo '<li>';
					echo '<a href="camper-recipes.php?recipeId=' . $recipe['recipeId'] . '">';
						echo $recipe['recipeTitle'];
					echo '</a>';
				echo '</li>';
			}
			echo '</ul>';
			echo '</div>';
		} else {
		?>		
			<div class="flex-content">
				<h2>Method</h2>
				<?php
					foreach($recipes['steps'] as $step){
						echo '<h3>Step ' . $step['stepNo'] . '</h3>';
						echo '<p>' . $step['stepDesc'] . '</p>';
					}
				?>
			</div>		
			<div class="flex-content">
			<?php				
				echo '<img src="' . RECIPE_IMAGE . $recipes['recipeImage'] . '" alt="Travelling Camper ' .$recipes['recipeTitle'] . ' Recipe" class="recipeImage" /><br />';
			?>
			</div>	
			<div class="flex-content">
				<?php echo '<div class="recipeIngredientsContainer"><a href="camper-recipes.php">back to recipes</a></div>'; ?>
				<?php
					echo '<h2>';
						echo $recipes['recipeTitle'];
					echo '</h2>';
					echo '<p>' . $recipes['recipeDesc'] . '</p>';
				?>
				<div class="recipeIngredientsContainer">
					<ul class="recipeIngredients">
						<li><h3>Ingredients</h3></li>
						<?php
							foreach($recipes['ingredients'] as $ingredient){
								echo '<li>';
									echo $ingredient['ingredientAmount'] . ' ' . $ingredient['ingredientName'];
								echo '</li>';
							}
						?>
					</ul>
				</div>
			</div>					
			<?php
			}
			?>
	</div>
</div>