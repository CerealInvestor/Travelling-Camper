<?php
	class User {
		private $conn;

		public function __construct(\PDO $pdo) {
	        $this->conn = $pdo;
	    }

		public function getUsers() {
			$this->db->query("SELECT * FROM users");

			$result = $this->db->resultSet();
			return $result;
		}

		public function login($user, $password) {

			// Set sessions
			$_SESSION['loggedIn'] = true;
			$_SESSION['user'] = $user;
			$_SESSION['agent'] = $_SERVER['HTTP_USER_AGENT'];

		}

		public function isLoggedIn() {

			if(isset($_SESSION['user'])){
				$user = $_SESSION['user'];
				$_SESSION['userId'] = 1;

				return true;
			
			} else {
				//header('Location: index.php?login=0');
				
				return false;
			}
		}

		public function addNewsletter($email) 
		{
			$data = [
	    		'email' => $email
	    	];

	    	$sql = '
	    		INSERT INTO newsletter 
	    			(nEmail)
	    		VALUES
	    			(:email)
	    		';
	    	$stmt = $this->conn->prepare($sql);
	    	$stmt->execute($data);

	    	return true;
		}
	}
?>