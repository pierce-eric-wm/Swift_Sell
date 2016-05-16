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

<form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MM_MAXFILESIZE; ?>" />
    <fieldset>
        <legend>Personal Information</legend>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="" /><br />
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" value="" /><br />
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="" /><br />
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" value="" /><br />
        <label for="phoneNumber">Phone Number:</label>
        <input type="number" id="phoneNumber" name="phoneNumber" value="" /><br />
        <label for="cardNumber">CardNumber:</label>
        <input type="number" id="cardNumber" name="cardNumber" value="" /><br />
        <label for="catagory">Category</label>
        <select name="catagory">
            <option value="Auto">Auto</option>
            <option value="Clothing">Clothing</option>
            <option value="Technology">Technology</option>
            <option value="Household">Household</option>
            <option value="Games">Games</option>
            <option value="Tools">Tools</option>
            <option value="Sport">Sport</option>
        </select><br />
        <input type="hidden" name="old_picture" value="" />
        <label for="new_picture">Picture:</label>
        <input type="file" id="new_picture" name="new_picture" />

    </fieldset>
    <input type="submit" value="Save Profile" name="submit" />
</form>
<?php
// Start the session and connect to db and also define image parameters.
require_once ('connect.php');
require_once ('session.php');
require_once ('define.php');

$query = "SELECT * FROM users WHERE userid ='" . $_SESSION['userid'] . "'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch();
$old_picture = $row['profileImage'];
// Make sure the user is logged in before going any further.
if (!isset($_SESSION['userid'])) {
    echo '<p>Please <a href="signIn.php">Sign in</a> to access this page.</p>';
}

// Submit form run
if (isset($_POST['submit'])) {
    //$userid= $_SESSION['userid'];
    // Grab the profile data from the POST
    $error = false;
    $userid = $_SESSION['userid'];
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $address = trim($_POST['address']);
    $phoneNumber = trim($_POST['phoneNumber']);
    $cardNumber = trim($_POST['cardNumber']);
    $catagory = trim($_POST['catagory']);
    //Old picture change variable
    $new_picture = $_FILES['new_picture']['name'];
//    $new_picture_size = $_FILES['new_picture']['size'];
//    list($new_picture_width, $new_picture_height) = getimagesize($_FILES['new_picture']['tmp_name']);

    // Update the profile data in the database
    if (!empty($new_picture)) {
        $query = "UPDATE users SET userid= :userid, username= :username , email= :email, address= :address, phoneNumber= :phoneNumber, cardNumber= :cardNumber, catagory= :catagory, profileImage= :new_picture, password= :password WHERE userid = '" . $_SESSION['userid'] . "'";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array(
            'userid' => $_SESSION['userid'],
            'username' => $username,
            'email' => $email,
            'address' => $address,
            'phoneNumber' => $phoneNumber,
            'cardNumber' => $cardNumber,
            'catagory' => $catagory,
            'password' => $password,
            'new_picture' => $new_picture
        ));
        $query = "UPDATE";
        if ($_FILES['new_picture']['error'] == 0) {
            // Move the file to the target upload folder
            $target = MM_UPLOADPATH . basename($new_picture);
            if (move_uploaded_file($_FILES['new_picture']['tmp_name'], $target)) {
                // The new picture file move was successful, now make sure any old picture is deleted
                if (!empty($old_picture) && ($old_picture != $new_picture)) {
                    @unlink(MM_UPLOADPATH . $old_picture);
                }
            } else {
                // The new picture file move failed, so delete the temporary file and set the error flag
                @unlink($_FILES['new_picture']['tmp_name']);
                $error = true;
                echo '<p class="error">Sorry, there was a problem uploading your picture.</p>';
            }
        }
    }
    if (!$error) {
        if (!empty($username) && !empty($email) && !empty($address) && !empty($phoneNumber) && !empty($cardNumber) && !empty($catagory) && !empty($password)) {

            if (!empty($new_picture)) {
                //Delete old image from folder
                $query = "SELECT profileImage FROM users WHERE userid= '" . $_SESSION['userid'] . "'";
                $stmt = $dbh->prepare($query);
                $stmt->execute();
                $row = $stmt->fetchAll();
                @unlink("profileImages/" .$old_picture);
                    // Update the the profile to the new image that the user selected
                $query = "UPDATE users SET userid= :userid, username = :username , email = :email, " .
                    " address = :address, phoneNumber = :phoneNumber, cardNumber = :cardNumber, catagory= :catagory, profileImage = :new_picture, password = :password WHERE userid = '" . $_SESSION['userid'] . "'";
                $stmt = $dbh->prepare($query);
                $stmt->execute(array(
                    'userid' => $_SESSION['userid'],
                    'username' => $username,
                    'email' => $email,
                    'address' => $address,
                    'phoneNumber' => $phoneNumber,
                    'cardNumber' => $cardNumber,
                    'catagory' => $catagory,
                    'new_picture' => $new_picture,
                    'password' => $password

                ));
            } // Only set the picture column if there is a new picture

            else {
                $query = "UPDATE users SET userid= :userid, username = :username, email = :email, " .
                    " address = :address, phoneNumber = :phoneNumber, cardNumber = :cardNumber, catagory= :catagory, password = :password WHERE userid = '" . $_SESSION['userid'] . "'";
                $stmt = $dbh->prepare($query);
                $stmt->execute(array(
                    'userid' => $_SESSION['userid'],
                    'username' => $username,
                    'email' => $email,
                    'address' => $address,
                    'phoneNumber' => $phoneNumber,
                    'cardNumber' => $cardNumber,
                    'catagory' => $catagory,
                    'password' => $password

                ));
            }

            // Confirm success with the user
            echo '<p>Your profile has been successfully updated. Would you like to <a href="profile.php">view your profile</a>?</p>';
            exit();
        }
    } else {
        echo '<p class="error">You must enter all of the profile data(picture is optional).</p>';
    }
}
// End of check for form submission
else {
    // Grab the profile data from the database
    $query = "SELECT * FROM users WHERE userid ='" . $_SESSION['userid'] . "'";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch();
}

if ($row != NULL) {
    $username = $row['username'];
    $email= $row['email'];
    $password = $row['password'];
    $address = $row['address'];
    $phoneNumber = $row['phoneNumber'];
    $cardNumber = $row['cardNumber'];
    $catagory =$row['catagory'];
    $old_picture = $row['profileImage'];

}
else {
    echo '<p class="error">There was a problem accessing your profile.</p>';
}

?>
