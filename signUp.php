<?php
// Start the sessions and connect to the database
session_start();
require_once('connect.php');
// Once the form has been submitted...
if (@$_POST['signUp']) {
    // Define the POST variables
    $username = $_POST['username'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phoneNumber = $_POST['phoneNumber'];
    $cardNumber = $_POST['cardNumber'];
    $catagory = $_POST['catagory'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    // Pull info about the profile image
   $imageName = $_FILES['profileImage'] ['name'];
   $imageSize = $_FILES['profileImage'] ['size'];
    // Makes sure user fills out all of the forms
    if (!empty($username) && !empty($email) && !empty($address) && !empty($phoneNumber) && !empty($cardNumber) && !empty($catagory) && !empty($imageName) && !empty($password) && !empty($confirmPassword)) {
        // Make sure the user has the same passwords
        if ($password == $confirmPassword) {
            // Make sure the profile image is not bigger than 10Mb
            if ($imageSize < 10485760) {
                // Define the path for the image to go
                $imagePath = "profileImages/$imageName";

                if (move_uploaded_file($_FILES['profileImage'] ['tmp_name'], $imagePath)) {
                    // If everything is good then we can insert the user data into the databse
                    $query = $dbh->prepare("INSERT INTO users VALUES (:userid, :username, :email, :address, :phoneNumber, :cardNumber, :catagory, :imageName, :password)");
                    $stmt= $dbh->prepare($query);
                    $data->execute(
                        array(
                            'userid' => 0,
                            'username' => $username,
                            'email' => $email,
                            'address' => $address,
                            'phoneNumber' => $phoneNumber,
                            'cardNumber' => $cardNumber,
                            'catagory' => $catagory,
                            'password' => $password,
                            'profileImage' => $imageName
                        )
                    );

                    $query = $dbh->prepare("SELECT userid FROM users WHERE email = :email");
                    $stmt= $dbh->prepare($query);
                    $data->execute(
                        array(
                            'email' => $email
                        )
                    );
                    $userid = $data->fetch();

                    // If we see the user has been added then set things up
                    if ($userid) {
                        // We then stored user data in PHP Session
                        $_SESSION['userid'] = $userid;
                        $_SESSION['username'] = $username;
                        $_SESSION['email'] = $email;
                        $_SESSION['catagory'] = $catagory;
                        $_SESSION['address'] = $address;
                        $_SESSION['signIn'] = true;

                        // Email the user a confirmation of signing up
                        $to = "$email";
                        $subject = "Swift Sell Sign Up Confirmation";
                        $txt = "Hello $username,<br>We are emailing you to confirm your sign up at Swift Sell";

                        mail($to,$subject,$txt);

                        // Take the user to the profile page
                        header('location: profile.php');
                    }
                    else {
                        echo "<p>We coundent grab your profile data</p>";
                    }
                }
                else {
                    echo "<p>Your profile image did not upload</p>";
                }
            }
            else {
                echo "<p>Profile image must be under 10Mb</p>";
            }
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
    <input type="file" name="profileImage">
    <label for="profileImage">Profile Image</label>
    <br>
    <input type="password" name="password">
    <label for="password">Password</label>
    <br>
    <input type="password" name="confirmPassword">
    <label for="confirmPassword">Confirm Password</label>
    <br>

    <button type="submit" name="signUp" value="1">Sign Up</button>
</form>
</body>
</html>
