<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in window</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div id="container">
    <div id="a" class="con">    </div>   
    <div id="b" class="con">Login</div>
    <div id="c" class="con"> Continue to explore</div>
    <div id="d" class="con">
    <form action="login.php" method="post">
        <input id="mail"  type="email" placeholder="Enter Email" name="email" required>
        <input type="tel" id="mobile" maxlength="10" placeholder="Enter mobile number" name="mobile" required>
        <input id="pwd" type="password" placeholder="Enter the Password" name="password" required>
        <button id="sub" type="submit" placeholder="Submit" name="submit" value="submit">Submit </button>

</php

$db_host = "sellit.czk4caexf6nb.ap-south-1.rds.amazonaws.com";
        $db_user = "admin";
        $db_name = "sellit";
        $pass = "Abhishek2705";

        $conn = mysqli_connect($db_host,$db_user,$pass,$db_name);

        $sql_book = "SELECT `name` FROM users WHERE `id` = `2`";
        $result= mysqli_query($conn,$sql_book);

        echo $result;

?>
    </form>
    </div>
    <div id="e" class="con"> New to BookShelf? <a href="register.html"> Crete Account </a> </div>
    </div>
</body>
</html>