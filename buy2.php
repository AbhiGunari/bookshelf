<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details</title>
    <link rel="stylesheet" href="buy2.css">
<body>
    <div class="book-details">
        <div class="book-image">
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

                $sql = "SELECT `name`, `writer`, `image`, `cost`,`description` FROM `items` WHERE `id` = $book_id";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $imageData = $row["image"];
                    $imageSrc = "data:image/jpg;base64," . base64_encode($imageData);

                    echo "<img src='$imageSrc' alt='Book Cover'>";
                } else {
                    echo "Book not found.";
                }

                mysqli_close($conn);
            } else {
                echo "Book ID not provided.";
            }
            ?>
        </div>
        <div class="book-info">
            <?php
            if (isset($_GET['id'])) {
                $book_id = $_GET['id'];
                $db_host = "localhost";
                $db_user = "root";
                $db_name = "sellit";
                $pass = "";

                $conn = mysqli_connect($db_host, $db_user, $pass, $db_name);

                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                $sql = "SELECT `name`, `writer`, `cost`,`description` FROM `items` WHERE `id` = $book_id";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $name = $row["name"];
                    $writer = $row["writer"];
                    $cost = $row["cost"];
                    $imagedes=$row["description"];

                    echo "<h1>$name</h1>";
                    echo "<p>Author: $writer</p>";
                    echo "<p>Price: $cost</p>";
                    echo "<p>About:$imagedes</p>";
                    echo "<a class='buy-button' href='transactions.php?id=$book_id && name=$name' style='text-decoration:none;'>Buy</a>";
                } 
                else {
                    echo "Book not found.";
                }
            }
            ?>
        </div>
    </div>
<div id="belowcont">
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

        $sql_author = "SELECT `writer` FROM `items` WHERE `id` = $book_id";
        $result_author = mysqli_query($conn, $sql_author);

        if (mysqli_num_rows($result_author) > 0) {
            $row_author = mysqli_fetch_assoc($result_author);
            $writer = $row_author["writer"];

            // Query to select books by the same author
            $sql2 = "SELECT `id`,`name`,`writer`,`image`,`cost` FROM `items` WHERE `writer` = '$writer' AND `id` <> '$book_id'";
            $result2 = mysqli_query($conn, $sql2);

            if (mysqli_num_rows($result2) > 0) {
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    $id2 = $row2["id"];
                    $name2 = $row2["name"];
                    $writer2 = $row2["writer"];
                    $cost2 = $row2["cost"];
                    $imageData2 = $row2["image"];
                    $imageSrc2 = "data:image/jpg;base64," . base64_encode($imageData2);

                    echo "<div id='box'>";
                    echo "<a href='buy2.php?id=$id2' id='imageDiv$id2' class='image-div'>";
                    echo "<img src='$imageSrc2' alt='Image $id2'> ";
                    echo "<div id='cont'>";
                    echo "<h5 id='cont1' class='name'>$name2</h5>";
                    echo "<h5 id='cont4' class='name'>$writer2</h5> ";
                    echo "<h5 id='cont2' class='name'>$cost2</h5> <br>";
                    echo "</div>";
                    echo "</a><br>";
                    echo "</div>";
                }
            } else {
                echo "No other books by this author found in the database.";
            }
        } else {
            echo "Book not found.";
        }

        mysqli_close($conn);
    }
    ?>
</div>

</body>
</html>
