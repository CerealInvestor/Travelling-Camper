<?php
	Class Recipes {
		private $conn;

		// pass the database connection to class
		// Dependency injection needed in all classes requiring a connection to db

	    /* Get database access */
	    public function __construct(\PDO $pdo) {
	        $this->conn = $pdo;
	    }

		public function getRecipes($recipeId = null) {

			if($recipeId) {
				// Fetch the recipe first from database
				$stmt = $this->conn->prepare('SELECT * FROM recipes WHERE recipeId = :recipeId');
				$stmt->execute(['recipeId' => $recipeId]);
				/*$stmt = $this->conn->prepare('
					SELECT * FROM 
						recipes, recipeIngredients
					WHERE 
						recipes.recipeId = recipeIngredients.recipeId
					AND
						recipes.recipeId = :recipeId');
				$stmt->execute(['recipeId' => $recipeId]);
				*/
				$recipes = $stmt->fetch();

				// Now fetch all the ingredients and set them in the array under Ingredients
				$stmt = $this->conn->prepare('SELECT * FROM recipeIngredients WHERE recipeId = :recipeId');
				$recipeIngredients = $stmt->execute(['recipeId' => $recipeId]);

				$recipes['ingredients'] = $recipeIngredients = $stmt->fetchAll();

				$recipes['steps'] = $this->getSteps($recipeId);
			} else {
				$stmt = 'SELECT * FROM recipes WHERE deleted <> 1';

				$recipes = $this->conn->query($stmt)->fetchAll();
			}

	    	return $recipes;
		}

		public function getSteps($recipeId) {
			$stmt = $this->conn->prepare('SELECT * FROM recipeSteps WHERE recipeId = :recipeId');
			$recipeSteps = $stmt->execute(['recipeId' => $recipeId]);

			$recipeSteps = $stmt->fetchAll();

			return $recipeSteps;
		}

		public function numberofRecipes(){
			$numberofRecipes = $this->conn->query('select count(*) from recipes')->fetchColumn(); 
			return $numberofRecipes;
		}
	}
?>