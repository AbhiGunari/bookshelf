<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details Page</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color:#8c8cef;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        h1,
        p {
            margin-bottom: 10px;
        }

        .product-details {
            max-width: 600px;
            margin: auto;
        }

        .product-details img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
        }

        .product-details p {
            line-height: 1.5;
        }

        .bought-message {
            color: green;
            font-weight: bold;
        }

        .not-bought-message {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <?php
    if (isset($_GET['id'])) {
        $book_id = $_GET['id'];

        $db_host = "sellit.czk4caexf6nb.ap-south-1.rds.amazonaws.com";
        $db_user = "admin";
        $db_name = "sellit";
        $pass = "Abhishek2705";

        $conn = mysqli_connect($db_host, $db_user, $pass, $db_name);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Query to get book details
        $sql_book = "SELECT `name`, `writer`, `cost`, `description` FROM `items` WHERE `id` = $book_id";
        $result_book = mysqli_query($conn, $sql_book);

        if (mysqli_num_rows($result_book) > 0) {
            $row_book = mysqli_fetch_assoc($result_book);
            $name = $row_book["name"];
            $writer = $row_book["writer"];
            $cost = $row_book["cost"];
            $description = $row_book["description"];

            // Query to check if the product has been bought
            $sql_transaction = "SELECT `address` FROM `transactions` WHERE `itemname` = '$name'";
            $result_transaction = mysqli_query($conn, $sql_transaction);

            echo "<div class='container'>";
            echo "<div class='product-details'>";
            echo "<h1>$name</h1>";
            echo "<p>Author: $writer</p>";
            echo "<p>Price: $cost</p>";
            echo "<p>About: $description</p>";

            if (mysqli_num_rows($result_transaction) > 0) {
                $row_transaction = mysqli_fetch_assoc($result_transaction);
                $buyerAddress = $row_transaction["address"];
                echo "<p class='bought-message'>This product has been bought.</p>";
                echo "<p class='bought-message'>Buyer's Address: $buyerAddress</p>";
            } else {
                echo "<p class='not-bought-message'>This product has not been bought yet.</p>";
            }

            echo "</div>";
            echo "</div>";
        } else {
            echo "Book not found.";
        }

        mysqli_close($conn);
    } else {
        echo "Book ID not provided.";
    }
    ?>
</body>

</html>
