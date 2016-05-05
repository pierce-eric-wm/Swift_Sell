<?php
    session_start();
    require_once('connect.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Swift Sell</title>
        <link rel="stylesheet" href="stylesheet.css">
    </head>
    <body>
        <h3>Swift Sell</h3>

        <a href="index.php">Swift Sell</a>
        <a href="profile.php">Profile</a>
        <a href="editProfile.php">Edit Profile</a>
        <a href="signIn.php">Sign In</a>
        <a href="signOut.php">Sign Out</a>
        <a href="signUp.php">Sign Up</a>
        <a href="upload.php">Upload</a>

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
    </body>
</html>
