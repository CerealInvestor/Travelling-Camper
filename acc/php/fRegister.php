<?php session_start(); ?>
<?php include '../../config/config.php'; ?>
<?php include '../../classes/Database.php'; ?>
<?php include '../../classes/User.php'; ?>
<?php
    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $userEmail = $_POST['userEmail'];
        $password = $_POST['password'];
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        
        $stmt = $pdo->prepare("SELECT * FROM users WHERE userEmail=:userEmail");
        $stmt->bindParam("userEmail", $userEmail, PDO::PARAM_STR);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            echo '<p class="error">The email address is already registered!</p>';
        }
        if ($stmt->rowCount() == 0) {
            $stmt = $pdo->prepare("INSERT INTO users(username,password,userEmail) VALUES (:username,:password_hash,:userEmail)");
            $stmt->bindParam("username", $username, PDO::PARAM_STR);
            $stmt->bindParam("password_hash", $password_hash, PDO::PARAM_STR);
            $stmt->bindParam("userEmail", $userEmail, PDO::PARAM_STR);
            $result = $stmt->execute();
            if ($result) {
                header('Location: ' . URL_ROOT . 'acc/login.php?page=login');
            } else {
                echo '<p class="error">Something went wrong!</p>';
            }
        }
    }
?>