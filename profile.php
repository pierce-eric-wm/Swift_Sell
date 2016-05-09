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

    <?php
        // Establish Connections and Sessions
        require_once('connect.php');
        require_once ('session.php');

        if ($_SESSION['signIn']) {
            
        }
    ?>
    </body>
</html>
