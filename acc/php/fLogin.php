<?php session_start(); ?>
<?php include '../../config/config.php'; ?>
<?php include '../../classes/Database.php'; ?>
<?php include '../../classes/User.php'; ?>
<?php
    if (isset($_POST['login'])) {
        $username = $_POST['userName'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT * FROM users WHERE username=:username");
        $stmt->bindParam("username", $username, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$result) {
            echo '<p class="error">incorrect username or password</p>';
        } else {
            if (password_verify($password, $result['password'])) {
                $_SESSION['user_id'] = $result['userId'];
                header('Location: ' . URL_ROOT . '/acc/blog.php');
            } else {
                echo '<p class="error">Incorrect</p>';
            }
        }
    }
?>