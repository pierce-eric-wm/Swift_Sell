<?php
    // Establish Connections and Sessions
    session_start();
    require_once('connect.php');

    $userid = $_SESSION['userid'];
    $username = $_SESSION['username'];


?>

<!DOCTYPE html>
<html>
    <head>
        <title>Swift Sell</title>
        <link rel="stylesheet" href="stylesheet.css">
    </head>

    <body>
        <h3>Welcome to your profile page
            <?php
                echo "$username";
            ?>
        </h3>
        <br>
        <a href="index.php">Home Page</a>
        <br>
        <a href="upload.php">Upload</a>
        <br>
        <a href="signOut.php">Sign Out</a>
    </body>
</html>
