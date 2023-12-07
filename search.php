<!DOCTYPE html>
<?php session_start() ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation Bar with Search</title>
    <link rel="stylesheet" href="search.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>
    <div class="navbar">
        <ul > 
            <!-- <li><a href="index.html">Home</a></li> -->
            <li><a href="index.html">BookShelf</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Contact</a></li>
            <?php
            if(isset($_SESSION['username'])){
                
                echo "<a href='analytics.php'><li style='color:white;font-weight:bold;float:right;margin-top:5px;' >".$_SESSION['username']."</li> </a>";
                // echo "<a href='analytics.php'><img id=user src='user.png' alt='not found' style='width:30px;height:30px;float:right;'> </a>";
            }
            ?>
        </ul>
        <!-- <form class="search" method="get">
            <input type="text" placeholder="Search" name="search" value="<?php if(isset($_GET['search']))
            {echo $_GET['search']; } ?>">
            <button type="submit">Search</button>
        </form> -->
    </div>
    <div id="content">
        <div id="left">
            <a href="index.html" style='text-decoration:none;color:black;'>
            <div id="home" class="leftcon"><i class="fas fa-home"></i>Home</div></a>
            <a href="analytics.php" style='text-decoration:none;color:black;'>
            <div id="anlytics" class="leftcon"><i class="fas fa-chart-bar"></i>Analytics </div></a>
            <a href="buy1.php" style='text-decoration:none;color:black;'>
            <div id="products" class="leftcon"><i class="fas fa-shopping-cart"></i>Products</div></a>
            <!-- <div id="setting" class="leftcon"><i class="fas fa-cog"></i>Settings</div> -->
        </div>
        <div id="right">
            <div class="container">
                <a id="sell" class="transfer" href="sell.html">SELL</a>
                <a id="buy" class="transfer" href="buy1.php">BUY</a>
            </div>
            <div id="searchitem">
            <?php 
                     $db_host = "sellit.czk4caexf6nb.ap-south-1.rds.amazonaws.com";
                     $db_user = "admin";
                     $db_name = "sellit";
                     $pass="Abhishek2705";
 
                     $con = mysqli_connect($db_host, $db_user, $pass, $db_name);

                     if(isset($_GET['search']))
                        {
                         $filtervalues = $_GET['search'];
                         $query = "SELECT `image` FROM `books` WHERE  `name` LIKE '%$filtervalues%' ";
                         $query_run = mysqli_query($con, $query);

                         if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $items) {
                                $imageData = $items['image'];
                                $imagesrc = "data:image/jpg;base64," . base64_encode($imageData);
                                ?>
                                <img src="<?= $imagesrc; ?>" alt="Image">
                                <?php
                            }
                        } else {
                            ?>
                            <p>No Record Found</p>
                            <?php
                        }
                }
            ?>
            </div>
            <div id="belowcont" >
            <p id="a">Recent products</p>
            <div id="image1">
                <?php
                    $db_host = "sellit.czk4caexf6nb.ap-south-1.rds.amazonaws.com";
                    $db_user = "admin";
                    $db_name = "sellit";
                    $pass="Abhishek2705";

                    $conn = mysqli_connect($db_host, $db_user, $pass, $db_name);

                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    $sql = "SELECT `id`,`name`,`item_type`,`expiry_date`,`writer`,`image`,`cost` FROM `items` WHERE `id` NOT IN (SELECT `id` FROM `transactions`) ORDER BY `id` DESC LIMIT 6";
                    // $sql = "SELECT `id`, `name`, `writer`, `image`, `cost` FROM `items` WHERE `id` NOT IN (SELECT `item_id` FROM `transactions`)";

                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row["id"];
                            $name = $row["name"];
                            $writer=$row["writer"];
                            // $desc = $row["description"];
                            $cost = $row["cost"];
                            $imageData = $row["image"];
                            $item=$row["item_type"];
                            $expiry=$row["expiry_date"];
                            $imageSrc = "data:image/jpg;base64," . base64_encode($imageData);
                      if($item=="book"){
                          echo "<div id='box'>";
                            echo "<a href='buy2.php?id=$id' id='imageDiv$id' class='image-div'>";
                            echo "<img  src='$imageSrc' alt='Image is not available'> ";
                            echo "<div id='cont'>";
                            echo "<h5 id='cont1' class='name' >Book name:   $name </h5>";
                            echo "<h5 id='cont4' class='name'>Writer:  $writer </h5> ";
                            echo "<h5 id='cont2' class='name'>Cost:    $cost </h5> <br>";
                            
                            // echo "<p id='cont3'>$desc </p>";
                            echo "</div>";
                            echo "</a><br>";
                          echo "</div>";
                        }
                        else if($item=='medicine'){
                            echo "<div id='box'>";
                            echo "<a href='buy2.php?id=$id' id='imageDiv$id' class='image-div'>";
                            echo "<img  src='$imageSrc' alt='Image is not available'> ";
                            echo "<div id='cont'>";
                            echo "<h5 id='cont1' class='name' >Medicine name:   $name </h5>";
                            echo "<h5 id='cont4' class='name'>Expirydate:  $expiry </h5> ";
                            echo "<h5 id='cont2' class='name'>Cost:    $cost </h5> <br>";
                            
                            // echo "<p id='cont3'>$desc </p>";
                            echo "</div>";
                            echo "</a><br>";
                          echo "</div>";
                        }
                    }
                    } 
                
                else {
                        echo "No images found in the database.";
                    }
                    
                    mysqli_close($conn);
                    session_abort();
                ?>
            </div>
        </div>
    </div>
</div>
</body>

</html>