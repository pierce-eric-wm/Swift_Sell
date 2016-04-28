<?php
    // Start the sessions and connect to the database
    session_start();
    require_once('connect.php');

    // Once the form has been submited...
    if (@$_POST['signUp']) {
        // Define the POST variables
        $username = $_POST['username'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $phoneNumber = $_POST['phoneNumber'];
        $cardNumber = $_POST['cardNumber'];
        $catagory = $_POST['catagory'];
        $password = $_POST['password'];
        $ConfirmPassword = $_POST['confirmPassword'];

        // Makes sure user fills out all of the forms
        if (!empty($username) && !empty($email) && !empty($address) && !empty($phoneNumber) && !empty($cardNumber) && !empty($catagory) && !empty($password) && !empty($confirmPassword)) {
            if ($password == $confirmPassword) {
                $query = $dbh->prepare("INSERT INTO users VALUES (:userid, :username, :email, :address, :phoneNumber, :cardNumber, :catagory, :password)");
                $Query->execute(
                    array(
                        'userid' => 0,
                        'username' => $username,
                        '' => ,
                    )
                );
            }
            else {
                echo "<p>Make sure your passwords match</p>";
            }
        }
        else {
            echo "<p>You need to fill out all of the form fields</p>";
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
        <h3>Sign Up</h3>

        <form method="post" name="signUp">
            <input type="text" name="username">
            <label for="username">Username</label>
            <br>
            <input type="email" name="email">
            <label for="email">Email</label>
            <br>
            <input type="text" name="address">
            <label for="address">Address</label>
            <br>
            <input type="number" name="phoneNumber">
            <label for="phoneNumber">Phone Number</label>
            <br>
            <input type="number" name="cardNumber">
            <label for="cardNumber">Card Number</label>
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
            <input type="password" name="password">
            <label for="password">Password</label>
            <br>
            <input type="password" name="confirmPassword">
            <label for="confirmPassword">Confirm Password</label>
            <br>

            <button type="submit" name="signUp">Sign Up</button>
        </form>
    </body>
</html>
