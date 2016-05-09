<?php
    require_once ('session.php');
    require_once('connect.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!-- tell internet to use the latest rendering engine -->
    <meta http-eqiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width = device-width, initial- scle = 1">
    <title>Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="stylesheet.css">
    <link async href="http://fonts.googleapis.com/css?family=Advent%20Pro" data-generated="http://enjoycss.com"
          rel="stylesheet" type="text/css"/>
</head>
    <body>

    <div class="casingnav">
        <div class="topbar">
            <div class="casingnav">
                <ul>
                    <img src="images/SwiftSell.png" style="height:58px;">
                    <li><a href="#" style="color: #4a5c68;">About</a>
                    <li><a href="#" style="color: #4a5c68;">example</a></li>
                    <li class="navactive"><a href="Home.php" style="color: #4a5c68;">Home</a></li>
                </ul>
            </div>
        </div>
    </div>

        <?php
        
            $query = "SELECT * FROM products ORDER BY id DESC  LIMIT 10 ";
            $stmt =  $dbh->prepare($query);
            $stmt->execute();
            $id = $stmt->fetchAll();

            // Echo 10 of the newest products
            foreach ($id as $row) {
                echo '<table>';
                // Display the Product data
                $filepath = GW_UPLOADPATH . $row['productImage'];
                echo '<tr>';
                echo '<strong>Name:</strong> ' . $row['productName'] . '<br />';
                echo '<strong>Cost:</strong> ' . $row['productPrice'] . '<br />';
                echo '<strong>Description:</strong>' .$row['productLikes'] .'<br />';
                echo '<strong>Likes:</strong>' .$row['productDescription'] .'<br />';
                echo '<strong>Seller:</strong>' .$row['username'] .'<br />';
                echo '<strong>Catagorie:</strong>'.$row['productCategorie']. '<br />';
                if (is_file($filepath) && filesize($filepath) > 0) {
                    echo '<td><img src="' . $filepath . '"alt="Find Image"  class="image"/></td>';
                    echo '</table>';
                }
            }
            // If the user is signed in then the index will display 10 products to only
            // Show items from the categories that the user who is signed in/ logged in likes
            if (isset($_SESSION['username'])) {
            echo ' <a href="profile.php">View Profile</a><br />';
            echo ' <a href="logout.php">Log Out (' . $_SESSION['username'] . ')</a>';
            //Show 10 products tied to the categories that the user picked
            $query = "SELECT * FROM products ORDER BY id DESC  LIMIT 10 ";
            $stmt =  $dbh->prepare($query);
            $stmt->execute();
            $data = $stmt->fetchAll();
            }
        ?>


        <div class="categories">

            <center>
                <i><h1>Categories</h1></i>
            </center>

            <hr>

            <div class="categoriefill">
                <h3>Auto</h3>
            </div>

            <div class="categoriefill">
                <h3>Clothing</h3>
            </div>

            <div class="categoriefill">
                <h3>Technology</h3>
            </div>

            <div class="categoriefill">
                <h3>Household</h3>
            </div>

            <div class="categoriefill">
                <h3>Games</h3>
            </div>

            <div class="categoriefill">
                <h3>Tools</h3>
            </div>

            <div class="categoriefill">
                <h3>Sport</h3>
            </div>

        </div>

        <div class="profile">
            <center>
                <img class="profileimg" src="images/default-avatar.png" >
                
            </center>
            <a href="profile.php">Profile</a>
            <a href="editProfile.php">Edit Profile</a>
            <a href="signIn.php">Sign In</a>
            <a href="signOut.php">Sign Out</a>
            <a href="signUp.php">Sign Up</a>
            <a href="upload.php">Upload</a>




        </div>

        <div class="headimage">

            <img src="images/night_city_lights.jpg" style="height: 300px; width: 100%;">

        </div>

        <div class="categorybody">
            <div class="container">
                <h1>Welcome</h1>
            </div>


            <center>
                <div class="productsContainer">
                    <?php
                    // Select all of the rows in product table and put them in an array
                    $query = "SELECT users_username, productName, productPrice, productDescription, productCatagory, productLikes, productImage FROM products";
                    $stmt = $dbh->prepare($query);
                    $stmt->execute();
                    $products = $stmt->fetchAll();

                    // Use the products table array to display products
                    foreach ($products as $row) {
                        $imagePath = "images/" . $row['productImage'];

                        echo '<div class="product">';
                        echo '<img' . " " . 'width="' . '100%"' . " " . 'src="'. $imagePath .'"/>';
                        echo "<br>";
                        echo '<p>' . $row['productName'] . '</p>';
                        echo "<br>";
                        echo '<p>' . $row['productPrice'] . '</p>';
                        echo "<br>";
                        echo '<p>' . $row['productDescription'] . '</p>';
                        echo "<br>";
                        echo '<p>' . $row['productCatagory'] . '</p>';
                        echo "<br>";
                        echo '<p>' . $row['productLikes'] . '</p>';
                        echo "<br>";
                        echo '<p>' . $row['users_username'] . '</p>';
                        echo '</div>';
                    }
                    echo '<div style="clear: both;"</div>';
                    ?>
                </div>
            </center>
        </div>




    </body>
</html>


