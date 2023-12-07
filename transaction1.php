<?php
session_start();
$conn=mysqli_connect("sellit.czk4caexf6nb.ap-south-1.rds.amazonaws.com","admin","Abhishek2705","sellit");
if(!$conn){
    echo "mysqli_error()";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $address = $_POST["address"];
    $paymentMethod = $_POST["pay"];
    $email = $_SESSION["username"];  
    $itemName = $_GET['name'];
    $result = $conn->query("SELECT MAX(`id`) + 1 AS next_id FROM `transactions`");
    if ($result && $row = $result->fetch_assoc()) {
    $id = $row['next_id'];
    // $name= $conn->query('SELECT `name` FROM `books` WHERE `name` = $itemName');
    $stmt = $conn->prepare("INSERT INTO `transactions` (`id`,`email`,`itemname`,`address`) VALUES (?,?,?,?)");
    $stmt->bind_param("isss",$id, $email, $itemName, $address);

    if ($stmt->execute()) 
    {
        echo "Transaction recorded successfully!";
        // header("Location:final.html");
    } else 
    {
        echo "Error recording transaction: " . $stmt->error;
    }
    }

    $stmt->close();
    $conn->close();
}
?>
