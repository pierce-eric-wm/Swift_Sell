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
// Start the session

require_once('session.php');

// Make sure the user is logged in before going any further.
if (!isset($_SESSION['user_id'])) {
    echo '<p class="login">Please <a href="login.php">log in</a> to access this page.</p>';
    exit();
}

// Connect to the database

if (isset($_POST['submit'])) {
    // Grab the profile data from the POST
    $username= trim($_POST['username']);
    $email= trim($_POST['email']);
    $password= trim($_POST['password']);
    $address= trim($_POST['address']);
    $phoneNumber= trim($_POST['phoneNumber']);
    $cardNumber= trim($_POST['cardNumber']);

    // Update the profile data in the database
    if (!$error) {
        if (!empty($username) && !empty($email) && !empty($password) && !empty($address) && !empty($phoneNumber) && !empty($cardNumber)) {
            // Only set the picture column if there is a new picture
                $query = "UPDATE users SET username = '$username', email = '$email', password = '$password', " .
                    " address = '$address', phoneNumber = '$phoneNumber', cardNumber = '$cardNumber' WHERE user_id = '" . $_SESSION['user_id'] . "'";
            }

            // Confirm success with the user
            echo '<p>Your profile has been successfully updated. Would you like to <a href="viewprofile.php">view your profile</a>?</p>';
            exit();
        }
        else {
            echo '<p class="error">You must enter all of the profile data (the picture is optional).</p>';
        }
    }
// End of check for form submission
else {
    // Grab the profile data from the database
    $query = "SELECT * FROM users WHERE user_id = '" . $_SESSION['user_id'] . "'";
//    $data = mysqli_query($dbc, $query);
//    $row = mysqli_fetch_array($data);

    if ($row != NULL) {
        $username = $row['username'];
        $email= $row['email'];
        $password = $row['password'];
        $address = $row['address'];
        $phoneNumber = $row['phoneNumber'];
        $cardNumber = $row['cardNumber'];

    }
    else {
        echo '<p class="error">There was a problem accessing your profile.</p>';
    }
}
?>

<form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MM_MAXFILESIZE; ?>" />
    <fieldset>
        <legend>Personal Information</legend>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php if (!empty($username)) echo $username;?>" /><br />
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" value="<?php if (!empty($email)) echo $email; ?>" /><br />
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="<?php if (!empty($password)) echo $password;?>" /><br />
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" value="<?php if (!empty($address)) echo $address;?>" /><br />
        <label for="phoneNumber">Phone Number:</label>
        <input type="text" id="phoneNumber" name="phoneNumber" value="<?php if (!empty($phoneNumber)) echo $phoneNumber; ?>" /><br />
        <label for="cardNumber">CardNumber:</label>
        <input type="text" id="cardNumber" name="cardNumber" value="<?php if (!empty($cardNumber)) echo $cardNumber; ?>" /><br />
    </fieldset>
    <input type="submit" value="Save Profile" name="submit" />
</form>
