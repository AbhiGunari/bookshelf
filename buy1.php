<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation Bar with Search</title>
    <link rel="stylesheet" href="buy1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>
    <div id="content">
      <div id="navbar">
    <div id="navbar1">
        <form class="search" method="get">
        <input type="text" placeholder="Enter the book name" id="search" name="search" value = "<?php if(isset($_GET['search']) && !empty($_GET['search']))
            {echo $_GET['search']; } ?>" > 
              <i class="fas fa-times" id="clear-search"></i>
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>
      <div id="navbar2">
        <a href="analytics.php" style="color:white;font-weight:bolder;display:flex;
        justify-content:flex-end;text-decoration:none;"><?php echo $_SESSION['username'] ?></h4>
        </div>
    </div>
      <div id="searchitem">
            <?php 
                    $con = mysqli_connect("sellit.czk4caexf6nb.ap-south-1.rds.amazonaws.com","admin","Abhishek2705","sellit");

                     if(isset($_GET['search']) && !empty($_GET['search']))
                        {
                         $filtervalues = $_GET['search'];
                         $query = "SELECT `image`,`name`,`id` FROM `items` WHERE  `name` LIKE '%$filtervalues%' ";
                         $query_run = mysqli_query($con, $query);

                         if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $items) {
                                $imageData = $items['image'];
                                $imagesrc  = "data:image/jpg;base64," . base64_encode($imageData);

                                $book_id=$items['id'];
                                ?>
                              <a href="buy2.php?id=<?php echo $book_id; ?>">
                                <img src="<?= $imagesrc; ?>" alt="Image"> </a>
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
        <div id="right">
            <div id="belowcont">
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

                    $sql = "SELECT `id`, `name`, `writer`, `image`, `cost` FROM `items` WHERE `id` NOT IN (SELECT `id` FROM `transactions`)";
                    
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
                          echo "<div id='box'>";
                            echo "<a href='buy2.php?id=$id' id='imageDiv$id' class='image-div'>";
                            echo "<img  src='$imageSrc' alt='Image $id'> ";
                            echo "<div id='cont'>";
                            echo "<h5 id='cont1' class='name' >$name </h5>";
                            echo "<h5 id='cont4' class='name'>$writer </h5> ";
                            echo "<h5 id='cont2' class='name'>$cost </h5> <br>";
                            
                            // echo "<p id='cont3'>$desc </p>";
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
    </div>
     <script>
    //     document.querySelector("#navbar form").addEventListener("submit", function (event) {
    //     event.preventDefault();
    //     document.getElementById("searchitem").style.display = "block";
    // });
    var clear=document.getElementById('clear-search');
    clear.addEventListener('click',function () {
        search.value='';
        document.getElementById("searchitem").style.display = "none";
    });


    </script> 
</body>

</html>