<?php
    // Start the sessions and connect to the database
    require_once('connect.php');
    session_start();

    // Localize the productid and userid
    $userid = $_SESSION['userid'];
    $productid = $_SESSION['productid'];

    $query = $dbh->prepare("SELECT users_username, productName, productPrice, productDescription, productCatagory, productLikes, productImage FROM products WHERE productid = :productid");
    $query->execute(
        array(
            'productid' => $productid
        )
    );
    $productInfo = $query->fetch();

    $username = $productInfo['0'];
    $productName = $productInfo['1'];
    $productPrice = $productInfo['2'];
    $productDescription = $productInfo['3'];
    $productCatagory = $productInfo['4'];
    $productLikes = $productInfo['5'];
    $productImage = $productInfo['6'];

    if (@$_POST['addCart']) {
        $query = $dbh->prepare("INSERT INTO carts VALUES (:cartid, :productid, :productName, :productPrice, :users_userid)");
        $query->execute(
            array(
                'cartid' => 0,
                'productid' => $productid,
                'productName' => $productName,
                'productPrice' => $productPrice,
                'users_userid' => $userid
            )
        );

        echo "You have added this product to your cart";
    }

    // If user likes a product
    if (@$_POST['likeProduct']) {
        $query = $dbh->prepare("SELECT productLikes FROM products WHERE productid = :productid");
        $query->execute(
            array(
                'productid' => $productid
            )
        );

        $originalLikes = $query->fetch();
        $addLike = $originalLikes['0'] + 1;
        $query = $dbh->prepare("UPDATE products SET productLikes = :addLike WHERE productid = :productid");
        $query->execute(
            array(
                'addLike' => $addLike,
                'productid' => $productid
            )
        );
    }
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
                    <a href="index.php"><img src="images/SwiftSell.png" style="height:58px; float: left"> </a>
                    <p class="locationlink" style="margin-left: 10px;"><a href="Home.php">Phoenix, Az <span class="glyphicon glyphicon-map-marker"> </span> </a></p>
                    <li><a href="#" style="color: #4a5c68;">About Us</a>
                    <li><a href="#" style="color: #4a5c68;">Locations</a></li>

                </ul>
                </div>
            </div>
        </div>

        <div class="categories">
            <center>
                <i><h1>Categories</h1></i>
                <p> <a href="Home.php">PHOENIX, AZ <span class="glyphicon glyphicon-map-marker"> </span> </a></p>
            </center>
            <a href="categories/auto.php">
                <div class="categoriefill">
                    <input type="button" class="button" value="Auto" />
                </div>
            </a>

            <a href="categories/clothing.php">
                <div class="categoriefill">
                    <input type="button" class="button" value="Clothing" />
                </div>
            </a>

            <a href="categories/technology.php">
                <div class="categoriefill">
                    <input type="button" class="button" value="Technology" />
                </div>
            </a>

            <a href="categories/household.php">
                <div class="categoriefill">
                    <input type="button" class="button" value="Household" />
                </div>
            </a>

            <a href="categories/games.php">
                <div class="categoriefill">
                    <input type="button" class="button" value="Games" />
                </div>
            </a>

            <a href="categories/tools.php">
                <div class="categoriefill">
                    <input type="button" class="button" value="Tools" />
                </div>
            </a>

            <a href="categories/sport.php">
                <div class="categoriefill">
                    <input type="button" class="button" value="Sport" />
                </div>
            </a>
        </div>

        <div class="profile">
            <?php
                if (@$_SESSION['signIn'] == true) {
                    $profileImage = $_SESSION['profileImage'];
                    echo "<center>";
                        echo '<img class="profileimg" src="images/' . $profileImage . '" >';
                    echo "</center>";
                    echo '<a href="profile.php">Profile</a>';
                    echo '<a href="editProfile.php">Edit Profile</a>';
                    echo '<a href="signOut.php">Sign Out</a>';
                    echo '<a href="signUp.php">Sign Up</a>';
                    echo '<a href="upload.php">Upload</a>';
                }
                else {
                    echo "<center>";
                        echo '<img class="profileimg" src="images/default-avatar.png" >';
                    echo "</center>";
                    echo '<a href="signIn.php">Sign In</a>';
                    echo '<a href="signUp.php">Sign Up</a>';
                }
            ?>
        </div>


        <div class="categorybody">


            <div class="productsContainer">
                <?php
                $imagePath = "images/" . $productImage;
                echo '<div class="productholderBig">';
                echo '<div class="imgholderBig">';
                echo '<img src="' . $imagePath . '" class="productimageBig">';
                echo "</div>";
                echo '<div class="nameholderBig">';
                echo '<p><b>Name: </b>' . $productName . '</p>';
                echo '</div>';
                echo '<div class="priceholderBig">';
                echo '<p><b>Price: </b>' . $productPrice . '</p>';
                echo '</div>';
                echo '<div class="likeholderBig">';
                echo '<p><b>Likes: </b>' . $productLikes . '</p>';
                echo '</div>';
                echo '<div class="categoryholderBig">';
                echo '<p><b>Category: </b>' . $productCatagory . '</p>';
                echo '</div>';
                echo '<div class="descriptionholderBig">';
                echo '<p><b>Description: </b>' . $productDescription . '</p>';
                echo '</div>';
                echo '<div class="buttonholderBig">';
                echo '<form method="post" name="addProduct">';
                echo '<input type="hidden" name="productidCart" value="' . $productid . '">';
                echo '<button type="submit" class="button1" name="addProduct" value="1">Add to Cart</button>';
                echo '</form>';
                echo '<form method="post" name="likeProduct">';
                echo '<input type="hidden" name="productidLike" value="' . $productid . '">';
                echo '<button type="submit" class="button2" name="likeProduct" value="1">Like</button>';
                echo '</form>';
                echo '</div>';
                echo "</div>";
                ?>
                <a href="checkout.php">Checkout</a>

            </div>
        </div>
</body>
</html>
