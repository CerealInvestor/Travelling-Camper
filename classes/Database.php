<?php

	$dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
	  
	$opt = [
	    \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
	    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
	    \PDO::ATTR_EMULATE_PREPARES   => false,
	];
	$pdo = new \PDO($dsn, DB_USER, DB_PASS);
/*
	class Database {
	    
	    protected $pdo;

	    private $dbHost = DB_HOST;
		private $dbUser = DB_USER;
		private $dbPass = DB_PASS;
		private $dbName = DB_NAME;

	    public function __construct() {
	        $default_options = [
	            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	            PDO::ATTR_EMULATE_PREPARES => false,
	            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	        ];

	        $options = array_replace($default_options, $default_options);
	        $dsn = 'mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName . ';charset=utf8mb4';
	        	echo 'connected';

	        try {
	            $this->pdo = new \PDO($dsn, $this->dbUser, $this->dbPass, $default_options);
	        } catch (\PDOException $e) {
	            throw new \PDOException($e->getMessage(), (int)$e->getCode());
	        }
	    }

	    public function query($sql, $args = NULL) {
	        if (!$args) {
	            return $this->pdo->query($sql);
	        }

	        $stmt = $this->pdo->prepare($sql);
	        $stmt->execute($args);

	        return $stmt;
	    }
	}
?>

<?php
	/*Class Database {
		private $dbHost = DB_HOST;
		private $dbUser = DB_USER;
		private $dbPass = DB_PASS;
		private $dbName = DB_NAME;

		private $statement;
		private $db;
		private $error;

		public function __construct(){

			$conn = 'mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName;

			// prevents timesout and crashes
			$options = array(
				PDO::ATTR_PERSISTENT => true,
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
			);

			try {
			     return $pdo = new \PDO($conn, $this->dbUser, $this->dbPass, $options);
			} catch (\PDOException $e) {
			     throw new \PDOException($e->getMessage(), (int)$e->getCode());
			}

		}
	}*/
?>