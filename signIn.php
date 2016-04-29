<?php
    // Start the sessions and connect to the database
    session_start();
    require_once('connect.php');

    // Checks to see if user if allready signed in and if so then it takes them to profile password_get_info
    if (@$_SESSION['signIn'] == true) {
        header('location: profile.php');
    }

    // Once the form has been submited...
    if (@$_POST['signIn']) {
        // Define the POST variables
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Makes sure the user fills out all of the forms
        if (!empty($email) && !empty($password)) {

            // If they have entered in all the form fields then we check to see if they are a user
            $query = $dbh->prepare("SELECT userid, username, email, catagory, address FROM users WHERE email = :email AND password = :password");
            $query->execute(
                array(
                    'email' => $email,
                    'password' => $password
                )
            );
            $userInfo = $query->fetch();

            // If a user with that info exits then we store info in SESSIONS and take them to profile
            if ($userInfo) {
                // Store info in SESSIONS
                $_SESSION['userid'] = $userid;
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['catagory'] = $catagory;
                $_SESSION['address'] = $address;
                $_SESSION['signIn'] = true;

                // Take the user to the profile page
                header('location: profile.php');
            }
            else {
                echo "<p>Sorry we do not have an account that matches that username and password</p>";
            }
        }
        else {
            echo "<p>You did not enter in a username and password</p>";
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
        <h3>Sign In</h3>

        <form method="post" name="signIn">
            <input type="email" name="email">
            <label for="email">Email</label>
            <br>
            <input type="password" name="password">
            <label for="password">Password</label>
            <br>
            <button type="submit" name="signIn" value="1">SignIn</button>
        </form>
    </body>
</html>
