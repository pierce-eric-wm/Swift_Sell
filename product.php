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
        $query = "INSERT INTO carts VALUES (:cartid, :productid, :productName, :productPrice :users_userid)";
        $stmt = $dbh->prepare($query);
        $stmt->execute(
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
        <?php

        ?>

        <form method="post" name="likeProduct">
            <button type="submit" name="likeProduct" value="1">Like</button>
        </form>

        <form method="post" name="addCart">
            <button type="submit" name="addCart" value="1">Add to Cart</button>
        </form>

        <a href="checkout.php">Checkout</a>
    </body>
</html>
