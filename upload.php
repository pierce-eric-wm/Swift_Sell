<?php
    // Establish Connections and Sessions
    require_once ('session.php');
    require_once('connect.php');
    $success = false;

    if (@$_POST['upload']) {
        // Pull session data on the user
        $userid = $_SESSION['userid'];
        $username = $_SESSION['username'];

        // Pull the post data from the form
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $catagory = $_POST['catagory'];

        // Pull the info about the image of product
        $imageName = $_FILES['image']['name'];
        $imageSize = $_FILES['image']['size'];

        // Checks to make sure user has filled out all fields
        if (!empty($name) && !empty($price) && !empty($description) && !empty($catagory) && !empty($imageName)) {
            // Checks to make sure the file is not bigger than 10Mb
            if ($imageSize < 10485760) {
                // Define the path for the image to go
                $imagePath = "images/$imageName";

                // Move the image onto the server in appropriate location
                if (move_uploaded_file($_FILES['image'] ['tmp_name'], $imagePath)) {
                    // Insert product data into database
                    $query = "INSERT INTO products VALUES (:productid, :users_userid, :users_username, :productName, :productPrice, :productDescription, :productCatagory, :productLikes, :productImage)";
                    $stmt = $dbh->prepare($query);
                    $result = $stmt->execute(
                        array(
                            'productid' => 0,
                            'users_userid' => $userid,
                            'users_username' => $username,
                            'productName' => $name,
                            'productPrice' => $price,
                            'productDescription' => $description,
                            'productCatagory' => $catagory,
                            'productLikes' => 0,
                            'productImage' => $imageName
                        )
                    );
                    $success = true;
                }

                else {
                    echo "<p>There was an error with something that we don't know</p>";
                }
            }

            else {
                echo "<p>Your file must be smaller than 10Mb</p>";
            }
        }
        else {
            echo "<p>Please fill out all of the fields</p>";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Swift Sell</title>
        <link rel="stylesheet" href="stylesheet.css">
    </head>
    <body>
    <a href="index.php">Swift Sell</a>
    <br>
    <a href="profile.php">Profile</a>
    <br>
    <a href="editProfile.php">Edit Profile</a>
    <br>
    <a href="signIn.php">Sign In</a>
    <br>
    <a href="signOut.php">Sign Out</a>
    <br>
    <a href="signUp.php">Sign Up</a>
    <br>
    <a href="upload.php">Upload</a>

    <h3>Upload Product</h3>
        <br>
        <a href="index.php">Home Page</a>
        <br>
        <a href="profile.php">Profile</a>
        <br>

        <?php
            if (!isset($_SESSION['signIn'])) {
                echo "<p>You must be signed in to upload products</p>";
            }
        ?>

        <form method="post" enctype="multipart/form-data" name="upload">
            <input type="text" name="name">
            <label for="name">Name</label>
            <br>
            <input type="number" name="price">
            <label for="price">Price</label>
            <br>
            <textarea name="description" rows="7" cols="18"></textarea>
            <label for="description">Description</label>
            <br>
            <select name="catagory">
                <option value="Auto">Auto</option>
                <option value="Clothing">Clothing</option>
                <option value="Technology">Technology</option>
                <option value="Household">Household</option>
                <option value="Games">Games</option>
                <option value="Tools">Tools</option>
                <option value="Sport">Sport</option>
            </select>
            <label for="catagory">Catagory</label>
            <br>
            <input type="file" name="image">
            <label for="image">Image</label>
            <br>

            <button type="submit" name="upload" value="1">Upload</button>
        </form>

        <p>
            <?php
                if ($success == true) {
                    echo "You have successfully uploaded your product";
                }
            ?>
        </p>
    </body>
</html>
