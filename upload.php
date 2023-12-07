 <?php
// session_start();
// if ($_SERVER["REQUEST_METHOD"] === "POST") {
//     $dbHost = "localhost";
//     $dbUser = "root";
//     $dbName = "sellit";
//     $pass = "";
//     $conn = new mysqli($dbHost, $dbUser, $pass, $dbName);

//     if ($conn->connect_error) {
//         die("Connection failed: " . $conn->connect_error);
//     }
//         $seller_email = $_SESSION["username"];
//         $name = $_POST['name'];
//         $cost = $_POST['cost'];
//         $writer = $_POST['writer'];
//         $desc = $_POST['description'];
//         $item=$_POST['submit_type'];
//         echo $item;

//         if (!empty($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
//             $result = $conn->query("SELECT MAX(`id`) + 1 AS next_id FROM `books`");
//             if ($result && $row = $result->fetch_assoc()) {
//                 $nextId = $row['next_id'];

//                 $imageData = file_get_contents($_FILES["image"]["tmp_name"]);

//                 $stmt = $conn->prepare("INSERT INTO `books`(`id`,`name`,`cost`,`writer`,`description`,`image`,`seller_email`) VALUES (?,?,?,?,?,?,?)");
//                 $stmt->bind_param("isissss", $nextId, $name, $cost, $writer, $desc, $imageData, $seller_email);
//                 if ($stmt->execute()) {
//                     echo "Book uploaded successfully for selling <br>";
//                     echo "Go to home: ";
//                     echo "<a href='search.php' style='text-decoration:none'>home</a>";
//                 } 
//                 else {
//                     echo "Error uploading image: " . $stmt->error;
//                 }
//                 $stmt->close();
//             }
//         } 
//         else {
//             $result = $conn->query("SELECT MAX(`id`) + 1 AS next_id FROM `books`");
//             if ($result && $row = $result->fetch_assoc()) {
//                 $nextId = $row['next_id'];

//                 $stmt = $conn->prepare("INSERT INTO `books`(`id`,`name`,`cost`,`writer`,`description`,`seller_email`) VALUES (?,?,?,?,?,?)");
//                 $stmt->bind_param("isisss", $nextId, $name, $cost, $writer, $desc, $seller_email);
//                 if ($stmt->execute()) {
//                     echo "Book uploaded successfully for Selling <br>";
//                     echo "Go to home: ";
//                     echo "<a href='search.php' style='text-decoration:none'>home</a>";
//                 } 
//                 else {
//                     echo "Error uploading image: " . $stmt->error;
//                 }
//                 $stmt->close();
//             }
//         } 
//     $conn->close();
// }
?> 



 <?php
// session_start();
// if ($_SERVER["REQUEST_METHOD"] === "POST") {
//     $dbHost = "localhost";
//     $dbUser = "root";
//     $dbName = "sellit";
//     $pass="";

//     $name=$_POST['name'];
//     $cost=$_POST['cost'];
//     $writer=$_POST['writer'];
//     $desc=$_POST['description'];
//     $seller_email=$_SESSION["username"];
//     $conn = new mysqli($dbHost, $dbUser, $pass,$dbName);

//     if ($conn->connect_error) {
//         die("Connection failed: " . $conn->connect_error);
//     }

//     if (isset($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
//         $result = $conn->query("SELECT MAX(`id`) + 1 AS next_id FROM `books`");
//         if ($result && $row = $result->fetch_assoc()) {
//         $nextId = $row['next_id'];

//         $imageData = file_get_contents($_FILES["image"]["tmp_name"]);
//         $imageType = $_FILES["image"]["type"];

//         $stmt = $conn->prepare("INSERT INTO `books` (`id`,`name`,`cost`,`writer`,`description`,`image`,`seller_email`) VALUES (?,?,?,?,?,?,?)");
//         $stmt->bind_param("isissss",$nextId,$name,$cost,$writer,$desc, $imageData,$seller_email);
//         if ($stmt->execute()) {
//             echo "Image uploaded successfully! <br>";
//             echo "Go to home: ";
//             echo "<a href='search.php' style='text-decoration:none'>home</a>";

//         } else 
//         {
//             echo "Error uploading image: " . $stmt->error;
//         }

        
//         }



//         $stmt->close();
//         $conn->close();
//     } else {
//         echo "Error uploading image.";
//     }
// }
?> 


