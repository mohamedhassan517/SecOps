<?php
session_start();
include 'db_connect.php';


function sanitizeInput($input) {
    return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['fname'];
    
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeat_password = $_POST['repeat_password'];

    $fname = sanitizeInput($_POST['fname']);
    $lname = sanitizeInput($_POST['lname']);
    $email = sanitizeInput($_POST['email']);
if ($password !== $repeat_password) {
                // Redirect back to signup form with error message
        header("Location: signupindex.php?error=password_mismatch");
        exit();
    }
if (!isPasswordComplex($password)) {
        header('Location: signupindex.php?error=password_complexity');
        exit();
    }
$sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
 header("Location: signupindex.php?error=email_existed");
        exit();
}
    else{
  // To protect against SQL injection
    $fname = $conn->real_escape_string($fname);
    $lname = $conn->real_escape_string($lname);
    $email = $conn->real_escape_string($email);
    $password = $conn->real_escape_string($password);

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data into the database
    $sql = "INSERT INTO users (f_name, l_name, email, md5_pass) VALUES ('$fname', '$lname', '$email', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        header('Location: index.php#log');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
   } 
}
}
function isPasswordComplex($password) {
    // Check if password contains at least one character, one number, and one special character
    return strlen($password) > 8 && preg_match('/[A-Za-z]/', $password) && preg_match('/\d/', $password) && preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password);
}
?>
