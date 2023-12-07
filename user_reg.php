<?php
$server = "sellit.czk4caexf6nb.ap-south-1.rds.amazonaws.com";
$user = "admin";
$password = "Abhishek2705";
$database = "sellit";
$successMessage = ""; 

$conn = mysqli_connect($server, $user, $password, $database);

if (!$conn) {
    die("Reason for not connecting is: " . mysqli_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mobile = $_POST['mobile'];
    $pass = $_POST['pwd'];
    $cnfpass = $_POST['cpwd'];
    $password=password_hash($pass, PASSWORD_DEFAULT);
 
        if ($pass != $cnfpass) {
            $errorMessages[] = "Password and Confirm Password do not match.";
        }
        if (strlen($mobile) != 10) {
            $errorMessages[] = "Mobile number must be 10 digits.";
        }
    
    if (!empty($errorMessages)) {
        foreach ($errorMessages as $error) {
            echo '<p>' . $error . '</p>';
        }
    }


    if ($pass == $cnfpass && isset($mobile) && isset($email) && strlen($mobile) == 10) {
        $result = $conn->query("SELECT MAX(`user_id`) + 1 AS next_id FROM `users`");
        if ($result && $row = $result->fetch_assoc()) {
            $nextId = $row['next_id'];
         $stmt = mysqli_prepare($conn, "INSERT INTO `users`(`user_id`,`EMAIL`, `FNAME`, `LNAME`, `MOBILE`,`password`) VALUES (?,?, ?, ?, ?,?)");
           mysqli_stmt_bind_param($stmt, "isssss",$nextId, $email, $fname, $lname, $mobile,$password);


        if (mysqli_stmt_execute($stmt) ) {
            $successMessage = "Registration successful! You can now login.";
            header("Location: index.html?message=".urlencode($successMessage));
            exit();
                } 
        else {
            $successMessage = "Registration failed.";
        }

        mysqli_stmt_close($stmt);
    } 
}
    else {
        $successMessage = "Input values are not correct.";
    }
}

mysqli_close($conn);
?>











<!-- $mobile=$_POST["number2"];
$password=$_POST["psw2"];
$cnf_password=$_POST["cnfpsw2"];
if($password==$cnf_password){ 
 $sql="INSERT INTO `retail`.`register`(`mobile`,`pass_word`,`cnf_pass_word`) VALUES ('$mobile','$password','$cnf_password')";
}
else{
    echo "password doesn't match";
}
if($conn->query($sql)){
    echo "<h3> registered successfully </h3>";
    header("Location:mainpage3.php");
}
else{
    echo "mysqli_error()";
}
$conn->close();
?>  -->