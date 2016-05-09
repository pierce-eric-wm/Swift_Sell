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
        session_start();

        if ($_SESSION['signIn']) {
            // Set the userid
            $userid = $_SESSION['userid'];

            // Select the user info
            $query = $dbh->prepare("SELECT * FROM users WHERE userid = :userid");
            $query->execute(
                array(
                    'userid' => $userid
                )
            );
            $userInfo = $query->fetch();

        }

        else {
            echo "Log in to see your profile";
        }
    ?>
    </body>
</html>
