<?php
	Class News {
		private $conn;

		// pass the database connection to class
		// Dependency injection needed in all classes requiring a connection to db

	    /* Get database access */
	    public function __construct(\PDO $pdo) {
	        $this->conn = $pdo;
	    }

	    public function getLatestActivity($limit){
			$stmt = $this->conn->prepare('SELECT * FROM activity WHERE deleted = :deleted ORDER BY activityDate DESC, activityId DESC LIMIT 3');
			$stmt->execute(['deleted' => 0]);

			$news = $stmt->fetchAll();
			
		    return $news;
		}
	}
?>