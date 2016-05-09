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

require_once ('session.php');
require_once ('connect.php');
require_once ('define.php');

// Make sure the user is logged in before going any further.
if (!isset($_SESSION['user_id'])) {
    echo '<p>Please <a href="signIn.php">Sign in</a> to access this page.</p>';
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
    //Old picture change
    $new_picture_name = $_FILES['new_picture']['name'];
    $new_picture_size = $_FILES['new_picture']['size'];
    list($new_picture_width, $new_picture_height) = getimagesize($_FILES['new_picture']['tmp_name']);

    // Update the profile data in the database if (!empty($new_picture)) {
    $query= "UPDATE users SET username=:username , email=:email, password= :password, address= :address, phoneNumber= :phoneNumber, cardNumber= :cardNumber, profileImage= :new_pictureWHERE user_id = :user_id";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(
        'username' => $username,
        'email' => $email,
        'password' => $password,
        'address' => $address,
        'phoneNumber' => $phoneNumber,
        'cardNumber' => $cardNumber,
        'new_picture' => $new_picture,
        'user_id' => $_SESSION['user_id']

    ));

    $query = "UPDATE";
    if ((($new_picture_type == 'image/gif') || ($new_picture_type == 'image/jpeg') || ($new_picture_type == 'image/pjpeg') ||
            ($new_picture_type == 'image/png')) && ($new_picture_size > 0) && ($new_picture_size <= MM_MAXFILESIZE) &&
        ($new_picture_width <= MM_MAXIMGWIDTH) && ($new_picture_height <= MM_MAXIMGHEIGHT)) {
        if ($_FILES['file']['error'] == 0) {
            // Move the file to the target upload folder
            $target = MM_UPLOADPATH . basename($new_picture);
            if (move_uploaded_file($_FILES['new_picture']['tmp_name'], $target)) {
                // The new picture file move was successful, now make sure any old picture is deleted
                if (!empty($old_picture) && ($old_picture != $new_picture)) {
                    @unlink(MM_UPLOADPATH . $old_picture);
                }
            }
            else {
                // The new picture file move failed, so delete the temporary file and set the error flag
                @unlink($_FILES['new_picture']['tmp_name']);
                $error = true;
                echo '<p class="error">Sorry, there was a problem uploading your picture.</p>';
            }
        }
    }
    if (!$error) {
        if (!empty($username) && !empty($email) && !empty($password) && !empty($address) && !empty($phoneNumber) && !empty($cardNumber)) {

            if (!empty($new_picture)) {
                $query = "UPDATE users SET username = '$username', email = '$email', password = '$password', " .
                    " address = '$address', phoneNumber = '$phoneNumber', cardNumber = '$cardNumber', picture = '$new_picture' WHERE user_id = '" . $_SESSION['user_id'] . "'";
            }
            // Only set the picture column if there is a new picture
               else{ $query = "UPDATE users SET username = '$username', email = '$email', password = '$password', " .
                    " address = '$address', phoneNumber = '$phoneNumber', cardNumber = '$cardNumber' WHERE user_id = '" . $_SESSION['user_id'] . "'";
            }

            // Confirm success with the user
            echo '<p>Your profile has been successfully updated. Would you like to <a href="viewprofile.php">view your profile</a>?</p>';
            exit();
        }
        else {
            echo '<p class="error">You must enter all of the profile data(picture is optional).</p>';
        }
    }
// End of check for form submission
else {
    // Grab the profile data from the database
    $query = "SELECT * FROM users WHERE user_id = '" . $_SESSION['userid'];
//    $data = mysqli_query($dbc, $query);
//    $row = mysqli_fetch_array($data);

    if ($row != NULL) {
        $username = $row['username'];
        $email= $row['email'];
        $password = $row['password'];
        $address = $row['address'];
        $phoneNumber = $row['phoneNumber'];
        $cardNumber = $row['cardNumber'];
        $old_picture = $row['profileImage'];

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
        <input type="hidden" name="old_picture" value="<?php if (!empty($old_picture)) echo $old_picture; ?>" />
        <label for="new_picture">Picture:</label>
        <input type="file" id="new_picture" name="new_picture" />
        <?php if (!empty($old_picture)) {
            echo '<img class="profile" src="' . MM_UPLOADPATH . $old_picture . '" alt="Profile Picture" />';
        } ?>
    </fieldset>
    <input type="submit" value="Save Profile" name="submit" />
</form>
