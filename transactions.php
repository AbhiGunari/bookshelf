<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Transaction Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f4f4f4;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
        }

        input,
        select {
            padding: 8px;
            margin-bottom: 16px;
        }

        button {
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Checkout</h1>
        <form action="transactions.php?name=<?php echo $_GET["name"]?> && id=<?php echo $_GET["id"]?>" method="post" id="checkoutForm">
            <label for="shippingAddress">Shipping Address:</label>
            <input type="text" name="address" id="shippingAddress" required>
            <label for="paymentMethod">Payment Method:</label>
            <select id="paymentMethod" name="pay" required>
                <option value="creditCard">Credit Card</option>
                <option value="cashOnDelivery">Cash on Delivery</option>
            </select>

            <button type="submit">Complete Purchase</button>
        </form>
    </div>

    <!-- <script>
        function processOrder() {
            const shippingAddress = document.getElementById('shippingAddress').value;
            const paymentMethod = document.getElementById('paymentMethod').value;

            if (!shippingAddress || !paymentMethod) {
                alert('Please fill in all fields.');
                return;
            }

            let confirmationMessage = `Order Confirmed!\n\nShipping Address: ${shippingAddress}\nPayment Method: ${paymentMethod}`;

            if (paymentMethod === 'cashOnDelivery') {
                confirmationMessage += '\n\nYou have chosen Cash on Delivery. Your order will be delivered soon.';
            } else {
                confirmationMessage += '\n\nThank you for your purchase. Your payment has been processed.';
            }

            alert(confirmationMessage);

        }

    </script> -->
</body>

</html>

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
    $itemName = $_GET["name"];
    $updateIsBoughtSql = "UPDATE items SET is_bought = true WHERE name = '$itemName'";
    $id=$_GET['id'];
    if (mysqli_query($conn, $updateIsBoughtSql)) {
        echo "is_bought status updated successfully!";
    } else {
        echo "Error updating is_bought status: " . mysqli_error($conn);
    }



    // $result = $conn->query("SELECT MAX(`id`) + 1 AS next_id FROM `transactions`");
    // if ($result && $row = $result->fetch_assoc()) {
    // $id = $row['next_id'];
    // $name= $conn->query('SELECT `name` FROM `books` WHERE `name` = $itemName');
    $stmt = $conn->prepare("INSERT INTO `transactions` (`id`,`email`,`itemname`,`address`) VALUES (?,?,?,?)");
    $stmt->bind_param("isss",$id, $email, $itemName, $address);

    if ($stmt->execute()) 
    {
        // echo "Transaction recorded successfully!";
        header("Location:final.html");
    } else 
    {
        echo "Error recording transaction: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

