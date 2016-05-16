
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Swift Sell - Remove a User</title>
</head>
<body>
<h2>Swift Sell- Remove a User</h2>
​
<?php
require_once('connect.php');

if (isset($_GET['userid'])) {
    $userid = $_GET['userid'];
    $query = "SELECT userid, username, email, address, phoneNumber, cardNumber, catagory, profileImage, password FROM users WHERE userid = :userid LIMIT 1";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(
        'userid' => $userid
    ));
    $results = $stmt->fetchAll();
    // Declaring variables based on the userID
    foreach ($results as $row){
        $username = $row[1];
        $email = $row[2];
        $address = $row[3];
        $phoneNumber = $row[4];
        $cardNumber = $row[5];
        $catagory = $row[6];
        $profileImage = $row[7];
        $password = $row[8];
    }

    // Echo a confirmation of deletion
    echo '<p>Are you sure you want to delete the following user?</p>';
    echo '<p><strong>Username: </strong>' . $username . '<br /><strong>Email:</strong>' . $email .
        '<br /><strong>Address: </strong>' . $address . '</p><br /><p><strong>Phone Number:</strong>'. $phoneNumber .'</p><br /><p><strong>Card Number: </strong> '. $cardNumber . '</p><br /><p><strong>Category: </strong>'. $catagory . '</p><br /><p><strong>Profile Image: </strong>'. $profileImage . '</p><br /><p><strong>Password: <strong>'. $password. '</p>';
    echo '<form method="post">';
    echo '<input type="radio" name="confirm" value="Yes" /> Yes ';
    echo '<input type="radio" name="confirm" value="No" checked="checked" /> No <br />';
    echo '<input type="submit" value="submit" name="submit" />';
    echo '<input type="hidden" name="userid" value="' . $userid . '" />';
    echo '<input type="hidden" name="email" value="' . $email . '" />';
    echo '<input type="hidden" name="address" value="' . $address . '" />';
    echo '<input type="hidden" name="phoneNumber" value="' . $phoneNumber . '" />';
    echo '<input type="hidden" name="cardNumber" value="' . $cardNumber . '" />';
    echo '<input type="hidden" name="catagory" value="' . $catagory . '" />';
    echo '<input type="hidden" name="profileImage" value="' . $profileImage . '" />';
    echo '<input type="hidden" name="password" value="' . $password . '" />';
    echo '</form>';

    //if the user presses submit and clicks on yes this will delete the user from the data base
        if (isset($_POST['submit'])) {
            if ($_POST['confirm'] == 'Yes') {
                // Delete the screen shot image file from the server
                @unlink('profileImages/' . $profileImage);
                // Delete the score data from the database
                $query = "DELETE FROM users WHERE userid = " . $userid . " LIMIT 1";
                $stmt = $dbh->prepare($query);
                $stmt->execute();
                // Confirm success with the user
                echo '<p>The user with that was selected for removal was successfully removed.';
            }
            else {
                echo '<p class="error">User removal was canceled.</p>';
            }
        }

    else {
        echo '<p class="error">Sorry, no user was specified for removal.</p>';
    }
}
else{
    echo 'The specified user does not exist.';
}

echo '<p><a href="adminUser.php">&lt;&lt; Back to  user admin page</a></p>';
exit();
?>
​
</body>
</html>