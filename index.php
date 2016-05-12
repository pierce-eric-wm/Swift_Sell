<?php
    require_once('connect.php');
    session_start();
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
        <link async href="http://fonts.googleapis.com/css?family=Advent%20Pro" data-generated="http://enjoycss.com" rel="stylesheet" type="text/css"/>
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

        <div class="categories">

            <center>
                <i><h1>Categories</h1></i>
            </center>

            <hr>

            <a href="categories/auto.php">
                <div class="categoriefill">
                    <h3>Auto</h3>
                </div>
            </a>

            <a href="categories/clothing.php">
                <div class="categoriefill">
                    <h3>Clothing</h3>
                </div>
            </a>

            <a href="categories/technology.php">
                <div class="categoriefill">
                    <h3>Technology</h3>
                </div>
            </a>

            <a href="categories/household.php">
                <div class="categoriefill">
                    <h3>Household</h3>
                </div>
            </a>

            <a href="categories/games.php">
                <div class="categoriefill">
                    <h3>Games</h3>
                </div>
            </a>

            <a href="categories/tools.php">
                <div class="categoriefill">
                    <h3>Tools</h3>
                </div>
            </a>

            <a href="categories/sport.php">
                <div class="categoriefill">
                    <h3>Sport</h3>
                </div>
            </a>
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

            <div class="productsContainer">
                <?php
                    // Select all of the rows in product table and put them in an array
                    $query = "SELECT productid, users_username, productName, productPrice, productDescription, productCatagory, productLikes, productImage FROM products";
                    $stmt = $dbh->prepare($query);
                    $stmt->execute();
                    $products = $stmt->fetchAll();

<<<<<<< HEAD
                    // Use the products table array to display products
                    foreach ($products as $row) {
                        $imagePath = "images/" . $row['productImage'];
=======
                // Use the products table array to display products
                foreach ($products as $row) {
                    $imagePath = "images/" . $row['productImage'];

                        echo '<p>' . $row['users_username'] . ' name' . '</p>';

                        echo '<div class="productholder">';
>>>>>>> origin/master

                        echo '<div class="productholder">';
                            echo '<div class="imgholder">';
                                echo '<img src="' . $imagePath . '" class="productimage">';
                            echo "</div>";

                            echo '<div class="nameholder">';
                                echo '<p><b>Name: </b>' . $row['productName'] . '</p>';
                            echo '</div>';

                            echo '<div class="priceholder">';
                                echo '<p><b>Price: </b>' . $row['productPrice'] . '</p>';
                            echo '</div>';

                            echo '<div class="likeholder">';
                                echo '<p><b>Likes: </b>' . $row['productLikes'] . '</p>';
                            echo '</div>';

                            echo '<div class="categoryholder">';
                                echo '<p><b>Category: </b>' . $row['productCatagory'] . '</p>';
                            echo '</div>';

                            echo '<div class="descriptionholder">';
                                echo '<p><b>Description: </b>' . $row['productDescription'] . '</p>';
                            echo '</div>';

                            echo '<div class="buttonholder">';
                                echo '<form method="post">';
                                    echo '<input type="hidden" name="productidCart" value="' . $row['productid'] . '">';
                                    echo '<button type="submit"class="productbutton" name="addProduct">Add to Cart</button>';
                                echo '</form>';

                                echo '<form method="post">';
                                    echo '<input type="hidden" name="productidLike" value="' . $row['productid'] . '">';
                                    echo '<button type="submit"class="productbutton" name="likeProduct">Like</button>';
                                echo '</form>';
                            echo '</div>';
                        echo "</div>";
                    }
                    echo '<div style="clear: both;"</div>';
                ?>
            </div>
<<<<<<< HEAD
=======

            <!-- just code to block this

            <div class="productholder2">

                <div class="imgholder">
                    <img src="images/night_city_lights.jpg" style="height: 160px; width: 200px">
                </div>

                <div class="nameholder">
                    <p><b>Name:</b></p>
                </div>

                <div class="priceholder">
                    <p><b>Price:</b></p>
                </div>

                <div class="likeholder">
                    <p><b>Likes:</b></p>

                </div>

                <div class="categoryholder">
                    <p><b>Category:</b></p>
                </div>

                <div class="descriptionholder">
                    <p><b>Description:</b></p>
                </div>
            </div>

            <div class="productholder">

                <div class="imgholder">
                    <img src="images/night_city_lights.jpg" style="height: 160px; width: 200px">
                </div>

                <div class="nameholder">
                    <p><b>Name:</b></p>
                </div>

                <div class="priceholder">
                    <p><b>Price:</b></p>
                </div>

                <div class="likeholder">
                    <p><b>Likes:</b></p>

                </div>

                <div class="categoryholder">
                    <p><b>Category:</b></p>
                </div>

                <div class="descriptionholder">
                    <p><b>Description:</b></p>
                </div>
            </div>
>>>>>>> origin/master
        </div>
        -->
    </body>
</html>
