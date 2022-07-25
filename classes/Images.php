<?php
	Class Images {
		private $conn;

		// pass the database connection to class
		// Dependency injection needed in all classes requiring a connection to db

	    /* Get database access */
	    public function __construct(\PDO $pdo) {
	        $this->conn = $pdo;
	    }

	    /* List all Categories */
	    public function getI() {
	    
	    }

	   
	}
?>