<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $dbHost = "sellit.czk4caexf6nb.ap-south-1.rds.amazonaws.com";
    $dbUser = "admin";
    $dbName = "sellit";
    $pass = "Abhishek2705";
    $conn = new mysqli($dbHost, $dbUser, $pass, $dbName);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $seller_email = $_SESSION["username"];
    $itemType = $_POST['item'];

    $writer = "";
    $desc = "";
    $expiry_date = "";

    $name = $_POST['name'];
    $cost = $_POST['cost'];
    $desc = $_POST['description'];
    if ($itemType === 'book')
     {
        $writer = $_POST['writer'];
    } 
    elseif ($itemType === 'medicine') {
        $expiry_date = $_POST['expiry_date'];
    } 
    else {
        echo "Invalid item type";
        exit;
    }
    if ($itemType === 'book')
    {
    if (!empty($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
        $result = $conn->query("SELECT MAX(`id`) + 1 AS next_id FROM `items`");
        if ($result && $row = $result->fetch_assoc()) {
            $nextId = $row['next_id'];
            $imageData = file_get_contents($_FILES["image"]["tmp_name"]);

            $stmt = $conn->prepare("INSERT INTO `items`(`id`,`name`,`item_type`,`cost`,`writer`,`description`,`image`,`seller_email`) VALUES (?,?,?,?,?,?,?,?)");
            $stmt->bind_param("ississss", $nextId, $name,$itemType, $cost, $writer, $desc, $imageData, $seller_email);
            if ($stmt->execute()) {
                echo "Item uploaded successfully for selling <br>";
                echo "Go to home: ";
                echo "<a href='search.php' style='text-decoration:none'>home</a>";
            } else {
                echo "Error uploading image: " . $stmt->error;
            }
            $stmt->close();
        }
    } else {
        $result = $conn->query("SELECT MAX(`id`) + 1 AS next_id FROM `items`");
        if ($result && $row = $result->fetch_assoc()) {
            $nextId = $row['next_id'];

            $stmt = $conn->prepare("INSERT INTO `items`(`id`,`name`,`item_type`,`cost`,`writer`,`description`,`seller_email`) VALUES (?,?,?,?,?,?,?)");
            $stmt->bind_param("ississss", $nextId, $name,$itemType, $cost, $writer, $desc, $seller_email);
            if ($stmt->execute()) {
                echo "Item uploaded successfully for selling <br>";
                echo "Go to home: ";
                echo "<a href='search.php' style='text-decoration:none'>home</a>";
            } else {
                echo "Error uploading image: " . $stmt->error;
            }
            $stmt->close();
        }
    }
}
else if($itemType === 'medicine')
{
    if (!empty($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
        $result = $conn->query("SELECT MAX(`id`) + 1 AS next_id FROM `items`");
        if ($result && $row = $result->fetch_assoc()) {
            $nextId = $row['next_id'];
            $imageData = file_get_contents($_FILES["image"]["tmp_name"]);

            $stmt = $conn->prepare("INSERT INTO `items`(`id`,`name`,`item_type`,`cost`,`description`,`expiry_date`,`image`,`seller_email`) VALUES (?,?,?,?,?,?,?,?)");
            $stmt->bind_param("ississss", $nextId, $name,$itemType, $cost, $desc, $expiry_date, $imageData, $seller_email);
            if ($stmt->execute()) {
                echo "Item uploaded successfully for selling <br>";
                echo "Go to home: ";
                echo "<a href='search.php' style='text-decoration:none'>home</a>";
            } else {
                echo "Error uploading image: " . $stmt->error;
            }
            $stmt->close();
        }
    } else {
        $result = $conn->query("SELECT MAX(`id`) + 1 AS next_id FROM `items`");
        if ($result && $row = $result->fetch_assoc()) {
            $nextId = $row['next_id'];

            $stmt = $conn->prepare("INSERT INTO `items`(`id`,`name`,`item_type`,`cost`,`description`,`expiry_date`,`seller_email`) VALUES (?,?,?,?,?,?,?)");
            $stmt->bind_param("ississs", $nextId, $name,$itemType, $cost, $desc, $expiry_date, $seller_email);
            if ($stmt->execute()) {
                echo "Item uploaded successfully for selling <br>";
                echo "Go to home: ";
                echo "<a href='search.php' style='text-decoration:none'>home</a>";
            } else {
                echo "Error uploading image: " . $stmt->error;
            }
            $stmt->close();
        }
    }
}

    $conn->close();
}
?>
