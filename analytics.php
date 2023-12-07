<!doctype html>
<?php
session_start();
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="analytics.css" rel="stylesheet">
  </head>
  <body>
   <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
     <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
     aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <!-- <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li> -->
        <!-- <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li> -->
        <!-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" 
          data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li> -->
        <!-- <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Disabled</a>
        </li> -->
      </ul> 
      <?php
        if (isset($_SESSION['username'])) {
            echo  $_SESSION['username'] ;
        }
            ?>
    </div>
  </div>
</nav>
<div id="belowcont" >
            <p id="a">Products that you have placed for sale</p>
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
                    $username=$_SESSION['username'];
                    $sql = "SELECT `id`, `name`, `writer`, `image`, `cost`, `is_bought` FROM `items` WHERE seller_email='$username'";
                    
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row["id"];
                            $name = $row["name"];
                            $writer=$row["writer"];
                            // $desc = $row["description"];
                            $cost = $row["cost"];
                            $imageData = $row["image"];
                            $imageSrc = "data:image/jpg;base64," . base64_encode($imageData);
                            $isBought = $row["is_bought"];
                          echo "<div id='box'>";
                            echo "<a href='details.php?id=$id' id='imageDiv$id' class='image-div'>";
                            echo "<img  src='$imageSrc' alt='Image $id'> ";
                            echo "<div id='cont'>";
                            echo "<h5 id='cont1' class='name' >$name </h5>";
                            echo "<h5 id='cont4' class='name'>$writer </h5> ";
                            echo "<h5 id='cont2' class='name'>$cost </h5>";
                          //   if ($isBought) {
                          //     echo "<h6 id='cont3'>This product has been bought.</h6>";
                          // } else {
                          //     echo "<h6 id='cont3'>It is available for sale.</h6>";
                          // }
                            // echo "<p id='cont3'>$desc </p>";
                            $sql_transaction = "SELECT `address` FROM `transactions` WHERE `itemname` = '$name'";
                            $result_transaction = mysqli_query($conn, $sql_transaction);
                            if (mysqli_num_rows($result_transaction) > 0) {
                                echo "<h6>This product has been bought.</h6>";
                            } else {
                                echo "<h6>This product has not been bought yet.</h6>";
                            }


                            echo "</div>";
                            echo "</a><br>";
                          echo "</div>";
                        }
                    } 
                
                else {
                        echo "No images found in the database.";
                    }
                    mysqli_close($conn);
                ?>
            </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" 
    crossorigin="anonymous"></script>
  </body>
</html>