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
    <br>

    <?php
        // Establish Connections and Sessions
        require_once('connect.php');
        session_start();

        if ($_SESSION['signIn']) {
            // Localize all of the SESSIONS
            $userid = $_SESSION['userid'];
            $username = $_SESSION['username'];
            $email = $_SESSION['email'];
            $address = $_SESSION['address'];
            $phoneNumber = $_SESSION['phoneNumber'];
            $cardNumber = $_SESSION['cardNumber'];
            $catagory = $_SESSION['catagory'];
            $profileImage = $_SESSION['profileImage'];
            $password = $_SESSION['password'];

            $imagePath = "profileImages/" . $profileImage;

            echo '<img' . " " . 'width="' . '200px"' . " " . 'src="'. $imagePath .'"/>';
            echo "<br>";
            echo "<h5>$username</h5>";
            echo "<br>";
            echo "<h5>$email</h5>";
            echo "<br>";
            echo "<h5>$address</h5>";
            echo "<br>";
            echo "<h5>$phoneNumber</h5>";
            echo "<br>";
            echo "<h5>$cardNumber</h5>";
            echo "<br>";
            echo "<h5>$catagory</h5>";
        }

        else {
            echo "Log in to see your profile";
        }
    ?>
    </body>
</html>
