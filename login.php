<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // To protect against SQL injection
    $email = stripslashes($email);
    $password = stripslashes($password);
    $email = $conn->real_escape_string($email);
    $password = $conn->real_escape_string($password);

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['md5_pass'])) {
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $row['id'];
            //$_SESSION['email'] = $email;
            header('Location: index.php');
            exit();
            
        } else {
            header('Location: signupindex.php');
            exit();
        }
    } 
}
?>
