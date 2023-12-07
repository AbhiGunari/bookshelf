<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    $dbHost = "sellit.czk4caexf6nb.ap-south-1.rds.amazonaws.com";
    $dbUsername = "admin";
    $dbPassword = "Abhishek2705";
    $dbName = "sellit";

    $conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT `email`, `mobile`, `password` FROM users WHERE mobile = ? OR email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $mobile, $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $email2, $mobile2, $password_hash);
    mysqli_stmt_fetch($stmt);
    
    mysqli_stmt_close($stmt);   
    if ($password_hash !== null && password_verify($password, $password_hash) && $email2 == $email && $mobile2 == $mobile) {
        header("Location: search.php");
        $_SESSION['username']=$email2;
        exit();
    } 
    else
     {
        $loginError = "Invalid username/email or password";
        echo "Login error: " . $loginError;
    }

    mysqli_close($conn);
}
?>
