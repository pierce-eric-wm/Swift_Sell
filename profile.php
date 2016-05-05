<?php
session_start()
require_once ("connect.php");
require_once ("session.php")
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Swift Sell</title>
        <link rel="stylesheet" href="stylesheet.css">
    </head>

    <body>
    <a href="index.php"></a>
    <a href="index.php"></a>
    <?php
    if (!isset($_SESSION['user_id'])) {
        echo '<p class="login">Please <a href="signIn.php">Sign In</a> to access this page.</p>';
        exit();
    }
    else {
        $query = "SELECT * FROM users WHERE user_id = '" . $_GET['user_id'] . "'";
        $stmt = $dbh->prepare($query);
        $result = $stmt->execute()->fetchAll();
    }
    //  $data = mysqli_query($dbc, $query);

    if ($data) {
        // The user row was found so display the user data
        $row = $data;
        echo '<table>';
        if (!empty($row['username'])) {
            echo '<tr><td class="label">Username:</td><td>' . $row['username'] . '</td></tr>';
        }
        if (!empty($row['email'])) {
            echo '<tr><td class="label">Email</td><td>' . $row['email'] . '</td></tr>';
        }
        if (!empty($row['address'])) {
            echo '<tr><td class="label">Address</td><td>' . $row['address'] . '</td></tr>';
        }
        if (!empty($row['phoneNumber'])) {
            echo '<tr><td class="label">Phone Number</td><td>' . $row['phoneNumber'] . '</td></tr>';
        }
        if (!empty($row['cardNumber'])) {
            echo '<tr><td class="label">Card Number</td><td>' . $row['cardNumber'] . '</td></tr>';
        }
        if (!empty($row['catagory'])) {
            echo '<tr><td class="label">Catagory</td><td>' . $row['catagory'] . '</td></tr>';
        }
        if (!empty($row['picture'])) {
            echo '<tr><td class="label">Picture:</td><td><img src="' . MM_UPLOADPATH . $row['picture'] .
                '" alt="Profile Picture" /></td></tr>';
        }
        echo '</table>';

        if (!isset($_GET['user_id']) || ($_SESSION['user_id'] == $_GET['user_id'])) {
            echo '<p>Would you like to <a href="editprofile.php">edit your profile</a>?</p>';
        }
    } // End of check for a single row of user results
    else {
        echo '<p class="error">There was a problem accessing your profile.</p>';
    }

    exit();
    ?>

    ?>
    </body>
</html>
